<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Commande;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Http\Resources\Admin\CommandeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commande_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommandeResource(Commande::with(['user'])->get());
    }

    public function store(StoreCommandeRequest $request)
    {
        $commande = Commande::create($request->all());

        return (new CommandeResource($commande))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Commande $commande)
    {
        abort_if(Gate::denies('commande_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommandeResource($commande->load(['user']));
    }

    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $commande->update($request->all());

        return (new CommandeResource($commande))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Commande $commande)
    {
        abort_if(Gate::denies('commande_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commande->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
