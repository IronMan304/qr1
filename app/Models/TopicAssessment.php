<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicAssessment extends Model
{
    protected $fillable = ['student_id','subject_id','exam_type_id','weight','grade','points'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }
}
