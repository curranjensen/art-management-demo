@extends('layouts.main')
@section('title', 'Images')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Images</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <a href="{{ route('pieces.create') }}" class='btn btn-primary'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add a New Image </a>
            <a href="{{ route('details.index') }}" class='btn btn-success'><span class="glyphicon glyphicon-list" aria-hidden="true"></span> All Details </a>
            <div class="dropdown btn-group">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Medium
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="/pieces">all images</a></li>
                   @foreach($media as $medium)
                        <li><a href="/pieces?{{ query_except('media_id', $medium->id) }}">{{ $medium->type }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <h3>Images ({{$pieces->total()}})</h3>
    </div>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>Image ID <a href="/pieces?{{ query_except('sort', 'number-asc') }}"><span class="glyphicon glyphicon-sort-by-attributes"></span></a> <a href="/pieces?{{ query_except('sort', 'number-desc') }}"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></th>
                <th>Thumbnail</th>
                <th>Title <a href="/pieces?{{ query_except('sort', 'name-asc') }}"><span class="glyphicon glyphicon-sort-by-attributes"></span></a> <a href="/pieces?{{ query_except('sort', 'name-desc') }}"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></th>
                <th>Details</th>
                <th>Dimensions</th>
                <th>Month</th>
                <th>Year <a href="/pieces?{{ query_except('sort', 'year-asc') }}"><span class="glyphicon glyphicon-sort-by-attributes"></span> <a href="/pieces?{{ query_except('sort', 'year-desc') }}"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></a></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pieces as $piece)
                <tr>
                    <td>{{ $piece->number }}</td>
                    <td><a href="{{ route('pieces.show', $piece->number) }}"><img class="img-thumbnail" src="{{ $piece->thumbnail->thumbnail ?? '/img/70x50_placeholder.png' }}"></a></td>
                    <td><a href="{{ route('pieces.show', $piece->number) }}">{{ $piece->name() }}</a></td>
                    <td>{{ $piece->details_count }}</td>
                    <td>{{ $piece->size() }}</td>
                    <td>{{ $piece->month() }}</td>
                    <td>{{ $piece->year() }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
                </tr>
            @endforeach
        <tbody>
    </table>
    <hr>
    <div class="text-center">
        {{ $pieces->appends(request()->query())->links() }}
    </div>
@endsection