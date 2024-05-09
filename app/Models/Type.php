<?php

namespace App\Models;

use App\Traits\CreatedByUpdatedByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    // use CreatedByUpdatedByTrait;

    protected $guarded = [];
}
