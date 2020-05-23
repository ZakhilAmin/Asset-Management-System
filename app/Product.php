<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{ 
    use Sortable;
    protected $table = 'product';
    protected $fillable = [
        'product',
        'manufacturer',
        'brand',
        'model',
        'category_id'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('products.search', $this->id);

        return new SearchResult(
            $this,
            $this->product.'-'.$this->manufacturer.'-'.$this->model.'-'.$this->brand,
            $url
         );
    }

    public function stocks(){
        return $this->hasMany('App\Stock');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function returns(){
        return $this->hasMany('App\Returns');
    }

}
