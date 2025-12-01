<?php

use App\Models\FinancialPeriod;
use App\Models\Pharmacy;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use App\Models\User;
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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Pharmacy::class);
            $table->foreignIdFor(User::class, 'created_by_id');
            $table->foreignIdFor(StockCategory::class);
            $table->foreignIdFor(StockSubCategory::class);
            $table->foreignIdFor(FinancialPeriod::class);
            $table->text('name');
            $table->text('strength');
            $table->text('manufacturer');
            $table->date('expiry_date');
            $table->text('batch');
            $table->text('storage_condition');
            $table->bigInteger('pack_size');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('barcode')->nullable();
            $table->text('sku')->nullable();
            $table->string('generate_sku')->nullable();
            $table->string('update_sku')->nullable();
            $table->string('gallery')->nullable();
            $table->float('buying_price')->default(0);
            $table->float('selling_price')->default(0);
            $table->bigInteger('original_quantity')->default(0);
            $table->bigInteger('current_quantity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
