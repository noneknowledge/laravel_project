<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocab extends Model
{
    use HasFactory;
    protected $table = 'vocabulary';
    protected $primaryKey = 'VocabID';
  
    public $timestamps = false;
    const UPDATED_AT = null;

    public function userlessions()
    {
        return $this->hasMany(UserProgress::class,'VocabID');
    }

    public function lessions()
    {
        return $this->belongsto(lession::class,'LessionID');
    }

}
