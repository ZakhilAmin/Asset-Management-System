<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Handover extends Model implements Searchable
{
    use SoftDeletes;
    use Sortable;
    protected $table = 'handover';
    protected $fillable = [
        'employee_id',
        'request_ref',
        'handover_date',
        'request_emp',
        'approved_emp',
        'handovered_emp',
        'file_path'
    ];

    public $sortable = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('handovers.search', $this->id);

        return new SearchResult(
            $this,
            $this->request_ref,
            $url
         );
    }
    
    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
