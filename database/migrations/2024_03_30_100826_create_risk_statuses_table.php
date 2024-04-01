<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#cecece');
            $table->boolean('is_default')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->integer('order')->default(1);
            $table->foreignId('project_id')->nullable()->constrained('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_statuses');
    }
};
