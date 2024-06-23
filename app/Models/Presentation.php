<?php

namespace App\Models;

use App\Models\Presentation\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'finished'];

    /**
     * Get the user that owns the Presentation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the exam that owns the Presentation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get all of the responses for the Presentation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}
