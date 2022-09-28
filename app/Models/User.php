<?php

namespace App\Models;

use App\Models\Story;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'country_id', 'postal_code', 'dob', 'connected_period', 'email', 'password', 'email_verified_at', 'status', 'admin_id','gender'
    ];
    
    public $sortable = ['id', 'first_name', 'last_name', 'email', 'created_at', 'updated_at', 'country_id', 'connected_period', 'dob', 'postal_code', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status === 1;
    }

    public function country() {
        return $this->belongsTo(Country::class)->withTrashed();
    }

    public function familyTrees() {
        return $this->hasMany(FamilyTree::class);
    }

    public function stories() {
        return $this->hasMany(Story::class);
    }
}
