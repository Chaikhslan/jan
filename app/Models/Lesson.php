<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}
