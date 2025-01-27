<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $guarded = [ "id", "created_at", "updated_at" ];
    protected $with = [ "question" ];
    public function type() {
        return $this->belongsTo(ComplainType::class);
    }
    public function question() {
        return $this->belongsTo(Question::class);
    }
    public function member() {
        return $this->belongsTo(Member::class, "cnic_passport")->on("second_mysql");
    }
}
