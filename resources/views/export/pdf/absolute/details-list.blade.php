@extends('layouts.export.blank')
@section('title', 'Details (List)')
@section('content')
    <div class='page-header'>
        <div class="clearfix">
            <h3 class="pull-left">{{ config('owner.company') }} - {{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>
            <h3 class="pull-right">Details ({{$details->count()}})</h3>
        </div>
    </div>
    <table class="table table-striped table-condensed">
        <thead>
        <tr>
            <th>Piece ID</th>
            <th>Thumbnail</th>
            <th>File Name</th>
            <th>Detail ID</th>
            <th>Name</th>
            <th>Dimensions</th>
            <th>Image Size</th>
            <th>Completed</th>
        </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
                <tr>
                    <td>{{ $detail->piece->number }}</td>
                    <td><img class="img-thumbnail" src="{{ $detail->absoluteThumbnail }}"></td>
                    <td>{{ $detail->piece->number . '/' . $detail->file_name }}</td>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->piece->name() }}</td>
                    <td>{{ $detail->piece->size() }}</td>
                    <td>{{ $detail->width . ' x ' . $detail->height }}</td>
                    <td>{{ $detail->piece->completed() }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
@endsection