<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Biodata extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['last_educations', 'training_histories', 'work_histories'];

    public function last_educations() : HasMany
    {
        return $this->hasMany(LastEducation::class, 'biodata_id');
    }

    public function training_histories() : HasMany
    {
        return $this->hasMany(TrainingHistory::class, 'biodata_id');
    }

    public function work_histories() : HasMany
    {
        return $this->hasMany(WorkHistory::class, 'biodata_id');
    }
}
