<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo; // Sesuaikan dengan model yang Anda gunakan untuk foto

class LikedPhotoController extends Controller
{
    public function index()
    {
        // Mengambil semua foto yang sudah disukai
        $likedPhotos = Photo::where('liked', true)->get();

        // Mengirim data foto ke view
        return view('liked_photos.index', compact('likedPhotos'));
    }
}
