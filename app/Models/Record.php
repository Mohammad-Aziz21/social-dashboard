<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    use CreatedByUpdatedByTrait;

    protected $guarded = [];

    public function type() { 
        return $this->belongsTo(Type::class,'type_id'); 
    }

    public function created_by_name() { 
        return $this->belongsTo(User::class,'created_by'); 
    }
}
