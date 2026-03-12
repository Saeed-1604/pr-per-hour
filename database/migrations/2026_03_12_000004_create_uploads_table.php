<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('type'); // e.g. payment_proof, logo, etc.
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};