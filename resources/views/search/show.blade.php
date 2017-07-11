@extends('layouts.main')
@section('title', 'Search Results')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Search Results</li>
    @endcomponent
    <div class="page-header clearfix">
        <div class="pull-left">
            <h3>{{ $pieces->total() + $details->total() }} results for "{{ $query }}"</h3>
            <p>{{ $piecesCount = $pieces->total() }} <a href="#pieces">{{ str_plural('image', $piecesCount) }}</a> found. / {{ $detailsCount = $details->total() }} <a href="#details">{{ str_plural('detail', $detailsCount) }}</a> found.</p>
        </div>
        <h3 class="pull-right">
            <form class="form-inline" method="get" action="{{ route('search.search') }}">
                <input style="width: 400px;" class="form-control" placeholder="Search" name="q" />
                <i class="fa fa-search"></i>
            </form>
        </h3>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><a name="pieces">Images ({{ $piecesCount }})</a></h3>
        </div>
        <div class="panel-body">
            @if($piecesCount)
                <table class="table table-striped table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th>Piece ID</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Dimensions</th>
                        <th>Completed</th>
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
                                <td>{{ $piece->completed() }}</td>
                                <td><a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
                            </tr>
                        @endforeach
                    <tbody>
                </table>
                <p>{{ $piecesCount }} {{ str_plural('result', $piecesCount) }}.</p>
                <div class="text-center">
                    {{ $pieces->appends(request()->query())->links() }}
                </div>
            @else
                <p><em>No pieces matched "{{ $query }}."</em></p>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><a name="details">Details ({{ $detailsCount }})</a></h3>
        </div>
        <div class="panel-body">
            @if($detailsCount)
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
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{ $detail->piece->number }}</td>
                            <td><a href="{{ route('pieces.show', $detail->piece->number) }}"><img class="img-thumbnail" src="{{ $detail->thumbnail }}"></a></td>
                            <td>{{ $detail->piece->number . '/' . $detail->file_name }}</td>
                            <td>{{ $detail->id }}</td>
                            <td><a href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name() }}</a></td>
                            <td>{{ $detail->piece->size() }}</td>
                            <td>{{ $detail->width . ' x ' . $detail->height }}</td>
                            <td>{{ $detail->piece->completed() }}</td>
                            <td><a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $detail->piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></td>
                        </tr>
                    @endforeach
                    <tbody>
                </table>
                <p>{{ $detailsCount }} {{ str_plural('result', $detailsCount) }}.</p>
                <div class="text-center">
                    {{ $details->appends(request()->query())->links() }}
                </div>
            @else
                <p><em>No details matched "{{ $query }}."</em></p>
            @endif
        </div>
    </div>

@endsection