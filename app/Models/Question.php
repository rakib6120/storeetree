<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Question extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'sort', 'status', 'admin_id', 'category_id',
    ];
    
    public $sortable = ['id', 'title', 'sort', 'created_at', 'updated_at', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class)->withTrashed();
    }
}
