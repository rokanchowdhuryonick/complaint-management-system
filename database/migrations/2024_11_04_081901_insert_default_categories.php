<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert predefined categories
        DB::table('categories')->insert([
            ['name' => 'Billing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Service Issue', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Product Issue', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->whereIn('name', ['Billing', 'Service Issue', 'Product Issue'])->delete();
    }
};
