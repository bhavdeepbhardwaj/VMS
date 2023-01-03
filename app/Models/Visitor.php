<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitorID',
        'name',
        'email',
        'phone',
        'host',
        'purpose',
        'pic',
        'companyCode',
        'address',
        'companyLogo'
    ];
}
