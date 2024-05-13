<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLession extends Model
{
    use HasFactory;
    
    protected $table = 'userlession';
    protected $primaryKey = 'UserLessionId';
    protected $fillable = ['HighScore', 'UserID','LessionID','Comment','Status','CommentDate','CompleteDate'];
    public $timestamps = false;
    const UPDATED_AT = null;

  
    
}
