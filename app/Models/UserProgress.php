<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $table = 'userprogress';
    protected $primaryKey = 'Id';
    protected $fillable = [ 'UserID','VocabId','SentenceId','ReadingId','IsTrue','AdditionalAnswer'];
    public $timestamps = false;
    const UPDATED_AT = null;

    public function vocabs()
    {
      return $this->belongsTo(Vocab::class, 'VocabID');
    }

    public function sentences()
    {
      return $this->belongsTo(Sentence::class, 'SenID');
    }

    public function readings()
    {
      return $this->belongsTo(Reading::class, 'ReadID');
    }

}
