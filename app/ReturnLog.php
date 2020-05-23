<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ReturnLog extends Model
{
    use Sortable;
    protected $table = 'return_log';
    protected $fillable = [
        'return_id',
        'product_id',
        'return_date',
        'tag_no',
        'employee_id',
        'class_id',
        'status_id',
        'returned_emp',
        'quantity',
        'operation',
        'user_id'
    ];

    public $sortable = ['id', 'created_at'];
}
