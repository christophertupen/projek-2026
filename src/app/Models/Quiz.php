<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasManyThrough(QuestionAttempt::class, Question::class);
    }


}
