<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Patient::with(['genre'])->select(sprintf('%s.*', (new Patient)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'patient_show';
                $editGate = 'patient_edit';
                $deleteGate = 'patient_delete';
                $crudRoutePart = 'patients';

                return view('partials.datatablesActions', compact(
                                'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->editColumn('solde', function ($row) {
                return $row->solde ? $row->solde : 0;
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->full_name : "";
            });
            $table->editColumn('birth_day', function ($row) {
                return $row->birth_day ? $row->birth_day : "";
            });
            $table->editColumn('contact', function ($row) {
                return $row->contact ? $row->contact : "";
            });
            $table->editColumn('albinos', function ($row) {
                return $row->albinos ? "Albinos" : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $genres = Genre::get()->pluck('name')->toArray();

        return view('admin.patients.index', compact('genres'));
    }

    public function create() {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genres = Genre::all()->pluck('name', 'id');

        return view('admin.patients.create', compact('genres'));
    }

    public function store(StorePatientRequest $request) {
        $patient = Patient::create($request->all());

        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient) {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $genres = Genre::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient->load('genre');

        return view('admin.patients.edit', compact('genres', 'patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient) {
        $patient->update($request->all());

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient) {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('genre', 'patientOrdonnances', 'patientConsultations', 'patientAnalysis', 'patientAppointments');

        return view('admin.patients.show', compact('patient'));
    }

    public function destroy(Patient $patient) {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientRequest $request) {
        Patient::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
