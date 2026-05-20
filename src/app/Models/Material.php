<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'subject_id', 'description', 'file_url'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
