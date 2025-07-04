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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->string('detail')
                ->nullable();

            $table->integer('quantity_in')
                ->default(0);

            $table->integer('cost_in')
                ->default(0);

            $table->integer('total_in')
                ->default(0);

            $table->integer('quantity_out')
                ->default(0);

            $table->integer('cost_out')
                ->default(0);

            $table->integer('total_out')
                ->default(0);

            $table->integer('quantity_balance')
                ->default(0);

            $table->integer('cost_balance')
                ->default(0);

            $table->integer('total_balance')
                ->default(0);

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->morphs('inventoryable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
