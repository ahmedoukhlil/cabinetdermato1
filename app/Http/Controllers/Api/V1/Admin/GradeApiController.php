<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\Admin\GradeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GradeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('grade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GradeResource(Grade::all());
    }

    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::create($request->all());

        return (new GradeResource($grade))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Grade $grade)
    {
        abort_if(Gate::denies('grade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GradeResource($grade);
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->all());

        return (new GradeResource($grade))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Grade $grade)
    {
        abort_if(Gate::denies('grade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grade->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
