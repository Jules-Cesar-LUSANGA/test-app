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

    // Recupérer les bonnes assertions de la question
    public function getGoodAssertions()
    {
        // Recupérer les assertions dont le champ isAnswer = True
        $assertions = $this->assertions()
                            ->whereHas('questionAssertion', function($query){
                                $query->where('isAnswer', true);
                            })->count();
        
        // Récupérer les nombre d'assertions de la question
        $questionAssertions = $this->question->assertions()->where('isAnswer', true)->count();

        // A partir de assertions de la réponse et les assertions de la question, et les points de chaque question,  calculer le nombre de points
        $points = $assertions / $questionAssertions * $this->question->points;

        return $points;
    }
}
