@extends('layouts.main')
@section('title', 'Add a New Image')
@section('content')
    @component('components.breadcrumbs')
        <li><a href="{{ route('pieces.index') }}">Images</a></li>
        <li class="active">Add a New Piece</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <div class='btn-group'>
                <a href="{{ route('pieces.index') }}" class='btn btn-primary'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Images </a>
            </div>
        </div>
        <h3>Add a New Image</h3>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Add a New Image</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('pieces.store') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Image ID</label>
                    <div class="col-sm-10">
                        <input value="{{ old('number') ?? $suggestedPieceNumber }}" name="number" type="text" class="form-control" id="inputEmail3" placeholder="Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input value="{{ old('name') }}"  name="name" type="text" class="form-control" id="inputEmail3" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Medium</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="media_id">
                            <option value="">Please select...</option>
                            @foreach($media as $medium)
                                <option value="{{ $medium->id }}">{{ $medium->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dimensions (inches)</label>
                    <div class="col-sm-10">
                        <input value="{{ old('size') }}" name="size" type="text" class="form-control" placeholder="w x h">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-10">
                        <select name="month" class="form-control">
                            <option value="">Please select...</option>
                            <option value="1">Janaury (1)</option>
                            <option value="2">February (2)</option>
                            <option value="3">March (3)</option>
                            <option value="4">April (4)</option>
                            <option value="5">May (5)</option>
                            <option value="6">June (6)</option>
                            <option value="7">July (7)</option>
                            <option value="8">August (8)</option>
                            <option value="9">September (9)</option>
                            <option value="10">October (10)</option>
                            <option value="11">November (11)</option>
                            <option value="12">December (12)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-10">
                        <input value="{{ old('year') }}"  name="year" type="text" class="form-control" placeholder="Year">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <input value="{{ old('status') }}" name="status" type="text" class="form-control" placeholder="Status">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Licences</label>
                    <div class="col-sm-10">
                        <textarea placeholder="Licences" name="licences" class="form-control">{{ old('licences') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-10">
                        <textarea placeholder="Notes" name="notes" class="form-control">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add Image</button>
                        <a href="{{ route('pieces.index') }}" class="btn">Cancel</a>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
@endsection