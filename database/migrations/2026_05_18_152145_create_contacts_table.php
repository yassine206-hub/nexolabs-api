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
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string('prenom');
        $table->string('nom');
        $table->string('contact'); // email ou whatsapp
        $table->string('secteur')->nullable();
        $table->string('service')->nullable();
        $table->text('message')->nullable();
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}
};
