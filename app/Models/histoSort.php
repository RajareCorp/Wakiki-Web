<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histoSort extends Model
{
    use HasFactory;

    protected $table = 'histosort';
    protected $primaryKey = 'idSort';
    public $timestamps = false;

    public function sort()
    {
        return $this->hasOne(Sort::class, 'id', 'idSort');
    }

    public function player()
    {
        return $this->hasOne(Player::class, 'id', 'idPlayer');
    }

}