<?php

namespace App\Http\Controllers\Admin;

use App\Analysi;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAnalysiRequest;
use App\Http\Requests\StoreAnalysiRequest;
use App\Http\Requests\UpdateAnalysiRequest;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class AnalysesController extends Controller {

    use MediaUploadingTrait;

    public function index(Request $request) {
        abort_if(Gate::denies('analysi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Analysi::with(['medecin', 'consultation', 'patient'])->select(sprintf('%s.*', (new Analysi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analysi_show';
                $editGate = 'analysi_edit';
                $deleteGate = 'analysi_delete';
                $crudRoutePart = 'analysis';

                return view('partials.datatablesActions', compact( 'viewGate', 'editGate', 'deleteGate', 'crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('reference', function ($row) {
                return $row->reference ? $row->reference : "";
            });
            $table->addColumn('medecin_name', function ($row) {
                return $row->medecin ? $row->medecin->name : '';
            });
            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->name : '';
            });
            $table->addColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'medecin', 'patient']);

            return $table->make(true);
        }

        return view('admin.analysis.index');
    }

    public function create() {
        abort_if(Gate::denies('analysi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.analysis.create', compact('patients'));
    }

    public function store(StoreAnalysiRequest $request) {
        $analysi = Analysi::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $analysi->id]);
        }

        return redirect()->route('admin.analysis.index');
    }

    public function edit(Analysi $analysi) {
        abort_if(Gate::denies('analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysi->load('medecin', 'consultation', 'patient');

        return view('admin.analysis.edit', compact('analysi'));
    }

    public function update(UpdateAnalysiRequest $request, Analysi $analysi) {

        $analysiDetails = $analysi->analyseAnalyseDetails;
        DB::beginTransaction();
        $analysi->update($request->all());
        
        $currentAnalysiDetailData = [];
        foreach ($request->input('ordonnance_details', []) as $index => $data) {
            if (is_integer($index)) {
                $analysi->analyseAnalyseDetails()->create($data);
            } else {
                $id = explode('-', $index)[1];
                $currentAnalysiDetailData[$id] = $data;
            }
        }
        foreach ($analysiDetails as $item) {
            if (isset($currentAnalysiDetailData[$item->id])) {
                $item->update($currentAnalysiDetailData[$item->id]);
            } else {
                $item->delete();
            }
        }
        DB::commit();
        return redirect()->route('admin.analysis.index');
    }

    public function show(Analysi $analysi) {
        abort_if(Gate::denies('analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysi->load('medecin', 'consultation', 'patient', 'analyseAnalyseDetails');

        return view('admin.analysis.show', compact('analysi'));
    }

    public function printAnalyse(Analysi $analysi) {
        abort_if(Gate::denies('analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Chercher un fichier header existant
        $headerFiles = ['header-1.png', 'Header2.PNG', 'Header - Copie.PNG', 'Header.PNG'];
        $headerPath = null;
        foreach ($headerFiles as $file) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $file;
            if (file_exists($path)) {
                $headerPath = $path;
                break;
            }
        }
        
        if ($headerPath && file_exists($headerPath)) {
            $data = file_get_contents($headerPath);
            $HeadImage = base64_encode($data);
        } else {
            $HeadImage = ''; // Image vide si aucun header trouvé
        }
        
        // Chercher le fichier footer
        $footerPath = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'Footer.PNG';
        if (file_exists($footerPath)) {
            $data = file_get_contents($footerPath);
            $FooterImage = base64_encode($data);
        } else {
            $FooterImage = ''; // Image vide si footer non trouvé
        }
        
        ini_set("pcre.backtrack_limit", "5000000");
        $analysi->load('medecin', 'consultation', 'patient', 'analyseAnalyseDetails');
        $config = ['format' => 'A5-P', 'default_font_size' => 11, 'margin_left' => 2, 'margin_right' => 2, 'margin_top' => 5];
//        return View('admin.analysis.print', compact('analysi', 'HeadImage'));
        $pdf = PDF::loadView('admin.analysis.print', compact('analysi', 'HeadImage', 'FooterImage'), [], $config);
        return $pdf->stream();
    }

    public function destroy(Analysi $analysi) {
        abort_if(Gate::denies('analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysi->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnalysiRequest $request) {
        Analysi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request) {
        abort_if(Gate::denies('analysi_create') && Gate::denies('analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Analysi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

}
