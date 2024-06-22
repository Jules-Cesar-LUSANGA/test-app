<?php

use App\Models\Assertion;
use App\Models\Presentation\Response;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('response_assertions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Response::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Assertion::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_assertions');
    }
};
