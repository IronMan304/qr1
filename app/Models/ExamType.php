<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['name'];

    public function topicAssessments()
    {
        return $this->hasMany(TopicAssessment::class);
    }
}
