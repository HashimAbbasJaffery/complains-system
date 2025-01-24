<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    public function type() {
        return $this->belongsTo(ComplainType::class);
    }
}
