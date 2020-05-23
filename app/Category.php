<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model implements Searchable
{
    use Sortable;
    protected $table = 'category';
    protected $fillable = [
        'category'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.search', $this->id);

        return new SearchResult(
            $this,
            $this->category,
            $url
         );
    }

    public function stocks(){
        return $this->hasMany('App\Stock');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
