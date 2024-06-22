<?php

namespace App\Models\Presentation;

use App\Models\Assertion;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'assertion_id',
        'content',
        'points',
    ];

    /**
     * Get the question that owns the Response
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the assertion that owns the Response
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assertions(): HasMany
    {
        return $this->hasMany(ResponseAssertion::class);
    }
}
