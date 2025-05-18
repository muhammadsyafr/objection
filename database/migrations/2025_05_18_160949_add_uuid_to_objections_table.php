<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Objection;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('objections', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->nullable();
        });

        // Add UUID to existing records
        Objection::whereNull('uuid')->each(function ($objection) {
            $objection->uuid = (string) Str::uuid();
            $objection->save();
        });

        // Make UUID unique after all records have UUID
        Schema::table('objections', function (Blueprint $table) {
            $table->unique('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objections', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
