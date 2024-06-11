<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminApi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tawk_to',
        'paymongo_secret_key',
    ];
}
