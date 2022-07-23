<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyTree extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'relation_id', 'user_id', 'gender', 'connect_with', 'admin_id', 'parent_id', 'spouse_id',
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function spouse() {
        return $this->belongsTo(FamilyTree::class, 'spouse_id')->withTrashed();
    }

    public function parent() {
        return $this->belongsTo(FamilyTree::class, 'parent_id')->withTrashed();
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getParentFullNameAttribute()
    {
        $spouse = $this->spouse;

        if($spouse) {
            return $spouse->full_name . ' - ' . $this->full_name;
        }

        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getGenderLabelAttribute()
    {
        if($this->gender == 'male') {
            return 'father';
        }
        
        return 'mother';
    }
}
