<?php

namespace App\Models;

use App\Models\Presentation\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submition extends Model
{
    use HasFactory;

    protected $fillable = ['finished'];
    
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
