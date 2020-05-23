<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class HandoverLog extends Model
{
    use Sortable;
    protected $table = 'handover_log';
    protected $fillable = [
        'handover_id',
        'employee_id',
        'request_ref',
        'handover_date',
        'request_emp',
        'approved_emp',
        'handovered_emp',
        'file_path',
        'operation',
        'user_id'
    ];

    public $sortable = ['id', 'created_at'];
}
