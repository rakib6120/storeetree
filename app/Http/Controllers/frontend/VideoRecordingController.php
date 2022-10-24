<?php

namespace App\Http\Controllers\frontend;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Jobs\VideoConverterJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoRecordingController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'video' => "required|mimetypes:video/*",
            'question_id' => "required"
        ]);

        $storyItems      = (array) Session::get('storyItems');
        $isNewItem       = true;
        
        $temp_video_path = Storage::disk('public')->put('temp', $request->file('video'));

        foreach ($storyItems as $key => $storyItem) {
            if ($storyItem['question_id'] == $request->question_id) {
                $storyItems[$key]['video']  = "";
                $storyItems[$key]['status'] = "pending";

                $isNewItem = false;
                break;
            }
        }

        if ($isNewItem) {
            $storyItems[] = [
                'question_id' => $request->question_id,
                'video'       => "",
                'status'      => "pending"
            ];
        }

        Session::put('storyItems', $storyItems);
        VideoConverterJob::dispatch(Auth::user()->id, Session::getId(), $request->question_id, $temp_video_path);

        return response()->json([
            "msg" => 'Successfully uploaded.'
        ], 200);
    }
}
