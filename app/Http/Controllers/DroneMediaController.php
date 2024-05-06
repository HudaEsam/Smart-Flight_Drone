<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\DroneMedia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
class DroneMediaController extends Controller
{

public function storeImage(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'filename' => 'required|image',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();

        $randomFilename = $request->file('filename')->hashName();
        $request->file('filename')->move(public_path('images'), $randomFilename);

        $imageUrl = asset('images/' . $randomFilename);

        $image = DroneMedia::create([
            'filename' => $randomFilename,
            'url' => $imageUrl,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Image received and stored successfully', 'data' => $image]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function getAllImages(Request $request)
{
    try {
        $user = Auth::user();
        $images = DroneMedia::where('user_id', $user->id)->get();
        if ($images->isEmpty()) {
            return response()->json(['message' => 'No images found for this user'], 200); // Success with empty data
        }

        $imageData = $images->map(function ($image) {
            return [
                'url' => $image->url,
            ];
        });

        return response()->json(['images' => $imageData], 200);
    }
     catch (\Exception $e)
      {
        return response()->json(['error' => $e->getMessage()], 500); // Internal server error
    }
}


}
