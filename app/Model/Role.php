<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['admin', 'employee'];

    public function getRoleNameAttribute()
    {
        return $this->admin ? 'Администратор' : 'Сотрудник';
    }
}