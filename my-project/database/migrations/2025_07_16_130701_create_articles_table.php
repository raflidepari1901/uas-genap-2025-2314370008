<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('title'); // title VARCHAR
            $table->text('content'); // content TEXT
            $table->string('slug')->unique(); // slug VARCHAR UNIQUE
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // category_id INT FK
            $table->boolean('is_publish')->default(false); // is_publish BOOLEAN
            $table->dateTime('published_at')->nullable(); // published_at DATETIME
            $table->timestamps(); // created_at dan updated_at (TIMESTAMP)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

