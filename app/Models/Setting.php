<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'home_video', 'story_first_step', 'story_second_step', 'story_third_step', 'story_fourth_step', 'story_fifth_step', 'admin_id',
    ];

}
