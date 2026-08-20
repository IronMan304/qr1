<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['student_id','subject_id','assessment_type_id','weight','grade','points'];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
    public function assessmentType() {
        return $this->belongsTo(AssessmentType::class);
    }
}
