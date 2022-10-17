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
            $table->enum('status', ['inactive', 'active','absent'])->default('active');
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
