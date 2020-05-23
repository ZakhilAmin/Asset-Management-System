<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Kyslik\ColumnSortable\Sortable;

class Stock extends Model implements Searchable
{
    use SoftDeletes;
    use Sortable;
    protected $table = 'stock';
    protected $fillable = [
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
        'description'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('stock.search', $this->id);

        return new SearchResult(
            $this,
            $this->serial_no.'-'.$this->tag_no,
            $url
         );
    }

    public function unit(){
        return $this->belongsTo('App\Unit');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function clases(){
        return $this->hasMany('App\Clas');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

}
