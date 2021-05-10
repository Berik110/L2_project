<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;

    protected $fillable = ['name'];
}
