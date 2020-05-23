<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Department extends Model implements Searchable
{
    use Sortable;
    protected $table = 'department';
    protected $fillable = [
        'department'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('department.search', $this->id);

        return new SearchResult(
            $this,
            $this->department,
            $url
         );
    }

    public function employees(){
        return $this->hasMany('App\Employee');
    }
}
