<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id_number','first_name','middle_name','last_name','gender_id','course_id'
    ];

    public function gender() {
        return $this->belongsTo(Gender::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function scores() {
    return $this->hasMany(Score::class);
}

   public function topicAssessments() {
    return $this->hasMany(TopicAssessment::class);
}
public function moduleAssessments() {
    return $this->hasMany(ModuleAssessment::class);
}



}
