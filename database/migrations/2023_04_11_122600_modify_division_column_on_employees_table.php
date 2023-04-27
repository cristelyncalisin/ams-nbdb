<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `employees` MODIFY COLUMN `division` ENUM('OOGB', 'OOED', 'AFMD', 'PIRD', 'READ', 'CPDD', 'INDD', 'BTTD', 'PRED', 'AFSD', 'CITD', 'OD', 'OED', 'OC') NOT NULL DEFAULT 'OOGB';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
