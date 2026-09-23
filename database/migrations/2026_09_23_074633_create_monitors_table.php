<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('url_or_ip');
            $table->enum('type', ['http', 'ping', 'port', 'keyword'])->default('http');
            $table->integer('check_interval')->default(5);
            $table->integer('timeout')->default(30);
            $table->enum('status', ['up', 'down', 'paused'])->default('up');
            $table->integer('last_response_time')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};