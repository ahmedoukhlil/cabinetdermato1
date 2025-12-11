<?php

namespace App\Http\Controllers\Admin;

use App\Medecin;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMedecinRequest;
use App\Http\Requests\StoreMedecinRequest;
use App\Http\Requests\UpdateMedecinRequest;
use App\Specilalte;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use DB;

class MedecinsController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('medecin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Medecin::with(['grade', 'specialite'])->select(sprintf('%s.*', (new Medecin)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'medecin_show';
                $editGate = 'medecin_edit';
                $deleteGate = 'medecin_delete';
                $crudRoutePart = 'medecins';

                return view('partials.datatablesActions', compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('grade_name', function ($row) {
                return $row->grade ? $row->grade->name : '';
            });

            $table->addColumn('specialite_name', function ($row) {
                return $row->specialite ? $row->specialite->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->full_name : "";
            });
            $table->editColumn('free_days', function ($row) {
                return $row->free_days ? $row->free_days : "";
            });
            $table->editColumn('solde_soins', function ($row) {
                return $row->solde_soins ? $row->solde_soins : 0;
            });

            $table->rawColumns(['actions', 'placeholder', 'grade', 'specialite']);

            return $table->make(true);
        }

        return view('admin.medecins.index');
    }

    public function create() {
        abort_if(Gate::denies('medecin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = \App\Role::all()->pluck('title', 'id');

        $grades = Grade::all()->pluck('name', 'id');

        $specialites = Specilalte::all()->pluck('name', 'id');

        return view('admin.medecins.create', compact('grades', 'specialites', 'roles'));
    }

    public function store(StoreMedecinRequest $request) {
        DB::beginTransaction();
        $medecin = Medecin::create($request->all());
        $user = \App\User::create($request->all() + ['is_doctor' => 1, 'medecin_id' => $medecin->id]);
        $user->roles()->sync($request->input('roles', []));
        DB::commit();
        return redirect()->route('admin.medecins.index');
    }

    public function edit(Medecin $medecin) {
        abort_if(Gate::denies('medecin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grades = Grade::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specialites = Specilalte::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecin->load('grade', 'specialite');

        return view('admin.medecins.edit', compact('grades', 'specialites', 'medecin'));
    }

    public function update(UpdateMedecinRequest $request, Medecin $medecin) {
        $medecin->update($request->all());

        return redirect()->route('admin.medecins.index');
    }

    public function show(Medecin $medecin) {
        abort_if(Gate::denies('medecin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medecin->load('grade', 'specialite', 'medecinConsultationPrices', 'medecinOrdonnances', 'medecinConsultations', 'medecinAnalysis', 'medecinOperationCashes', 'medecinAppointments');

        return view('admin.medecins.show', compact('medecin'));
    }

    public function destroy(Medecin $medecin) {
        abort_if(Gate::denies('medecin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medecin->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedecinRequest $request) {
        Medecin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
