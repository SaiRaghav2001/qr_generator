<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('qr_codes', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description')->nullable();
      $table->string('url');
      $table->text('qr_code_image')->nullable(); // Base64 encoded image
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('qr_codes');
  }
};
