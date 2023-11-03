<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histoEffet extends Model
{
    use HasFactory;

    protected $table = 'histoeffet';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function player()
    {
        return $this->hasOne(Player::class, 'id', 'idPlayer');
    }

}