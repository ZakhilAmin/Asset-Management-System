<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Unit extends Model implements Searchable
{
    use Sortable;
    protected $table = 'units';
    protected $fillable = [
        'unit'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('units.search', $this->id);

        return new SearchResult(
            $this,
            $this->unit,
            $url
         );
    }

    public function stock(){
        return $this->hasOne('App\Stock');
    }

}
