<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lession extends Model
{
    use HasFactory;
    protected $table = 'lession';
    protected $primaryKey = 'LessionId';
    
    public function vocabs()
    {
        return $this->hasMany(Vocab::class,'LessionID');
    }
    public function reading()
    {
        return $this->hasMany(Reading::class,'LessionID');
    }
    public function sentence()
    {
        return $this->hasMany(Sentence::class,'LessionID');
    }


}
