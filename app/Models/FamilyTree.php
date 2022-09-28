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
        'first_name', 'last_name', 'dob', 'user_id', 'gender', 'pid', 'mid','fid',
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function relation() {
        return $this->hasOne('App\Models\Relation','id','relation_id')->withTrashed();
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
    public function fatherInfo()
    {
        return $this->hasOne('App\Models\FamilyTree','id','fid');
    }
    public function motherInfo()
    {
        return $this->hasOne('App\Models\FamilyTree','id','mid');
    }
    public function partnerInfos()
    {
        return $this->hasMany('App\Models\FamilyTree','id','pid');
    }
    public function childInfosForFather()
    {
        return $this->hasMany('App\Models\FamilyTree','fid','id');
    }
    public function childInfosForMother()
    {
        return $this->hasMany('App\Models\FamilyTree','mid','id');
    }
}
