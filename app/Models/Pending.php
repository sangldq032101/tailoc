<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    use HasFactory;
    protected $primaryKey = 'pendingID';
    public $incrementing = false;
    protected $table = "pending";
    protected $fillable = [
        'rentalName',
        'phoneNumber'
    ];
}
