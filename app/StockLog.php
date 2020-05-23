<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class StockLog extends Model
{
    use Sortable;
    protected $table = 'stock_log';
    protected $fillable = [
        'stock_id',
        'serial_no',
        'product_id',
        'tag_no',
        'cost',
        'contract_date',
        'receive_date',
        'class_id',
        'm7',
        'm16',
        'unit_id',
        'quantity',
        'status_id',
        'project_id',
        'department_id',
        'donar_id',
        'location_id',
        'expected_life',
        'description',
        'operation',
        'user_id'
    ];

    public $sortable = ['id', 'created_at'];
}
