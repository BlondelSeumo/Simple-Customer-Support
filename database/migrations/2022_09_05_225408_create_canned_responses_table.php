<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canned_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Agent::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->json('shortcuts')->nullable();
            $table->boolean('is_private')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canned_responses');
    }
};
