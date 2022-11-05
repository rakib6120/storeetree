<?php

namespace App\Jobs;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use App\Models\VideoUploadActivity;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoConverterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id, $session_id, $question_id, $temp_video_path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $session_id, $question_id, $temp_video_path)
    {
        $this->session_id      = $session_id;
        $this->question_id     = $question_id;
        $this->temp_video_path = $temp_video_path;
        $this->user_id        = $user_id;
    }

    private function word_chunk($str, $len = 76, $end = "\n")
    {
        $pattern = '~.{1,' . $len . '}~u'; // like "~.{1,76}~u"
        $str = preg_replace($pattern, '$0' . $end, $str);
        return rtrim($str, $end);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $question   = Question::findOrFail($this->question_id);
        $video_path = "chunk-video/" . $this->user_id . "/" . date('Y-m-d') . "/" . rand(99999, 9999999) . time() . ".mp4";

        $text = $this->word_chunk($question->title);
        $command = "text='$text': fontcolor=black: fontsize=16: box=1: boxcolor=white@0.4: boxborderw=6: x=(w-text_w)/2:y=h-th-1:";

        FFMpeg::fromDisk('public')
            ->open($this->temp_video_path)
            ->addFilter(function (VideoFilters $filters) use ($command) {
                return $filters->custom("drawtext=$command");
            })
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save($video_path);

        VideoUploadActivity::create([
            'session_id' => $this->session_id,
            'data'       => ['question_id' => $this->question_id, 'video' => $video_path]
        ]);
        Storage::disk('public')->delete($this->temp_video_path);
    }
}
