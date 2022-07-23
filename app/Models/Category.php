<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'sort', 'status', 'admin_id',
    ];
    
    public $sortable = ['id', 'title', 'sort', 'created_at', 'updated_at'];

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
