<?php

use App\Models\Pharmacy;
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
        Schema::create('stock_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Pharmacy::class);
            $table->text('name');
            $table->text('description')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->text('image')->nullable();
            $table->float('buying_price')->nullable()->default(0);
            $table->float('selling_price')->nullable()->default(0);
            $table->float('expected_profit')->nullable()->default(0);
            $table->float('earned_profit')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_categories');
    }
};
