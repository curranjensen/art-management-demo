@extends('layouts.main')
@section('title', 'Delete Piece')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Pieces</a></li>
        <li><a class="active" href="{{ route('pieces.show', $piece->number) }}">{{ $piece->name or '[No title yet]' }}</a></li>
        <li class="active">Delete Piece</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.show', $piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Piece</a>
            &nbsp; <a href="{{ route('pieces.edit', $piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Piece</a>
            &nbsp; <a href="{{ route('pieces.index') }}" class='btn btn-primary'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Pieces</a>
        </div>
        <h3>Delete Piece: {{ $piece->name or '' }}</h3>
        <p>{{ $piece->size or '' }}</p>
        <p>{{ $piece->month() }} {{ $piece->year or '' }} </p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delete Piece</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger">Are you sure you want to delete this Piece? All assocaited detail images will also be deleted This action cannot be undone.</div>
            <form action="{{ route('pieces.destroy', $piece->number) }}" method="post" class="form">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-danger">Delete</button>
                    <a href="{{ route('pieces.edit', $piece->number) }}" class="btn">Cancel</a>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection