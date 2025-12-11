<?php

namespace App\Http\Controllers\Admin;

use App\AnalyseDetail;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnalyseDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('analyse_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analyseDetails = AnalyseDetail::all();

        return view('admin.analyseDetails.index', compact('analyseDetails'));
    }
}
