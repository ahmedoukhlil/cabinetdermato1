<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Medecin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Patient;
use App\TypeConsultation;
use App\TypeVisite;
use Gate;
use DB;
use PDF;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller {

    public function index() {
//        DB::enableQueryLog();
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isDoctor = Auth::user()->is_doctor;
        $appointments = Appointment::whereDate('appointment_time', date('Y-m-d'))
                        ->when(0 == $isDoctor, function ($q) {
                            return $q->where('status_id', '<', 3);
                        })->when(1 == $isDoctor, function ($q) {
                    return $q->where('status_id', '=', 2);
                })->get();
//        dd(DB::getQueryLog());
        $status = \App\RdvStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $appointment_date = date('d-m-Y');
        $status_id = 0;
        return view('admin.appointments.index', compact('appointments', 'appointment_date', 'status_id', 'status'));
    }

    function getAppointment(Request $request) {
//        dd($request->all());
        $status_id = (int) $request->input('status_id');
//        DB::enableQueryLog();
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appointments = Appointment::when(request('appointment_date'), function ($q) {
                            return $q->whereDate('appointment_time', date('Y-m-d', strtotime(request('appointment_date'))));
                        })
                        ->when(0 != $status_id, function ($q) {
                            return $q->where('status_id', '=', request('status_id'));
                        })->get();
        $status = \App\RdvStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $appointment_date = request('appointment_date');
//        dd(DB::getQueryLog());
        return view('admin.appointments.index', compact('appointments', 'status_id', 'appointment_date', 'status'));
    }

    public function create(Patient $patient) {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $patients = Patient::findOrF()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $medecins = Medecin::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $visites = TypeVisite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $consultations = TypeConsultation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('patient', 'medecins', 'visites', 'consultations'));
    }

    public function store(StoreAppointmentRequest $request) {
        if (date('Ymd', strtotime($request->input('appointment_time'))) < date('Ymd')) {
            return redirect()->back()->withErrors('La date rendez-vous incorrecte !!!')->withInput();
        }

        $rdv = Appointment::where('patient_id', $request->all()['patient_id'])->where('status_id', '<', 3)
                        ->where('medecin_id', $request->all()['medecin_id'])->get();
        if ($rdv->count()) {
            return redirect()->back()->withErrors("Le patient à dèjà un RdV en cours")->withInput();
        }

        $ordre = Appointment::where('medecin_id', $request->all()['medecin_id'])->
                        whereDate('appointment_time', date('Y-m-d', strtotime($request->input('appointment_time'))))->orderBy('created_at', 'desc')->first();
        if (empty($ordre)) {
            $ordre = 1;
        } else {
            $ordre = $ordre->ordre + 1;
        }
        $gratuite = 0;
        $docteur = \App\Medecin::findOrFail($request->all()['medecin_id']);
//        $nDay = $docteur['free_days'];
//        if ($nDay > 0) {
//            $dt = date('Y-m-d', strtotime(date('Y-m-d') . "-$nDay days"));
//            $dtLastRdV = Appointment::where([
//                        ['patient_id', '=', $request->all()['patient_id']],
//                        ['medecin_id', '=', $request->all()['medecin_id']],
//                        ['gratuite', '=', 0],
//                        ['appointment_time', '>', $dt]
//                    ])->orderBy('id', 'desc')->get();
//            if ($dtLastRdV->count()) {
//                $gratuite = 1;
//            }
//        }
        $appointment = Appointment::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'gratuite' => $gratuite,
                    'status_id' => 1,
                    'ordre' => $ordre]);

        return redirect()->route('admin.appointments.index');
    }

    public function confirm(Appointment $appointment) {
//        DB::enableQueryLog();
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $price = \App\ConsultationPrice::where([
//                    ['type_id', '=', $appointment['consultation_id']],
//                    ['medecin_id', '=', $appointment['medecin_id']]])->first();
//        if (empty($price)) {
//            return redirect()->back()->withErrors('Tarif de la consultation non défini');
//        }
        if (2 == $appointment['status_id']) {
            $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user');
            return view('admin.appointments.show', compact('appointment'))->withErrors('Rendez-Vous dàjà confirmé');
        }
        $appointment['status_id'] = 2;
        DB::beginTransaction();
        $appointment->save();
//        $invoice = \App\Facture::create([
//                    'montant' => 0, //$price['tarif'],
//                    'montant_encaisse' => 0, // $price['tarif'],
//                    'patient_id' => $appointment['patient_id'],
//                    'factureable_type' => 'App\\Appointment',
//                    'factureable_id' => $appointment['id'],
//                    'reference' => 'Inv/Cons/Rdv/' . $appointment['id'],
//                    'user_id' => Auth::user()->id,
//        ]);
//        $invoice->facturePaiements()->create([
//            'reference' => 'PF/Cons/Inv/' . $invoice['id'],
//            'montant' => $price['tarif'],
//            'user_id' => Auth::user()->id,
//        ]);
//        $updated = array('solde' => DB::raw("solde + {$price['tarif']}"));
//        \App\CashRegister::where('id', 1)->update($updated);
//        $updated = array('ca' => DB::raw("ca + {$price['tarif']}"));
//        \App\Patient::where('id', $appointment['patient_id'])->update($updated);

//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();
        $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function printAppointment(Appointment $appointment) {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image = public_path() . '\images\Header.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $HeadImage = base64_encode($data);
        $image = public_path() . '\images\Footer.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $FooterImage = base64_encode($data);
//        dd($HeadImage);
        ini_set("pcre.backtrack_limit", "5000000");
        $appointment->load('medecin', 'patient', 'consultation', 'factures');
        $config = ['format' => 'A6-L', 'default_font_size' => 8, 'default_font' => 'arial', 'margin_right' => 2, 'margin_left' => 2, 'margin_top' => 5];
        $pdf = PDF::loadView('admin.appointments.print', compact('appointment', 'HeadImage', 'FooterImage'), [], $config);
        return $pdf->stream();
    }

    public function cancel(Appointment $appointment) {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $rendezVous = Appointment::findOrFail($appointment);
        if (1 != $appointment['status_id']) {
            return redirect()->back()->withErrors("Impossible d'annuler le rendez-vous");
        }
        $appointment['status_id'] = 4;
//        return dd($rendezVous);
        $appointment->save();
        $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function abandon(Appointment $appointment) {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        $appointment = Appointment::findOrFail($appointment);
        $appointment['status_id'] = 5;
//        return dd($rendezVous);
        $appointment->save();
        $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment) {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (1 != $appointment['status_id']) {
            return redirect()->back()->withErrors("Le rendez-vous ne peut plus être modifié");
        }

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visites = TypeVisite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $consultations = TypeConsultation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user');

        return view('admin.appointments.edit', compact('patients', 'medecins', 'visites', 'consultations', 'appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment) {
        $newAppointment = $request->all();
        $ordre = Appointment::where('medecin_id', $request->all()['medecin_id'])->
                        whereDate('appointment_time', date('Y-m-d', strtotime($request->input('appointment_time'))))->orderBy('created_at', 'desc')->first();
        if (empty($ordre)) {
            $ordre = 1;
        } else {
            $ordre = $ordre->ordre + 1;
        }
        $newAppointment['ordre'] = $ordre;
//        dd($newAppointment);
        $appointment->update($newAppointment);

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment) {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('patient', 'medecin', 'visite', 'consultation', 'status', 'user', 'rdvConsultations');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment) {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (1 != $appointment['status_id']) {
            return redirect()->back()->withErrors("Impossible de supprimer le rendez-vous");
        }
        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request) {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
