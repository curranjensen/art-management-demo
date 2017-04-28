@extends('layouts.main')
@section('title', 'Edit Piece')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Pieces</a></li>
        <li><a class="active" href="{{ route('pieces.show', $piece->number) }}">{{ $piece->name or '[No title yet]' }}</a></li>
        <li class="active">Edit Piece</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.show', $piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Piece</a>
            <a href="{{ route('pieces.create') }}" class='btn btn-primary'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Piece </a>
            @if($previous)
                <a href="{{ route('pieces.edit', $previous->number) }}" class='btn btn-default'><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Previous Piece</a>
            @endif
            @if($next)
                <a href="{{ route('pieces.edit', $next->number) }}" class='btn btn-default'>Next Piece <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span></a>
            @endif
            <a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Pieces</a>
        </div>
        <h3>Edit Piece: {{ $piece->name() }}</h3>
    </div>

    <uploader url="{{ route('pieces.details.store', $piece->number) }}" token="{{ csrf_token() }}"></uploader>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Piece: {{ $piece->name or '' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('pieces.update', $piece->number) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Piece ID</label>
                    <div class="col-sm-10">
                        <input readonly value="{{ old('number') ?? $piece->number }}" name="number" type="text" class="form-control" id="inputEmail3" placeholder="Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input value="{{ old('name') ?? $piece->name }}"  name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dimensions</label>
                    <div class="col-sm-10">
                        <input value="{{ old('size') ?? $piece->size }}" name="size" type="text" class="form-control" id="inputEmail3" placeholder="Size">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-10">
                        <input value="{{ old('month') ?? $piece->month }}"  name="month" type="text" class="form-control" id="inputEmail3" placeholder="Month">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-10">
                        <input value="{{ old('year') ?? $piece->year }}"  name="year" type="text" class="form-control" id="inputEmail3" placeholder="Year">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Update Piece</button>
                        <a href="{{ route('pieces.index') }}" class="btn">Cancel</a>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delete Piece: {{ $piece->name or '' }}</h3>
        </div>
        <div class="panel-body">
            <a href="{{ route('pieces.confirm-delete', $piece->number) }}" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete Piece</a>
        </div>
    </div>
@endsection