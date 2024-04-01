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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->foreignId('creator_id')->constrained('users');
            $table->foreignId('responsible_id')->nullable()->constrained('users');
            $table->foreignId('status_id')->constrained('risk_statuses');
            $table->foreignId('priority_id')->constrained('risk_priorities');
            $table->foreignId('project_id')->constrained('projects');
            $table->float('estimation')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('risks');
    }
};
