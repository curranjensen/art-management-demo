@extends('layouts.main')
@section('title', 'Catalogue')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Catalogue</li>
    @endcomponent
    <div class='page-header'>
        <div class='btn-toolbar pull-right'>
            <div class="dropdown btn-group">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{ Request::exists('category_id') ? ucwords(get_category_dropdown()) : 'Category' }}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="/catalogue">All</a></li>
                    @foreach($categories as $category)
                        <li><a href="/catalogue?{{ query_except('category_id', $category->id) }}">{{ ucwords($category->type) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <h3>Catalogue ({{$details->total()}})</h3>
    </div>

    @foreach(array_chunk($details->all(), 3) as $column)
        <div class="row">
            @foreach($column as $detail)
                <div class="col-md-4">
                    <div class="text-center">
                        <p><a href="{{ route('details.show', $detail->id) }}"><img class="img-thumbnail" src="{{ $detail->large }}"></a></p>
                        <p><a href="{{ route('pieces.show', $detail->piece->number) }}">{{ $detail->piece->name() }}</a></p>
                        <p><strong>Image ID:</strong> {{ $detail->piece->number }}</p>
                        <p><strong>Detail ID:</strong> {{ $detail->id }}</p>
                        <p><strong>File Name: </strong>{{ $detail->piece->number . '/' . $detail->file_name }}</p>
                        <p><strong>Original File: </strong>{{ $detail->original_file_name }}</p>
                        <p><strong>Image Dimensions:</strong> {{ $detail->width . ' x ' . $detail->height }}</p>
                        <p><strong>Image Size:</strong> {{ $detail->filesize() }} MB</p>
                        <p><strong>Completed:</strong> {{ $detail->piece->completed() }}</p>
                        <p><featured class="btn-sm" url="{{ route('details.is-featured', $detail->id) }}" :is-featured="{{ $detail->isFeatured() ? 'true' : 'false' }}"></featured>
                            <catalogue class="btn-sm" url="{{ route('details.in-catalogue', $detail->id) }}" :in-catalogue="{{ $detail->inCatalogue() ? 'true' : 'false' }}"></catalogue>
                            <a class="btn btn-sm btn-primary" href="{{ route('pieces.edit', $detail->piece->number) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a></p>
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