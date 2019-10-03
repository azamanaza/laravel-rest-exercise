<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('chance_of_playing_next_round')->nullable();
            $table->integer('chance_of_playing_this_round')->nullable();
            $table->integer('code')->nullable();
            $table->integer('cost_change_event')->nullable();
            $table->integer('cost_change_event_fall')->nullable();
            $table->integer('cost_change_start')->nullable();
            $table->integer('cost_change_start_fall')->nullable();
            $table->integer('dreamteam_count')->nullable();
            $table->integer('element_type')->nullable();
            $table->float('ep_next', 3, 1)->nullable();
            $table->float('ep_this', 3, 1)->nullable();
            $table->integer('event_points')->nullable();
            $table->string('first_name')->nullable();
            $table->float('form', 3, 1)->nullable();
            $table->boolean('in_dreamteam')->nullable();
            $table->string('news')->nullable();
            $table->string('news_added')->nullable();
            $table->integer('now_cost')->nullable();
            $table->string('photo')->nullable();
            $table->float('points_per_game', 2, 1)->nullable();
            $table->string('second_name')->nullable();
            $table->float('selected_by_percent', 3, 1)->nullable();
            $table->boolean('special')->nullable();
            $table->string('squad_number')->nullable();
            $table->char('status')->nullable();
            $table->integer('team')->nullable();
            $table->integer('team_code')->nullable();
            $table->integer('total_points')->nullable();
            $table->integer('transfers_in')->nullable();
            $table->integer('transfers_in_event')->nullable();
            $table->integer('transfers_out')->nullable();
            $table->integer('transfers_out_event')->nullable();
            $table->float('value_form', 3, 1)->nullable();
            $table->float('value_season', 3, 1)->nullable();
            $table->string('web_name')->nullable();
            $table->integer('minutes')->nullable();
            $table->integer('goals_scored')->nullable();
            $table->integer('assists')->nullable();
            $table->integer('clean_sheets')->nullable();
            $table->integer('goals_conceded')->nullable();
            $table->integer('own_goals')->nullable();
            $table->integer('penalties_saved')->nullable();
            $table->integer('penalties_missed')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->integer('saves')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('bps')->nullable();
            $table->float('influence', 5, 1)->nullable();
            $table->float('creativity', 5, 1)->nullable();
            $table->float('threat', 4, 1)->nullable();
            $table->float('ict_index', 4, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player');
    }
}
