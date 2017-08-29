@extends('layouts.main')
@section('title', 'Rotate')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Images</a></li>
        <li><a class="active" href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name or '[No title yet]' }}</a></li>
        <li class="active">Rotate</li>
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
        <h3>Rotate: {{ $detail->piece->name or '[No title yet]' }}</h3>
        <hr>
        <img class="img-responsive img-thumbnail" src="{{ $detail->original }}">
        <hr>
        <h4>Please select the angle you wish to rotate:</h4>
    </div>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Rotate Options</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('details.rotate', $detail->id) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Rotation Angle (Clockwise):</label>
                    <div class="col-sm-10">
                        <select class="form-control" type="text" name="angle">
                            <option value="-90">90</option>
                            <option value="-180">180</option>
                            <option value="-270">270</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Rotate</button>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
@endsection