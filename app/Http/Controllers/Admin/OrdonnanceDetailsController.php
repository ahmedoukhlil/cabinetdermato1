<?php

namespace App\Http\Controllers\Admin;

use App\FormeMedicament;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrdonnanceDetailRequest;
use App\Http\Requests\StoreOrdonnanceDetailRequest;
use App\Http\Requests\UpdateOrdonnanceDetailRequest;
use App\Ordonnance;
use App\OrdonnanceDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrdonnanceDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ordonnance_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrdonnanceDetail::with(['forme', 'ordonnance'])->select(sprintf('%s.*', (new OrdonnanceDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ordonnance_detail_show';
                $editGate      = 'ordonnance_detail_edit';
                $deleteGate    = 'ordonnance_detail_delete';
                $crudRoutePart = 'ordonnance-details';

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
            $table->editColumn('article', function ($row) {
                return $row->article ? $row->article->name : "";
            });
            $table->addColumn('forme_name', function ($row) {
                return $row->forme ? $row->article->forme->name : '';
            });

            $table->editColumn('posologie', function ($row) {
                return $row->posologie ? $row->posologie : "";
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });
            $table->editColumn('duration', function ($row) {
                return $row->duration ? $row->duration : "";
            });
            $table->addColumn('ordonnance_medicament', function ($row) {
                return $row->ordonnance ? $row->ordonnance->medicament : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'forme', 'ordonnance']);

            return $table->make(true);
        }

        return view('admin.ordonnanceDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ordonnance_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formes = FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ordonnances = Ordonnance::all()->pluck('medicament', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ordonnanceDetails.create', compact('formes', 'ordonnances'));
    }

    public function store(StoreOrdonnanceDetailRequest $request)
    {
        $ordonnanceDetail = OrdonnanceDetail::create($request->all());

        return redirect()->route('admin.ordonnance-details.index');
    }

    public function edit(OrdonnanceDetail $ordonnanceDetail)
    {
        abort_if(Gate::denies('ordonnance_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formes = FormeMedicament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ordonnances = Ordonnance::all()->pluck('medicament', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ordonnanceDetail->load('forme', 'ordonnance');

        return view('admin.ordonnanceDetails.edit', compact('formes', 'ordonnances', 'ordonnanceDetail'));
    }

    public function update(UpdateOrdonnanceDetailRequest $request, OrdonnanceDetail $ordonnanceDetail)
    {
        $ordonnanceDetail->update($request->all());

        return redirect()->route('admin.ordonnance-details.index');
    }

    public function show(OrdonnanceDetail $ordonnanceDetail)
    {
        abort_if(Gate::denies('ordonnance_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordonnanceDetail->load('article', 'ordonnance');

        return view('admin.ordonnanceDetails.show', compact('ordonnanceDetail'));
    }

    public function destroy(OrdonnanceDetail $ordonnanceDetail)
    {
        abort_if(Gate::denies('ordonnance_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordonnanceDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrdonnanceDetailRequest $request)
    {
        OrdonnanceDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
