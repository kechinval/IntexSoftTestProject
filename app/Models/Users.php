<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = ['surname', 'name', 'patronymic', 'birthdate', 'inn', 'snils', 'organizations_id'];

    public function Organization()
    {
        return $this->belongsTo(Organizations::class);
    }
}
