<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Status extends Model implements Searchable
{ 
    use Sortable;
    protected $table = 'status';
    protected $fillable = [
        'status'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('status.search', $this->id);

        return new SearchResult(
            $this,
            $this->status,
            $url
         );
    }

    public function stocks(){
        return $this->hasMany('App\Stock');
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function returns(){
        return $this->hasMany('App\Returns');
    }
}
