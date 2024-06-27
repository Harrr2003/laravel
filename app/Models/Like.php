<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fileable = ['user_id', 'post_id'];
    public $timestamps = false;
    protected $guarded = [];
}
