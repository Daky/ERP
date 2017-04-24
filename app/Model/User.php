<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['account', 'password', 'email'];

    protected $guarded = ['id'];
}
