<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'name', 'description','module_id'];

  public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_subject');
    }
  public function module()
    {
        return $this->belongsTo(Module::class);
    }
  public function topicAssessments()
    {
        return $this->hasMany(TopicAssessment::class);
    }

}

