<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Returns extends Model
{
    use Sortable;
    protected $table = 'returns';
    protected $fillable = [
        'product_id',
        'return_date',
        'tag_no',
        'employee_id',
        'class_id',
        'status_id',
        'returned_emp',
        'quantity',
    ];

    public $sortable = ['id'];

    public function clas(){
        return $this->belongsTo('App\Clas');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
    
}
