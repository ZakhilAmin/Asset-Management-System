<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Donar extends Model implements Searchable
{
    use Sortable;
    protected $table = 'donar';
    protected $fillable = [
        'name'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('donar.search', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
         );
    }

}
