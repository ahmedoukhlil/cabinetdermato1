<?php

namespace App\Http\Controllers\Admin;

use App\ConsultationPrice;
use App\Medecin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConsultationPriceRequest;
use App\Http\Requests\StoreConsultationPriceRequest;
use App\Http\Requests\UpdateConsultationPriceRequest;
use App\TypeConsultation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ConsultationPriceController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('consultation_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ConsultationPrice::with(['type', 'medecin', 'user'])->select(sprintf('%s.*', (new ConsultationPrice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'consultation_price_show';
                $editGate = 'consultation_price_edit';
                $deleteGate = 'consultation_price_delete';
                $crudRoutePart = 'consultation-prices';

                return view('partials.datatablesActions', compact(
                                'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'
                ));
            });

            $table->addColumn('type_name', function ($row) {
                return $row->type ? $row->type->name : '';
            });

            $table->addColumn('medecin_name', function ($row) {
                return $row->medecin ? $row->medecin->name : '';
            });

            $table->editColumn('medecin.last_name', function ($row) {
                return $row->medecin ? (is_string($row->medecin) ? $row->medecin : $row->medecin->last_name) : '';
            });
            $table->editColumn('tarif', function ($row) {
                return $row->tarif ? $row->tarif : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'type', 'medecin', 'user']);

            return $table->make(true);
        }

        return view('admin.consultationPrices.index');
    }

    public function create() {
        abort_if(Gate::denies('consultation_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = TypeConsultation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.consultationPrices.create', compact('types', 'medecins'));
    }

    public function store(StoreConsultationPriceRequest $request) {
        $price = \App\ConsultationPrice::where([
                    ['type_id', '=', $request->all()['type_id']],
                    ['medecin_id', '=', $request->all()['medecin_id']]])->get();
        if ($price->count()) {
            return redirect()->back()->withErrors('Tarif dèjà défini')->withInput();
        }
        $consultationPrice = ConsultationPrice::create($request->all()+['user_id' => Auth::user()->id]);
        return redirect()->route('admin.consultation-prices.index');
    }

    public function edit(ConsultationPrice $consultationPrice) {
        abort_if(Gate::denies('consultation_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = TypeConsultation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medecins = Medecin::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $consultationPrice->load('type', 'medecin', 'user');

        return view('admin.consultationPrices.edit', compact('types', 'medecins', 'consultationPrice'));
    }

    public function update(UpdateConsultationPriceRequest $request, ConsultationPrice $consultationPrice) {
        $consultationPrice->update($request->all());

        return redirect()->route('admin.consultation-prices.index');
    }

    public function show(ConsultationPrice $consultationPrice) {
        abort_if(Gate::denies('consultation_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationPrice->load('type', 'medecin', 'user');

        return view('admin.consultationPrices.show', compact('consultationPrice'));
    }

    public function destroy(ConsultationPrice $consultationPrice) {
        abort_if(Gate::denies('consultation_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consultationPrice->delete();

        return back();
    }

    public function massDestroy(MassDestroyConsultationPriceRequest $request) {
        ConsultationPrice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
