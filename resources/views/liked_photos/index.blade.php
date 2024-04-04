@extends('layouts.app')

@section('content')

<h1>Liked Photos</h1>

@foreach ($likedPhotos as $photo)
    <div>
        <img src="{{ $photo->url }}" alt="{{ $photo->title }}">
        <p>{{ $photo->description }}</p>
    </div>
@endforeach

@endsection

