<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;


class Project extends Model implements Searchable
{
    use Sortable;
    protected $table = 'project';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status_id'
    ];

    public $sortable = ['id'];
    
    public function getSearchResult(): SearchResult
    {
        $url = route('projects.search', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
         );
    }

    public function employees(){
        return $this->hasMany('App\Employee');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }
}
