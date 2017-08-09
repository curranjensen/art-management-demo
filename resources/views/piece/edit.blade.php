@extends('layouts.main')
@section('title', 'Edit Image')
@section('content')
    @component('components.breadcrumbs')
        <li><a class="active" href="{{ route('pieces.index') }}">Images</a></li>
        <li><a class="active" href="{{ route('pieces.show', $piece->number) }}">{{ $piece->name or '[No title yet]' }}</a></li>
        <li class="active">Edit Image</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.show', $piece->number) }}" class='btn btn-primary'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Image</a>
            <a href="{{ route('pieces.create') }}" class='btn btn-primary'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Image </a>
            @if($previous)
                <a href="{{ route('pieces.edit', $previous->number) }}" class='btn btn-default'><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Previous Image</a>
            @endif
            @if($next)
                <a href="{{ route('pieces.edit', $next->number) }}" class='btn btn-default'>Next Image <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span></a>
            @endif
            <a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Images</a>
        </div>
        <h3>Edit Image: {{ $piece->name() }}</h3>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Image: {{ $piece->name or '' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('pieces.update', $piece->number) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Image ID</label>
                    <div class="col-sm-10">
                        <input readonly value="{{ old('number') ?? $piece->number }}" name="number" type="text" class="form-control" placeholder="Number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input value="{{ old('name') ?? $piece->name }}"  name="name" type="text" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Medium</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="media_id">
                            <option value="">Please select...</option>
                            @foreach($media as $medium)
                                @if($medium->id === $piece->media_id)
                                    <option selected="selected" value="{{ $medium->id }}">{{ $medium->type }}</option>
                                @else
                                    <option value="{{ $medium->id }}">{{ $medium->type }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dimensions (inches)</label>
                    <div class="col-sm-10">
                        <input value="{{ old('size') ?? $piece->size }}" name="size" type="text" class="form-control" placeholder="w x h">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-10">
                        <select name="month" class="form-control">
                            <option value="">Please select...</option>
                            <option {{ isset($piece->month) && $piece->month === 1 ? 'selected' : '' }} value="1">Janaury (1)</option>
                            <option {{ isset($piece->month) && $piece->month === 2 ? 'selected' : '' }} value="2">February (2)</option>
                            <option {{ isset($piece->month) && $piece->month === 3 ? 'selected' : '' }} value="3">March (3)</option>
                            <option {{ isset($piece->month) && $piece->month === 4 ? 'selected' : '' }} value="4">April (4)</option>
                            <option {{ isset($piece->month) && $piece->month === 5 ? 'selected' : '' }} value="5">May (5)</option>
                            <option {{ isset($piece->month) && $piece->month === 6 ? 'selected' : '' }} value="6">June (6)</option>
                            <option {{ isset($piece->month) && $piece->month === 7 ? 'selected' : '' }} value="7">July (7)</option>
                            <option {{ isset($piece->month) && $piece->month === 8 ? 'selected' : '' }} value="8">August (8)</option>
                            <option {{ isset($piece->month) && $piece->month === 9 ? 'selected' : '' }} value="9">September (9)</option>
                            <option {{ isset($piece->month) && $piece->month === 10 ? 'selected' : '' }} value="10">October (10)</option>
                            <option {{ isset($piece->month) && $piece->month === 11 ? 'selected' : '' }} value="11">November (11)</option>
                            <option {{ isset($piece->month) && $piece->month === 12 ? 'selected' : '' }} value="12">December (12)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-10">
                        <input value="{{ old('year') ?? $piece->year }}"  name="year" type="text" class="form-control" placeholder="Year">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <input value="{{ old('status') ?? $piece->status }}" name="status" type="text" class="form-control" placeholder="Status">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Licences</label>
                    <div class="col-sm-10">
                        <textarea placeholder="Licences" name="licences" class="form-control">{{ old('licences') ?? $piece->licences }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Notes</label>
                    <div class="col-sm-10">
                        <textarea placeholder="Notes" name="notes" class="form-control">{{ old('notes') ?? $piece->notes }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Update Image</button>
                        <a href="{{ route('pieces.index') }}" class="btn">Cancel</a>
                    </div>
                </div>
                @include('errors.errors')
            </form>
        </div>
    </div>
    <uploader url="{{ route('pieces.details.store', $piece->number) }}" token="{{ csrf_token() }}"></uploader>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Delete Image: {{ $piece->name or '' }}</h3>
        </div>
        <div class="panel-body">
            <a href="{{ route('pieces.confirm-delete', $piece->number) }}" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete Image</a>
        </div>
    </div>
@endsection