<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    protected $table = 'reading';
    protected $primaryKey = 'ReadID';
  
    public $timestamps = false;
    const UPDATED_AT = null;

    public function userlessions()
    {
        return $this->hasMany(UserProgress::class,'ReadingId');
    }

    public function lessions()
    {
        return $this->belongsto(lession::class,'LessionID');
    }
}
