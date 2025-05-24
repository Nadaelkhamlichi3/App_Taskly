<?php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('id_task');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['ToDo', 'Doing', 'Done'])->default('ToDo');
            $table->date('due_date')->nullable();

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id_member')->on('members')->onDelete('cascade');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id_projet')->on('boards')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
