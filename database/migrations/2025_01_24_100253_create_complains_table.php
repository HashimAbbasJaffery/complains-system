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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->string("cnic");
            $table->text("complain");
            $table->foreignId("type_id")->constrained("complain_types")->cascadeOnDelete();
            $table->foreignId("question_id")->constrained("questions")->cascadeOnDelete();
            $table->string("membership_number");
            $table->boolean("highlighted")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
