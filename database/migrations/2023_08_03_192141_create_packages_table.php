<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(Uuid::uuid4());;
            $table->string('name')->unique();
            $registrationLimit = rand(3, 8);
            $table->unsignedInteger('limit')->default($registrationLimit);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
