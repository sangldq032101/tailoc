<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'roomID';
    public $incrementing = false;
    protected $table = "rooms";
    protected $fillable = [
        'roomNo',
        'roomPrice',
        'roomImg',
        'state',
        'roomDescription'
    ];
}
