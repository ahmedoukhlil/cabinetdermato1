<?php

namespace App\Http\Controllers\Admin;

use App\CashRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTypeSoinRequest;
use App\Http\Requests\StoreTypeSoinRequest;
use App\Http\Requests\UpdateTypeSoinRequest;
use App\TypeSoin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeSoinsController extends Controller {

    public function index() {
        abort_if(Gate::denies('type_soin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeSoins = TypeSoin::all();
        return view('admin.typeSoins.index', compact('typeSoins'));
    }

    public function price(TypeSoin $typeSoin) {
        return $typeSoin->prix;
    }

    public function create() {
        abort_if(Gate::denies('type_soin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caisses = CashRegister::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.typeSoins.create', compact('caisses'));
    }

    public function store(StoreTypeSoinRequest $request) {
        $typeSoin = TypeSoin::create($request->all());

        return redirect()->route('admin.type-soins.index');
    }

    public function edit(TypeSoin $typeSoin) {
        abort_if(Gate::denies('type_soin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caisses = CashRegister::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeSoin->load('caisse');

        return view('admin.typeSoins.edit', compact('caisses', 'typeSoin'));
    }

    public function update(UpdateTypeSoinRequest $request, TypeSoin $typeSoin) {
        $typeSoin->update($request->all());

        return redirect()->route('admin.type-soins.index');
    }

    public function show(TypeSoin $typeSoin) {
        abort_if(Gate::denies('type_soin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeSoin->load('caisse');

        return view('admin.typeSoins.show', compact('typeSoin'));
    }

    public function destroy(TypeSoin $typeSoin) {
        abort_if(Gate::denies('type_soin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeSoin->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeSoinRequest $request) {
        TypeSoin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
