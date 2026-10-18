<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bill_of_materials') && ! Schema::hasColumn('bill_of_materials', 'uom_id')) {
            Schema::table('bill_of_materials', function (Blueprint $table) {
                $table->foreignId('uom_id')->nullable()->after('product_id')->constrained('units_of_measure');
            });
        }

        if (Schema::hasTable('manufacturing_orders') && ! Schema::hasColumn('manufacturing_orders', 'uom_id')) {
            Schema::table('manufacturing_orders', function (Blueprint $table) {
                $table->foreignId('uom_id')->nullable()->after('product_id')->constrained('units_of_measure');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('manufacturing_orders') && Schema::hasColumn('manufacturing_orders', 'uom_id')) {
            Schema::table('manufacturing_orders', function (Blueprint $table) {
                $table->dropForeign(['uom_id']);
                $table->dropColumn('uom_id');
            });
        }

        if (Schema::hasTable('bill_of_materials') && Schema::hasColumn('bill_of_materials', 'uom_id')) {
            Schema::table('bill_of_materials', function (Blueprint $table) {
                $table->dropForeign(['uom_id']);
                $table->dropColumn('uom_id');
            });
        }
    }
};
