<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HandoverDetails extends Model
{
    protected $table = 'handover_details';
    protected $fillable = [
        'handover_id',
        'product_id',
        'tag_no',
        'quantity',
        'remarks'
    ];
}
