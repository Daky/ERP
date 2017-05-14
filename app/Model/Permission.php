<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = [
        'name', 'display_name', 'description', 'route'
    ];
}