<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'admin',
        'employee'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}