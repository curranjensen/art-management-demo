@extends('layouts.export.blank')
@section('title', 'Pieces')
@section('content')
    <div class='page-header'>
        <div class="clearfix">
            <h3 class="pull-right">Images ({{$pieces->count()}})</h3>
            <h3 class="pull-left">{{ config('owner.company') }} - {{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>
        </div>
    </div>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>Image ID</th>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Details</th>
                <th>Dimensions</th>
                <th>Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pieces as $piece)
                <tr>
                    <td>{{ $piece->number }}</td>
                    <td><img class="img-thumbnail" src="{{ $piece->thumbnail->absoluteThumbnail ?? '/img/70x50_placeholder.png' }}"></td>
                    <td>{{ $piece->name() }}</td>
                    <td>{{ $piece->details_count }}</td>
                    <td>{{ $piece->size() }}</td>
                    <td>{{ $piece->completed() }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
@endsection