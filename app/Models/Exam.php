<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'description',
        'attempts',
        'duration',
        'code',
        'end_at',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get all of the presentations for the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    public function totalPoints()
    {
        return $this->questions->sum(['points']);
    }
}
