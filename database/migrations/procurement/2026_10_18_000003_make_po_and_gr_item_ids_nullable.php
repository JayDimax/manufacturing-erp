<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('goods_receipt_items', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_item_id')->nullable()->change();
        });

        Schema::table('supplier_return_items', function (Blueprint $table) {
            $table->unsignedBigInteger('goods_receipt_item_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('supplier_return_items', function (Blueprint $table) {
            $table->unsignedBigInteger('goods_receipt_item_id')->nullable(false)->change();
        });

        Schema::table('goods_receipt_items', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_item_id')->nullable(false)->change();
        });
    }
};
