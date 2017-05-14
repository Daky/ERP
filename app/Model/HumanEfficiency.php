<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;

class HumanEfficiency extends Model
{
    protected $fillable = [
        'data_date','time_region','machine_no','yard', 'kind', 'memo', 'user_id',
    ];
}
