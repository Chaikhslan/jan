<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['user_id', 'started_at', 'finished_at', 'score'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
