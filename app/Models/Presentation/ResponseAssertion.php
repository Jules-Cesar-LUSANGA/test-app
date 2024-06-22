<?php

namespace App\Models\Presentation;

use App\Models\Assertion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseAssertion extends Model
{
    use HasFactory;

    protected $fillable = ['assertion_id'];

    public function questionAssertion() : BelongsTo
    {
        return $this->belongsTo(Assertion::class, 'assertion_id');
    }
}
