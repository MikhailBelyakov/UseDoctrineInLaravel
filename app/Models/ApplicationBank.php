<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationBank extends Model
{
    protected $table = 'application_banks';

    protected $fillable = [
        'name',
        'code',
        'status',
    ];
}
