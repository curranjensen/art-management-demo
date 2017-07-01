@extends('layouts.export.blank')
@section('title', 'Details (Grid)')
@section('content')
    <div class='page-header'>
        <div class="clearfix">
            <h3 class="pull-left">Details ({{ $details->count() }})</h3>
            <h3 class="pull-right">{{ config('owner.company') }} - {{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
                <tr>
                    <td>
                        <img class="img-thumbnail img-responsive" src="{{ $detail->absoluteLarge }}">
                    </td>
                    <td>
                        <p><strong>Name: </strong>{{ $detail->piece->name() }}</p>
                        <p><strong>Piece ID: </strong>{{ $detail->piece->number }}</p>
                        <p><strong>Detail ID: </strong>{{ $detail->id }}</p>
                        <p><strong>File Name: </strong>{{ $detail->piece->number . '/' . $detail->file_name }}</p>
                        <p><strong>Original File Name: </strong>{{ $detail->original_file_name }}</p>
                        <p><strong>Image Size: </strong>{{ $detail->width . ' x ' . $detail->height }}</p>
                        <p><strong>Completed: </strong>{{ $detail->piece->completed() }}</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection