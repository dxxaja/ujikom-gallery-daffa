@extends('layouts.app')

@section('content')

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">{{$album->name}}</h1>
            <p class="lead text-muted">{{$album->description}}</p>
            <p>
                <a href="/photo/upload/{{$album->id}}" class="btn btn-primary my-2">Upload Photo</a>
                <a href="/albums" class="btn btn-secondary my-2">Back</a>
            </p>
        </div>
    </div>
</section>

@if (count($album->photos) > 0)
<div class="row">
    @foreach ($album->photos as $photo)
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="/storage/albums/{{$album->id}}/{{$photo->photo}}" height="200px" class="card-img-top" alt="photo Image">
            <div class="card-body">
                <h5 class="card-title">{{$photo->name}}</h5>
                <p class="card-text">{{$photo->description}}</p>
                <a href="{{route('photos.show' , $photo->id)}}" class="btn btn-primary">View</a>
<!-- Tombol Like -->
<form id="like-form-{{$photo->id}}" method="POST" action="{{ route('likes.toggle', $photo->id) }}">
    @csrf
    <button type="submit" class="btn btn-primary" id="like-btn-{{$photo->id}}">Like</button>
</form>


                <!-- Form Komentar -->
                <form method="POST" action="{{ route('comments.store', $photo->id) }}">
                    @csrf
                    <textarea name="content" rows="3" placeholder="Tambahkan komentar"></textarea>
                    <button type="submit" class="btn btn-success">Komentar</button>
                </form>
                <!-- Daftar Komentar -->
                @foreach ($photo->photoComments as $comment)
                <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>

@else
<p>No photos to display</p>
@endif

@endsection

@section('scripts')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script>
    $(document).ready(function() {
        // Saat dokumen dimuat, periksa apakah pengguna telah memberikan "like" pada setiap foto
        @foreach($album->photos as $photo)
        $.ajax({
            url: "{{ route('likes.check', $photo->id) }}",
            type: "GET",
            success: function(response) {
                if (response.liked) {
                    // Jika sudah dilike, sembunyikan tombol Like
                    $('#like-form-{{$photo->id}}').hide();
                }
            }
        });
        @endforeach

        // Event handler untuk form Like
        $('form[id^="like-form"]').submit(function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default
            var form = $(this);
            var url = form.attr('action');

            // Kirim permintaan AJAX
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Tampilkan pesan dari respons
                    alert(response.message);

                    // Perbarui tampilan tombol
                    form.hide();
                    form.siblings('.unlike-form').show();
                },
                error: function(xhr) {
                    // Tangani kesalahan
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });

        // Event handler untuk form Unlike
        $('form[id^="unlike-form"]').submit(function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default
            var form = $(this);
            var url = form.attr('action');

            // Kirim permintaan AJAX
            $.ajax({
                url: url,
                type: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    // Tampilkan pesan dari respons
                    alert(response.message);

                    // Perbarui tampilan tombol
                    form.hide();
                    form.siblings('.like-form').show();
                },
                error: function(xhr) {
                    // Tangani kesalahan
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
