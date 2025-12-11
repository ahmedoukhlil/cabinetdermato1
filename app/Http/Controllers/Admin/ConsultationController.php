<?php

namespace App\Http\Controllers\Admin;

use App\Consultation;
use App\Medecin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConsultationRequest;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Patient;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('consultation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Consultation::with(['rdv', 'patient', 'medecin', 'user', 'status'])->select(sprintf('%s.*', (new Consultation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'consultation_show';
                $editGate = 'consultation_edit';
                $deleteGate = 'consultation_delete';
                $crudRoutePart = 'consultations';

                return view('partials.datatablesActions', compact(
                        'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('appoitment', function ($row) {
                return $row->rdv ? $row->rdv->appointment_time : '';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->full_name : '';
            });
            $table->addColumn('medecin_name', function ($row) {
                return $row->medecin ? $row->medecin->full_name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'rdv', 'patient', 'medecin', 'status']);

            return $table->make(true);
        }

        return view('admin.consultations.index');
    }

    public function create(\App\Appointment $appointment) {
        abort_if(Gate::denies('consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appointment->load('patient');
        $formes = \App\FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = \App\Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $articles = \App\Article::where('id', -1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $consultations = Consultation::where('patient_id', $appointment->patient_id)->get();
        $ordonnances = \App\Ordonnance::where('patient_id', $appointment->patient_id)->get();
        $analyses = \App\Analysi::where('patient_id', $appointment->patient_id)->get();
        return view('admin.consultations.create', compact('categories', 'formes', 'articles', 'appointment', 'analyses', 'ordonnances', 'consultations'));
    }

    public function store(StoreConsultationRequest $request) {
//        DB::enableQueryLog();
        DB::beginTransaction();
        $consultation = Consultation::create($request->all() + [
                    'medecin_id' => Auth::user()->medecin->id,
                    'user_id' => Auth::user()->id
        ]);
        if ($request->has('ordonnance_details') && count($request->all()['ordonnance_details'])) {
            $ord = array(
                'medecin_id' => Auth::user()->medecin->id,
                'patient_id' => $request->input('patient_id'),
                'reference' => 'Ord/Cons/' . $consultation->id . '/Medecin/' . $consultation->medecin_id,
                'ordonnance_comment' => $request->input('ordonnance_comment')
            );
            $ordonnance = $consultation->consultationOrdonnances()->create($ord);
            foreach ($request->input('ordonnance_details', []) as $data) {
                $article = \App\Article::findOrFail($data['article_id']);
                if ((int) $article->autorised_quantity > 0 && $data['quantity'] > $article->autorised_quantity) {
                    $data['quantity'] = $article->autorised_quantity;
                }
                $ordonnance->ordonnanceOrdonnanceDetails()->create($data);
            }
        }
        if ($request->has('analyse_details') && count($request->all()['analyse_details'])) {
            $anal = array(
                'medecin_id' => Auth::user()->medecin->id,
                'patient_id' => $request->input('patient_id'),
                'reference' => 'Analyse/Cons/' . $consultation->id . '/Medecin/' . $consultation->medecin_id,
                'analysis_comment' => $request->input('analysis_comment')
            );
            $analyse = $consultation->consultationAnalysis()->create($anal);
            foreach ($request->input('analyse_details', []) as $data) {
                $analyse->analyseAnalyseDetails()->create($data);
            }
        }
        \App\Appointment::where('id', $consultation->appointment_id)->update(['status_id' => 3]);
//        DB::rollback();
//        dd(DB::getQueryLog());
        DB::commit();
        $consultation->load('rdv', 'patient', 'medecin', 'user', 'status', 'consultationOrdonnances', 'consultationAnalysis');

        return redirect()->route('admin.consultations.show', $consultation->id);
        return view('admin.consultations.show', compact('consultation'));
        return redirect()->route('admin.consultations.index');
    }

    public function edit(Consultation $consultation) {
        abort_if(Gate::denies('consultation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $consultation->load('rdv', 'patient', 'medecin', 'user', 'status');

        return view('admin.consultations.edit', compact('patients', 'medecins', 'consultation'));
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation) {
        $consultation->update($request->all());

        return redirect()->route('admin.consultations.index');
    }

    public function show(Consultation $consultation) {
        abort_if(Gate::denies('consultation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultation->load('rdv', 'patient', 'medecin', 'user', 'status', 'consultationOrdonnances', 'consultationAnalysis');

        return view('admin.consultations.show', compact('consultation'));
    }

    public function destroy(Consultation $consultation) {
        abort_if(Gate::denies('consultation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultation->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultationRequest $request) {
        Consultation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
