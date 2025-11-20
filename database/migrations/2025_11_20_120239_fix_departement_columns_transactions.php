<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            if (!Schema::hasColumn('transactions', 'departement_name')) {
                $table->string('departement_name')->nullable()->after('departement_id');
            }

            if (!Schema::hasColumn('transactions', 'departement_semester')) {
                $table->integer('departement_semester')->nullable()->after('departement_name');
            }

            if (!Schema::hasColumn('transactions', 'departement_cost')) {
                $table->integer('departement_cost')->nullable()->after('departement_semester');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'departement_name',
                'departement_semester',
                'departement_cost',
            ]);
        });
    }
};
