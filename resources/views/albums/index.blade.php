@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="❤ text-center container">
        <strong>My Memory</strong></h1>
    <section class="py-5 text-center container">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" href="/albums/create">make new Album</a>
        </div>
    </section>


    <div class="row">
        @foreach ($albums as $album)
            <div class="col-md-4 shadow">
                <div class="card">
                    <img src="/storage/album_covers/{{$album->cover_image}}" height="200px" class="card-img-top" alt="Album Image">
                    <div class="card-body">
                        <h5 class="card-title">{{$album->name}}</h5>
                        <p class="card-text">{{$album->description}}</p>
                        <a href="{{route('albums.show' , $album->id)}}" class="btn btn-primary">View</a>
                        <form method="POST" action="{{ route('albums.destroy', $album->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
