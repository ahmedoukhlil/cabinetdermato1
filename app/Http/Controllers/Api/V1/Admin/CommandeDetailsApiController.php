<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CommandeDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CommandeDetailResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandeDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commande_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommandeDetailResource(CommandeDetail::with(['commande', 'article'])->get());
    }
}
