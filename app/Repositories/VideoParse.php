<?php
namespace App\Repositories;

use App\Models\Story;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoParse
{
    public static function mergeChunkVideos(int $payment_log_id)
    {
        $cart       = Session::get('cart');
        if(!$cart) return redirect()->route('create-your-story.step-1');
        
        $questions  = Question::whereIn('id', $cart['questions'])->orderBy('sort', 'ASC')->get();
        $storyItems = collect(Session::get('storyItems'));

        // Cheking is all cart story was uploaded or redirect to upload.
        if (array_diff($cart['questions'], $storyItems->pluck('question_id')->toArray())) {
            return redirect()->route('create-your-story.step-4');
        }

        // Checking if any extra story uploaded then remove them.
        $extraStory = array_diff($storyItems->pluck('question_id')->toArray(), $cart['questions']);
        if ($extraStory) {
            Helper::bulkMediaDelete($storyItems->whereIn('question_id', $extraStory)->toArray());
            $storyItems = collect(Session::get('storyItems'));
        }

        $createStoryWarmupItems = array_map(function ($item){
            return ['warmup_id' => $item];
        }, $cart['warmups']);

        $mergeableVideos  = [];
        $createStoryItems = [];
        foreach ($questions as $key => $question){
            $story = $storyItems->where('question_id', $question->id)->first();
            $mergeableVideos[] = $createStoryItems[$key]['video'] = str_replace('storage/', "", $story['video']);
            $createStoryItems[$key]['question_id'] = $question->id;
        }
        
        $video_storage_link = "merged-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";
        FFMpeg::fromDisk('public')
            ->open($mergeableVideos)
            ->export()
            ->concatWithoutTranscoding()
            ->save($video_storage_link);

        $story = Story::create([
            'video' => $video_storage_link,
            'package' => $cart['plan'],
            'payment_log_id' => $payment_log_id,
            'user_id' => auth()->user()->id,
        ]);
        $story->storyItems()->createMany($createStoryItems);
        $story->storyWarmupItems()->createMany($createStoryWarmupItems);

        Session::forget(['cart', 'storyItems']);
    }
}