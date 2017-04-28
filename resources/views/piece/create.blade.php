@extends('layouts.main')
@section('title', 'Add a New Piece')
@section('content')
    @component('components.breadcrumbs')
        <li><a href="{{ route('pieces.index') }}">Pieces</a></li>
        <li class="active">Add a New Piece</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <div class='btn-group'>
                <a href="{{ route('pieces.index') }}" class='btn btn-primary'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Pieces </a>
            </div>
        </div>
        <h3>Add a New Piece</h3>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add a New Piece</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('pieces.store') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Piece ID</label>
                    <div class="col-sm-10">
                        <input value="{{ old('number') ?? $suggestedPieceNumber }}" name="number" type="text" class="form-control" id="inputEmail3" placeholder="Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input value="{{ old('name') }}"  name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dimensions</label>
                    <div class="col-sm-10">
                        <input value="{{ old('size') }}" name="size" type="text" class="form-control" id="inputEmail3" placeholder="Size">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-10">
                        <input value="{{ old('month') }}"  name="month" type="text" class="form-control" id="inputEmail3" placeholder="Month">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-10">
                        <input value="{{ old('year') }}"  name="year" type="text" class="form-control" id="inputEmail3" placeholder="Year">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add Piece</button>
                        <a href="{{ route('pieces.index') }}" class="btn">Cancel</a>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection