<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDirectionType extends Model
{
    protected $table = 'application_banks';

    protected $fillable = [
        'name',
    ];
}
