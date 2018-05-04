@extends('layouts.main')
@section('title', $detail->piece->name() . ' - Detail')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Images</a></li>
        <li><a class="active" href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name or '[No title yet]' }}</a></li>
        <li class="active">Detail</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.show', $detail->piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Image</a>
            <a href="{{ route('pieces.edit', $detail->piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Image</a>
            @if($previous)
                <a href="{{ route('details.show', $previous->id) }}" class='btn btn-default'><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Previous Detail</a>
            @endif
            @if($next)
                <a href="{{ route('details.show', $next->id) }}" class='btn btn-default'>Next Detail <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span></a>
            @endif
            <a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Images</a>
        </div>
        <h3>Detail: {{ $detail->piece->name or '[No title yet]' }}</h3>
        <hr>
        <img class="img-responsive img-thumbnail" src="{{ $detail->original }}"><hr>
        <p class="text-center">
            <catalogue url="{{ route('details.in-catalogue', $detail->id) }}" :in-catalogue="{{ $detail->inCatalogue() ? 'true' : 'false' }}"></catalogue>
            <featured url="{{ route('details.is-featured', $detail->id) }}" :is-featured="{{ $detail->isFeatured() ? 'true' : 'false' }}"></featured>
            <default url="{{ route('details.default', $detail->id) }}" :is-default="{{ $detail->isDefault() ? 'true' : 'false' }}"></default>
            <a href="{{ route('details.crop', $detail->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Watermarked</a>
            <a href="{{ route('details.download-original', $detail->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Original</a>
            <a href="{{ route('details.rotate', $detail->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Rotate Detail</a>
            <a href="{{ route('details.crop-original', $detail->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> Crop Detail</a>
        </p>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail: {{ $detail->piece->name or '[No title yet]' }}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <tr><td><strong>Image ID:</strong></td><td>{{ $detail->piece->number }}</td></tr>
                    <tr><td><strong>Detail ID:</strong></td><td> {{ $detail->id }}</td></tr>
                    <tr><td><strong>Piece Dimensions:</strong></td><td>{{ $detail->piece->size or '' }}</td></tr>
                    <tr><td><strong>Created:</strong></td><td>{{ $detail->piece->completed() }}</td> </tr>
                    <tr><td><strong>File Name:</strong></td><td>{{ $detail->file_name }}</td></tr>
                    <tr><td><strong>File Dimensions:</strong></td><td>{{ $detail->width }} x {{ $detail->height }}</td></tr>
                    <tr><td><strong>File Size:</strong></td><td>{{ $detail->filesize() }} MB</td></tr>
                    <tr><td><strong>Original:</strong></td><td>{{ $detail->original_file_name }}</td></tr>
                    <tr><td><strong>In Catalogue:</strong></td><td>{{ $detail->inCatalogue() ? 'Yes' : 'No' }}</td></tr>
                    <tr><td><strong>Category:</strong></td><td>{{ isset($detail->piece->category->type) ? $detail->piece->category->type : 'n/a' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tags</h3>
        </div>
        <div class="panel-body">
            <tags url="/details/{{ $detail->id }}/tags" :tags="{{ $tags }}"></tags>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delete Detail Image</h3>
        </div>
        <div class="panel-body">
            <a href="{{ route('details.confirm-delete', $detail->id) }}" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete Detail Image</a>
        </div>
    </div>
@endsection
