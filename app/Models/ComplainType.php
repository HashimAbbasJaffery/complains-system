<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Complain;

class ComplainType extends Model
{
    use HasFactory;

    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function complains() {
        return $this->hasMany(Complain::class, "type_id");
    }
}
