<?php


use App\Models\Library;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Library::class);
            $table->string('name')->unique;
            $table->string('description');
            $table->enum('classification', ['municipal', 'state']);
            $table->string('author');
            $table->string('publisher');
            $table->bigInteger('amount')->default(0);
            $table->string('avatar')->nullable();
            $table->enum('status', ['inactive', 'active','rented'])->default('active');
            $table->json('place')->nullable(); // { shelf: 1, row: 1, column: 1 }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
