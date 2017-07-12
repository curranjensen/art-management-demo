@extends('layouts.export.blank')
@section('title', 'Images (Grid)')
@section('content')
    <div class='page-header'>
        <div class="clearfix">
            <h3 class="pull-left">Images ({{ $pieces->count() }})</h3>
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
        @foreach($pieces as $piece)
            <tr>
                <td>
                    <img class="img-thumbnail img-responsive" src="{{ $piece->thumbnail->absoluteLarge ?? '/img/70x50_placeholder.png'}}">
                </td>
                <td>
                    <p><strong>Title: </strong>{{ $piece->name() }}</p>
                    <p><strong>Image ID: </strong>{{ $piece->number }}</p>
                    <p><strong>Size: </strong>{{ $piece->size }}</p>
                    <p><strong>Completed: </strong>{{ $piece->completed() }}</p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection