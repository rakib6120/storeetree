<?php
namespace App\Repositories;

use App\Models\Story;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use App\Models\FamilyTree;

class VideoParse
{
    public static function mergeChunkVideos(int $payment_log_id, $cart, $storyItems)
    {        
        $questions  = Question::whereIn('id', $cart['questions'])->orderBy('sort', 'ASC')->get();

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
        
        $input_audio  = static::getAudioMusic();
        $video_storage_link = "merged-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";
        static::addBackgroundMusic($video_storage_link, $input_audio, $mergeableVideos);

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

    public static function getAudioMusic()
    {
        $files = Storage::disk('public')->files('audio');
        $family_tree = FamilyTree::with('user')->find(Auth::user()->id);
        $connect_with = $family_tree->connect_with;

        $audio_index = array_search("audio/".$connect_with.".mp3", $files);

        $audio = Storage::disk('public')->path($files[$audio_index]);

        return $audio;
    }

    public static function mergeVideo(array $mergeableVideos)
    {
        $tmp_video_storage_link = "tmp-merged-video/" . Auth::user()->id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";

        FFMpeg::fromDisk('public')
            ->open($mergeableVideos)
            ->export()
            ->concatWithoutTranscoding()
            ->save($tmp_video_storage_link);

        return Storage::disk('public')->path($tmp_video_storage_link);
    }

    public static function addBackgroundMusic($output_video, $input_audio, array $mergeableVideos)
    {
        $tmp_video_storage_link = static::mergeVideo($mergeableVideos);
        $dir_name               = pathinfo($output_video)['dirname'];
        $output_video_path      = Storage::disk('public')->path($output_video);

        if(!Storage::disk('public')->exists($dir_name)){
            Storage::disk('public')->makeDirectory($dir_name);
        }

        shell_exec(env('FFMPEG_BINARIES') . ' -i ' . $tmp_video_storage_link . ' -stream_loop -1 -i ' . $input_audio . ' -c:v copy -filter_complex "[0:a]aformat=fltp:44100:stereo,apad[0a];[1]aformat=fltp:44100:stereo,volume=0.08[1a];[0a][1a]amerge[a]" -map 0:v -map "[a]" -ac 2 -shortest ' . $output_video_path);
        unlink($tmp_video_storage_link);
    }
}