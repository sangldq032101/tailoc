<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rented extends Model
{
    use HasFactory;
    protected $primaryKey = 'rentedID';
    public $incrementing = false;
    protected $table = "rented";
    protected $fillable = [
        'rentalName',
        'phoneNumber'
    ];
}
