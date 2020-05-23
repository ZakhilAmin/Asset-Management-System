<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Location extends Model implements Searchable
{
    use Sortable;
    protected $table = 'location';
    protected $fillable = [
        'name'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('location.search', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
         );
    }
}
