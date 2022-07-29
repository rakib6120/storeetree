<?php

/**
 * Created by Jahid Mahmud.
 * Date: 18/03/23
 */

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Helper {
    /*
     * this function is used for showing the status label
     * @return ACTIVE_STATUSES
     */

    public static function activeStatuslabel($activeStatus) {
        if ($activeStatus == 1) {
            return '<span class="label label-success">' . Config::get('constants.ACTIVE_STATUSES')[$activeStatus] . '</span>';
        } else {
            return '<span class="label label-warning">' . Config::get('constants.ACTIVE_STATUSES')[$activeStatus] . '</span>';
        }
    }

    /*
     * this function is used for showing the connected period label
     * @return ACTIVE_STATUSES
     */

    public static function activeConnectedPeriodlabel($period) {
        return Config::get('constants.CONNECTED_PERIODS')[$period];
    }

    /*
     * this function is used for showing the connected period label
     * @return ACTIVE_STATUSES
     */

    public static function activeConnectedRelationLabel($relation) {
        return Config::get('constants.RELATIONS')[$relation];
    }

    /*
     * this function is used for showing the connected period label
     * @return ACTIVE_STATUSES
     */

    public static function activeGenderlabel($gender) {
        return Config::get('constants.GENDERS')[$gender];
    }

    /*
     * this function is used for selecting the menu active class
     * @return active
     */

    public static function menuIsActive($routeNames) {
        $currentRoute = Route::currentRouteName();

        if (in_array($currentRoute, $routeNames)) {
            return 'active';
        }
    }

    /*
     * this function will Upload any file to S3 or local disk
     * pass file or base64sting
     * pass destination folderPath with slash added in last
     * if fileName not provided , ans automatic file name will be generated with segmented folder with year & month
     * @return string Image Name With Segmented Folder
     */

    public static function uploadFile($file = null, $base64string = null, $destinationPath, $fileName = null, $disk = null, $extension = null) {

        if (!$disk) {
            $disk = env('DISK_TYPE');
        }
        if (!$fileName) {
            if ($file) {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            } elseif($extension) {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . $extension;
            } else {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . '.jpg';
            }
        }

        if ($file) {
            $imagePath = Storage::disk($disk)->putFileAs($destinationPath, $file, $fileName, 'public');

            return $imagePath;
        } elseif ($base64string) {
            $imagePath = Storage::disk($disk)->put($destinationPath . '/' . $fileName, $base64string, 'public');

            return $fileName;
        } else {
            return null;
        }
    }

    public static function storagePath($filePath) {
        return env('CDN_URL') . '/' . $filePath;
    }

    public static function bulkMediaDelete(array $stories)
    {
        $storyItems = Session::get('storyItems');

        foreach ($stories as $key => $story) {
            if (file_exists($story['video'])) {
                unlink($story['video']);
            }

            array_splice($storyItems, $key, 1);
        }

        Session::put('storyItems', $storyItems);
    }
}
