<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class);
    }

    public function quizzes()
    {
        return $this->hasManyThrough(Quiz::class, QuestionBank::class);
    }

}
