<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Kyslik\ColumnSortable\Sortable;

class Employee extends Model implements Searchable
{
    use Sortable;
    protected $table = 'employee';
    protected $fillable = [
        'full_name',
        'ref_no',
        'location_id',
        'gender',
        'job_title',
        'project_id',
        'phone',
        'email',
        'department_id'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('employees.search', $this->id);

        return new SearchResult(
            $this,
            $this->full_name.'-'.$this->job_title,
            $url
         );
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function handovers(){
        return $this->hasMany('App\Handover');
    }

    public function returns(){
        return $this->hasMany('App\Returns');
    }

    public function users(){
        return $this->hasOne('App\User');
    }
}
