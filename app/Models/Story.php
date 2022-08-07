<?php

namespace App\Models;

use App\Models\StoryItem;
use App\Models\StoryWarmupItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the storyItems for the Story
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storyItems(): HasMany
    {
        return $this->hasMany(StoryItem::class);
    }

    public function storyWarmupItems(): HasMany
    {
        return $this->hasMany(StoryWarmupItem::class);
    }
}
