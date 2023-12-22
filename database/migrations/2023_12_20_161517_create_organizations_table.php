<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('owner_id')->constrained('users');
            // Additional Fields
            $table->json('members')->nullable(); // Assuming members are stored as JSON array
            $table->json('teams')->nullable();   // Assuming teams are stored as JSON array
            $table->json('projects')->nullable(); // Assuming projects are stored as JSON array
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
