<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained()->onDelete('cascade');
            $table->string('email')->index();
            $table->string('name');
            $table->string('role');
            $table->string('token')->unique();
            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('board_invitations');
    }
};
