@extends('layouts.export.blank')
@section('title', 'Pieces (Grid)')
@section('content')
    <div class='page-header'>
        <div class="clearfix">
            <h3 class="pull-left">Pieces ({{ $pieces->count() }})</h3>
            <h3 class="pull-right">{{ config('owner.company') }} - {{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>
        </div>
    </div>

        @foreach(array_chunk($pieces->all(), 3) as $column)
            <div class="row">
                @foreach($column as $piece)
                    <div class="col-md-4">
                        <div class="text-center">
                            <p><img class="img-thumbnail" src="{{ $piece->thumbnail->large ?? '/img/70x50_placeholder.png' }}"></p>
                            <p>{{ $piece->name() }}</p>
                            <p><strong>Piece ID:</strong> {{ $piece->number }}</p>
                            <p><strong>Size:</strong> {{ $piece->size }}</p>
                            <p><strong>Completed:</strong> {{ $piece->completed() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

@endsection