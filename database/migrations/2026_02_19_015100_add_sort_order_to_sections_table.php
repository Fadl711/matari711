<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('parent_id');
        });

        // ترتيب الأقسام الحالية تلقائياً
        $sections = DB::table('sections')->orderBy('id')->get();
        foreach ($sections as $index => $section) {
            DB::table('sections')->where('id', $section->id)->update(['sort_order' => $index + 1]);
        }
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
