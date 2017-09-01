@extends('layouts.main')
@section('title', 'Tags')
@section('content')
    @component('components.breadcrumbs')
        <li class="active">Tags</li>
    @endcomponent

    <ul>
        @foreach($tags as $tag)
            <li><a href="/tags/{{ $tag->slug }}">{{ $tag->name }} ({{ $tag->details_count }})</a></li>
        @endforeach
    </ul>
@endsection