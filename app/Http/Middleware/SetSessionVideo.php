<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VideoUploadActivity;
use Illuminate\Support\Facades\Session;

class SetSessionVideo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $storyItems          = (array) Session::get('storyItems');
        $videoUploadActivity = VideoUploadActivity::where('session_id', Session::getId())->get();

        foreach ($storyItems as $key => $storyItem) {
            if ($videoUploadActivity->count() < 1) {
                break;
            }

            foreach ($videoUploadActivity as $activity) {
                if ($storyItem['question_id'] == $activity->data['question_id']) {
                    $storyItems[$key]['video']  = "storage/" . $activity->data['video'];
                    $storyItems[$key]['status'] = "published";
    
                    $activity->delete();
                    continue;
                }
            }
        }

        Session::put('storyItems', $storyItems);
        return $next($request);
    }
}
