<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Session;

class VideoRecordingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'video' => "required|mimetypes:video/webm",
            'question_id' => "required"
        ]);

        $storyItems = (array) Session::get('storyItems');
        $video_storage_link = "chunk-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";

        FFMpeg::open($request->file('video'))
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save($video_storage_link);

        $isNewItem = true;
        foreach ($storyItems as $key => $storyItem) {
            if ($storyItem['question_id'] == $request->question_id) {
                $storyItems[$key]['video'] = $video_storage_link;

                $isNewItem = false;
                break;
            }
        }        

        if ($isNewItem) {
            $storyItems[] = [
                'question_id' => $request->question_id,
                'video' => $video_storage_link
            ];
        }

        Session::put('storyItems', $storyItems);
    }
}
