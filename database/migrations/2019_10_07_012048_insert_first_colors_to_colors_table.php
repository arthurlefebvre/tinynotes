<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Color;

class InsertFirstColorsToColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {

            Color::create([
                'name' => 'Bleu',
                'color_code' => 'lightblue'
            ]);

            Color::create([
                'name' => 'Vert',
                'color_code' => 'lightgreen'
            ]);

            Color::create([
                'name' => 'Jaune',
                'color_code' => '#ffff88'
            ]);

            Color::create([
                'name' => 'Orange',
                'color_code' => 'lightsalmon'
            ]);

            Color::create([
                'name' => 'Rouge',
                'color_code' => 'lightcoral'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colors', function (Blueprint $table) {
            //
        });
    }
}
