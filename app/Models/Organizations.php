<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;

class Organizations extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ogrn', 'oktmo'];
}
