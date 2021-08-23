<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDiseaseRequest;
use App\Http\Requests\StoreDiseaseRequest;
use App\Http\Requests\UpdateDiseaseRequest;
use App\Models\Disease;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DiseasesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('disease_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diseases = Disease::with(['media'])->get();

        return view('admin.diseases.index', compact('diseases'));
    }

    public function create()
    {
        abort_if(Gate::denies('disease_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diseases.create');
    }

    public function store(StoreDiseaseRequest $request)
    {
        $disease = Disease::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $disease->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $disease->id]);
        }

        return redirect()->route('admin.diseases.index');
    }

    public function edit(Disease $disease)
    {
        abort_if(Gate::denies('disease_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diseases.edit', compact('disease'));
    }

    public function update(UpdateDiseaseRequest $request, Disease $disease)
    {
        $disease->update($request->all());

        if (count($disease->images) > 0) {
            foreach ($disease->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $disease->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $disease->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.diseases.index');
    }

    public function show(Disease $disease)
    {
        abort_if(Gate::denies('disease_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diseases.show', compact('disease'));
    }

    public function destroy(Disease $disease)
    {
        abort_if(Gate::denies('disease_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disease->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiseaseRequest $request)
    {
        Disease::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('disease_create') && Gate::denies('disease_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Disease();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
