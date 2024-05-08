<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessionTest extends Model
{
    use HasFactory;
    protected $table = 'lession';
    protected $primaryKey = 'LessionId';
}
