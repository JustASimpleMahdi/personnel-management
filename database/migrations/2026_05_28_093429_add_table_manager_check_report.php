<?php

use App\Models\Report;
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
        Schema::create('manager_check_report', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'manager_id');
            $table->foreignIdFor(Report::class)->constrained()->cascadeOnDelete();
            $table->boolean('seen')->default(false);
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_chcek_report');
    }
};
