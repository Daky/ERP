<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
