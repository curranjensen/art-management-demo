@extends('layouts.main')
@section('title', $tag->name)
@section('content')
    @component('components.breadcrumbs')
        <li><a href="{{ route('tags.index') }}">Tags</a></li>
        <li class="active">{{ $tag->name }}</li>
    @endcomponent
    <h2>Tag: {{ $tag->name }}</h2>
    <br>
    <table class="table table-striped table-condensed">
        <thead>
        <tr>
            <th>Image ID <a href="?sort=number-asc"><span class="glyphicon glyphicon-sort-by-attributes"></span></a> <a href="?sort=number-desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></th>
            <th>Thumbnail</th>
            <th>File Name</th>
            <th>Detail ID <a href="?sort=id-asc"><span class="glyphicon glyphicon-sort-by-attributes"></span></a> <a href="?sort=id-desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></th>
            <th>Name <a href="?sort=name-asc"><span class="glyphicon glyphicon-sort-by-attributes"></span></a> <a href="?sort=name-desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></th>
            <th>Dimensions</th>
            <th>Image Size</th>
            <th>File Size</th>
            <th>Month</th>
            <th>Year <a href="?sort=year-asc"><span class="glyphicon glyphicon-sort-by-attributes"></span> <a href="?sort=year-desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></a></th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($details as $detail)
            <tr>
                <td>{{ $detail->piece->number }}</td>
                <td><a href="{{ route('details.show', $detail->id) }}"><img class="img-thumbnail" src="{{ $detail->thumbnail }}"></a></td>
                <td>{{ $detail->piece->number . '/' . $detail->file_name }}</td>
                <td>{{ $detail->id }}</td>
                <td><a href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name() }}</a></td>
                <td>{{ $detail->piece->size() }}</td>
                <td>{{ $detail->width . ' x ' . $detail->height }}</td>
                <td>{{ $detail->filesize() }} MB</td>
                <td>{{ $detail->piece->month() }}</td>
                <td>{{ $detail->piece->year() }}</td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $detail->piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
            </tr>
        @endforeach
        <tbody>
    </table>
    <hr>
    <div class="text-center">
        {{ $details->appends(request()->query())->links() }}
    </div>
@endsection