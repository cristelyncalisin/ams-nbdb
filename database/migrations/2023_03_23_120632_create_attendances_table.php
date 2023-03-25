<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = "
            SELECT 
                employee_id,
                DATE(time_entry) AS date_entry, 
                TIME(MIN(time_entry)) AS time_in, 
                CASE
                    when TIME_FORMAT(TIME(MIN(time_entry)), '%h:%i %p') = TIME_FORMAT(TIME(MAX(time_entry)), '%h:%i %p') THEN null
                    else TIME(MAX(time_entry))
                END AS  time_out,
                MIN(source) as source
            FROM (
                SELECT	employee_id, `timestamp` AS time_entry, 'Biometrics' as source
                FROM	biometrics
                
                UNION
                
                SELECT	employee_id, `timestamp` AS time_entry, 'Google Forms' as source
                FROM	g_forms
            ) main
            GROUP BY employee_id, DATE(time_entry)
        ";
        Schema::createView('v_merged_attendance', $query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_merged_attendance');
    }
};
