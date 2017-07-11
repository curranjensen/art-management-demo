@extends('layouts.main')
@section('title', 'Details')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Details - Grid View</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('details.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Details - List View</a>
            <a href="{{ route('pieces.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Pieces </a>
        </div>
        <h3>Details ({{$details->total()}})</h3>
    </div>

    @foreach(array_chunk($details->all(), 3) as $column)
        <div class="row">
            @foreach($column as $detail)
                <div class="col-md-4">
                    <div class="text-center">
                        <p><a href="{{ route('pieces.show', $detail->piece->number) }}"><img class="img-thumbnail" src="{{ $detail->large }}"></a></p>
                        <p><a href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name() }}</a></p>
                        <p><strong>Image ID:</strong> {{ $detail->piece->number }}</p>
                        <p><strong>Detail ID:</strong> {{ $detail->id }}</p>
                        <p><strong>File Name: </strong>{{ $detail->piece->number . '/' . $detail->file_name }}</p>
                        <p><strong>Original File: </strong>{{ $detail->original_file_name }}</p>
                        <p><strong>Image Size:</strong> {{ $detail->width . ' x ' . $detail->height }}</p>
                        <p><strong>Completed:</strong> {{ $detail->piece->completed() }}</p>
                        <p><a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $detail->piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <hr>
    <div class="text-center">
        {{ $details->appends(request()->query())->links() }}
    </div>
@endsection