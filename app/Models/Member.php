<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members_2";
    protected $connection = "second_mysql";
}
