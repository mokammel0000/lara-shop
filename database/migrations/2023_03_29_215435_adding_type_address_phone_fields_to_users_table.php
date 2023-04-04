<?php

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->tinyInteger('type')->after('id')->default(1);

            $table->string('phone')->after('email')->nullable();
            // phone can start with zero digits '00', also phone can contain '+'
            
            $table->longText('address')->after('phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropColumn('type');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
};
