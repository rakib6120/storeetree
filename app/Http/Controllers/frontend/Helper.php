<?php

/**
 * Created by Jahid Mahmud.
 * Date: 18/03/23
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public static function uploadFile($file = null, $base64string = null, $destinationPath, $fileName = null, $disk = null) {

        if (!$disk) {
            $disk = env('DISK_TYPE');
        }
        if (!$fileName) {
            if ($file) {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
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
}
