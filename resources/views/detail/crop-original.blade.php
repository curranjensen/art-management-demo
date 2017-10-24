@extends('layouts.main')
@section('title', 'Crop')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Images</a></li>
        <li><a class="active" href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name or '[No title yet]' }}</a></li>
        <li class="active">Crop</li>
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
        <h3>Crop: {{ $detail->piece->name or '[No title yet]' }}</h3>
        <hr>
        <h4>Please select the area you wish to crop:</h4>
        <cropper src="{{ $detail->original }}"></cropper>
    </div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Crop Original</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('details.crop-original', $detail->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="width" id="width">
                <input type="hidden" name="height" id="height">
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Crop Image</button>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection