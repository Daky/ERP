<?php

namespace ERP\Model\Manage;

use Illuminate\Database\Eloquent\Model;
//use Zizaco\Entrust\EntrustRole;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];
}