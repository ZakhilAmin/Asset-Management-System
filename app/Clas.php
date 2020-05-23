<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Clas extends Model implements Searchable
{
    use Sortable;
    protected $table = 'class';
    protected $fillable = [
        'class'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('class.search', $this->id);

        return new SearchResult(
            $this,
            $this->class,
            $url
         );
    }

    public function stock(){
        return $this->belongsTo('App\Stock');
    }

    public function returns(){
        return $this->hasMany('App\Returns');
    }
}
