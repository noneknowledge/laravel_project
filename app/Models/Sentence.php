<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;
    protected $table = 'sentence';
    protected $primaryKey = 'SenID';
  
    public $timestamps = false;
    const UPDATED_AT = null;

    public function userlessions()
    {
        return $this->hasMany(UserProgress::class,'SentenceId');
    }

    public function lessions()
    {
        return $this->belongsto(lession::class,'LessionID');
    }
}
