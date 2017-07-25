@extends('layouts.main')
@section('title', $piece->name ?? 'Piece')
@section('content')
    @component('components.breadcrumbs')
        <li><a href="{{ route('pieces.index') }}">Images</a></li>
        <li class="active">{{ $piece->name ?? 'Image' }}</li>
    @endcomponent
    <div class="page-header">
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.edit', $piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Image</a>
            @if($previous)
                <a href="{{ route('pieces.show', $previous->number) }}" class='btn btn-default'><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Previous Image</a>
            @endif
            @if($next)
                <a href="{{ route('pieces.show', $next->number) }}" class='btn btn-default'>Next Image <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span></a>
            @endif
            &nbsp;<a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Images</a>
        </div>
        <h3>{{ $piece->number }} - {{ $piece->name or '[No title yet]' }} </h3>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $piece->name ?? '[No title yet]' }}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <tr><td><strong>Image ID: </strong></td><td>{{ $piece->number }}</td></tr>
                    <tr><td><strong>Dimensions: </strong></td><td>{{ $piece->size() }}</td></tr>
                    <tr><td><strong>Completed: </strong></td><td>{{ $piece->completed() }}</td></tr>
                    <tr><td><strong>Status: </strong></td><td>{{ $piece->status() }}</td></tr>
                    <tr><td><strong>Licences: </strong></td><td>{!! $piece->licences() !!}</td></tr>
                    <tr><td><strong>Notes: </strong></td><td>{!! $piece->notes() !!}</td></tr>
                </table>
            </div>
        </div>
    </div>
    @foreach($details = $piece->details as $detail)
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('details.show', $detail->id) }}"><img class="img-thumbnail" src="{{ $detail->large }}"></a>
            </div>
            <div class="col-md-4">
                @if($detail->is_default)
                    <p>[ Default Image ]</p>
                @endif
                <p><strong>Detail ID: </strong> {{ $detail->id }}</p>
                <p><strong>File Name:</strong> {{ $piece->number . '/' . $detail->file_name }}</p>
                <p><strong>File Dimensions:</strong> {{ $detail->width }} x {{ $detail->height }}</p>
                <p><strong>File Size:</strong> {{ $detail->filesize() }} MB</p>
                <p><strong>Original File:</strong> {{ $detail->original_file_name }}</p>
                <p><a href="{{ route('details.crop', $detail->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Watermarked</a>
                <a href="{{ route('details.download-original', $detail->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Original</a></p>
            </div>
        </div>
        <br>
    @endforeach
    <p>{{ $count = $details->count() }} {{ str_plural('Detail', $count) }}.</p>
@endsection
