<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = ['surname', 'name', 'patronymic', 'birthdate', 'inn', 'snils',];

    public function Organizations()
    {
        return $this->belongsToMany(Organizations::class, 'organization_user', 'user_id', 'organization_id');
    }
}
