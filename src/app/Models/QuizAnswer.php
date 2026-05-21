<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    public function attempt()
    {
        return $this->belongsTo(QuestionAttempt::class, 'question_attempt_id');
    }

    public function questionn()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }
}
