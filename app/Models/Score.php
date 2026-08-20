<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['student_id','exam_type_id','subject_id','score','max_score'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    public function examType() {
        return $this->belongsTo(ExamType::class);
    }
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
