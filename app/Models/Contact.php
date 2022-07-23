<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'phone', 'email', 'comments', 'user_id',
    ];
    
    public $sortable = ['id', 'name', 'phone', 'email', 'created_at', 'updated_at'];
}
