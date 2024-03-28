<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($photoId)
{
    $user = Auth::user();
    $photo = Photo::find($photoId);

    if ($user && $photo) {
        $existingLike = Like::where('user_id', $user->id)
                            ->where('photo_id', $photo->id)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return redirect('/albums')->with(['message' => 'Photo unliked successfully']);
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $like->photo_id = $photo->id;
            $like->save();

            return redirect('/albums')->with(['message' => 'Photo liked successfully']);
        }
    }

    return redirect('/albums')->with(['error' => 'Photo or user not found'], 404);
}

}
