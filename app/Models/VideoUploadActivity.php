<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUploadActivity extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['session_id', 'data'];

    protected $casts = [
        'data' => "array"
    ];
}
