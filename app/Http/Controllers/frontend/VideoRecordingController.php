<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Facades\Session;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoRecordingController extends Controller
{
    protected function word_chunk($str, $len = 76, $end = "\n")
    {
        $pattern = '~.{1,' . $len . '}~u'; // like "~.{1,76}~u"
        $str = preg_replace($pattern, '$0' . $end, $str);
        return rtrim($str, $end);
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => "required|mimetypes:video/*",
            'question_id' => "required"
        ]);

        $question   = Question::findOrFail($request->question_id);
        $storyItems = (array) Session::get('storyItems');
        $video_storage_link = "chunk-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";

        $text = $this->word_chunk($question->title);
        $command = "text='$text': fontcolor=black: fontsize=16: box=1: boxcolor=white@0.4: boxborderw=6: x=(w-text_w)/2:y=h-th-1:";

        FFMpeg::open($request->file('video'))
            ->addFilter(function (VideoFilters $filters) use ($command) {
                return $filters->custom("drawtext=$command");
            })
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save($video_storage_link);

        $isNewItem = true;
        foreach ($storyItems as $key => $storyItem) {
            if ($storyItem['question_id'] == $request->question_id) {
                $storyItems[$key]['video'] = "storage/" . $video_storage_link;

                $isNewItem = false;
                break;
            }
        }

        if ($isNewItem) {
            $storyItems[] = [
                'question_id' => $request->question_id,
                'video' => "storage/" . $video_storage_link
            ];
        }

        Session::put('storyItems', $storyItems);

        return response()->json([
            "msg" => 'Successfully uploaded.'
        ], 200);
    }
}
