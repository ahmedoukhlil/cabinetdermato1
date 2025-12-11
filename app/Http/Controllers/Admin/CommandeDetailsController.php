<?php

namespace App\Http\Controllers\Admin;

use App\CommandeDetail;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandeDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commande_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commandeDetails = CommandeDetail::all();

        return view('admin.commandeDetails.index', compact('commandeDetails'));
    }
}
