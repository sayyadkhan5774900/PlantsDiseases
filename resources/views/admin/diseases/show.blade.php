@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.disease.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diseases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.id') }}
                        </th>
                        <td>
                            {{ $disease->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.title') }}
                        </th>
                        <td>
                            {{ $disease->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.description') }}
                        </th>
                        <td>
                            {!! $disease->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disease.fields.images') }}
                        </th>
                        <td>
                            @foreach($disease->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diseases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection