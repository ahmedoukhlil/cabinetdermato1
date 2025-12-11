<?php

namespace App\Http\Controllers\Admin;

use App\SaleDetail;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleDetails = SaleDetail::all();

        return view('admin.saleDetails.index', compact('saleDetails'));
    }
}
