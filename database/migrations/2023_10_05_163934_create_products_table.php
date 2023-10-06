<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //php artisan migrate 시 실행되는 함수
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->default('');
            $table->string('content', 256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void //php artisan migrate:rollback 시 사용되는 함수, 해당 테이블명을 삭제함
    {
        Schema::dropIfExists('products');
    }
};
