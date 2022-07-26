<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoRecordingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'video' => "required|mimetypes:video/webm"
        ]);

        FFMpeg::open($request->file('video'))
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save("chunk-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4");

        return response()->json([
            'message' => "Successfully saved video."
        ], 200);
    }
}
