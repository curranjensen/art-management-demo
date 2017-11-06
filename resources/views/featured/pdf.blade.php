@extends('layouts.export.blank')
@section('title', Request::exists('category_id') ? ucwords(get_category_dropdown()) : 'Featured')
@section('content')
    <div class="page-header">
        <div class="pull-left">
            <h3>{{ config('owner.company') }}</h3>
            <h4>http://catalogue.annecamozzi.com</h4>
        </div>
        <div class="pull-right">
            <h3 class="text-right">Category: {{ Request::exists('category_id') ? ucwords(get_category_dropdown()) : 'All' }}</h3>
        </div>
        <div class="clearfix"></div>
    </div>

    @foreach(array_chunk($details->all(), 2) as $column)
        <div class="row">
            @foreach($column as $detail)
                <div class="col-xs-6">
                    <div class="text-center">
                        <p><img class="img-thumbnail img-responsive" src="{{ $detail->large }}"></p>
                        <p>{{ $detail->piece->name() }}</p>
                        <p><strong>Image ID:</strong> {{ $detail->piece->number }}</p>
                        <p><strong>Detail ID:</strong> {{ $detail->id }}</p>
                      </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <hr>
@endsection