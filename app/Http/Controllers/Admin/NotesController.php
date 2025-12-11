<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller {

    public function index(Request $request) {
        abort_if(Gate::denies('note_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notes = Note::all();

        return view('admin.notes.index', compact('notes'));
    }

    public function create() {
        abort_if(Gate::denies('note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.notes.create', compact('patients'));
    }

    public function store(StoreNoteRequest $request) {
        $note = Note::create($request->all()+['medecin_id'=>Auth::user()->id]);
        return redirect()->route('admin.notes.index');
    }

    public function edit(Note $note) {
        abort_if(Gate::denies('note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->load('medecin', 'consultation', 'patient');

        return view('admin.notes.edit', compact('note'));
    }

    public function update(UpdateNoteRequest $request, Note $note) {

        $note->update($request->all());
        return redirect()->route('admin.notes.index');
    }

    public function show(Note $note) {
        abort_if(Gate::denies('note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->load('medecin', 'patient');

        return view('admin.notes.show', compact('note'));
    }

    public function notePrint(Note $note) {
//        dd($note);
        abort_if(Gate::denies('note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image = public_path() . '\images\Header.PNG';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $HeadImage = base64_encode($data);
        ini_set("pcre.backtrack_limit", "5000000");
        $note->load('medecin', 'patient');
        $config = ['format' => 'A5-P', 'default_font_size' => 11, 'margin_left' => 5, 'margin_right' => 5, 'margin_top' => 5];
//        return View('admin.notes.print', compact('note', 'HeadImage'));
        $content = $note->content;
        $content = str_replace("\r\n", '<br/>', $content);
        $content = str_replace("</p>", '<br/>', $content);
        $content = str_replace("<p>", '', $content);
        
        $pdf = PDF::loadView('admin.notes.print', compact('note', 'HeadImage', 'content'), [], $config);
        return $pdf->stream();
    }

    public function destroy(Note $note) {
        abort_if(Gate::denies('note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->delete();

        return back();
    }

}
