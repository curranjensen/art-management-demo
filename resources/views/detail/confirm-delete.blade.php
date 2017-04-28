@extends('layouts.main')
@section('title', 'Delete Detail Image')
@section('content')
    @component('components.breadcrumbs')
        <li><a href="{{ route('details.index') }}">Details</a></li>
        <li class="active">Delete Detail Image</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.show', $detail->piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Piece</a>
            &nbsp; <a href="{{ route('pieces.edit', $detail->piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Piece</a>
            &nbsp; <a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Pieces</a>
        </div>
        <h3>Delete Detail Image: {{ $detail->piece->name or '' }}</h3>
        <p><strong>Piece ID:</strong> {{ $detail->piece->number }}</p>
        <p><strong>Detail ID:</strong> {{ $detail->id }}</p>
        <p><strong>Piece Dimensions:</strong> {{ $detail->piece->size() }}</p>
        <p><strong>Completed:</strong> {{ $detail->piece->completed() }}</p>
        <p><strong>Filename:</strong> {{ $detail->file_name }}</p>
        <p><strong>File Dimensions:</strong> {{ $detail->width }} x {{$detail->height}}</p>
        <p><strong>Original:</strong> {{ $detail->original_file_name }}</p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delete Detail Image</h3>
        </div>
        <div class="panel-body">
            <img class="img-responsive" src="{{ $detail->large }}">
            <br>
            <div class="alert alert-danger">Are you sure you want to delete this image? This action cannot be undone.</div>
            <form action="{{ route('details.destroy', $detail->id) }}" method="post" class="form">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-danger">Delete</button>
                    <a href="{{ route('pieces.edit', $detail->piece->number) }}" class="btn">Cancel</a>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection