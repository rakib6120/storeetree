<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Relation extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'sort', 'status', 'admin_id', 'parent_id', 'gender',
    ];
    
    public $sortable = ['id', 'title', 'sort', 'created_at', 'updated_at', 'parent_id', 'gender'];

    public function parent() {
        return $this->belongsTo(Relation::class, 'parent_id')->withTrashed();
    }
}
