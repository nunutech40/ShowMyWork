<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = ['id_alogritma', 'step', 'imageStep', 'desc', 'step_number'];
}
