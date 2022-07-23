<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Blog extends Model
{
    use SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'subtitle', 'description', 'thumbnail', 'sort', 'status', 'admin_id', 'views',
    ];
    
    public $sortable = ['id', 'title', 'sort', 'created_at', 'updated_at'];

    public function admin() {
        return $this->belongsTo(Admin::class)->withTrashed();
    }
}
