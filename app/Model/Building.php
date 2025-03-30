<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'user_id'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'building_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}