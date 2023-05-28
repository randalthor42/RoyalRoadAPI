<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeyApiScopeTable extends Migration
{
    public function up(): void
    {
        Schema::create('api_key_api_scope', function (Blueprint $table) {
            $table->foreignId('api_key_id')->constrained()->onDelete('cascade');
            $table->foreignId('api_scope_id')->constrained()->onDelete('cascade');
            $table->primary(['api_key_id', 'api_scope_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_key_api_scope');
    }
}
