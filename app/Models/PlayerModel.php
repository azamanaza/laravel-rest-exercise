<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'player';

    /**
     * The table associated with the model.
     *
     * @var integer
     */
    protected $primaryKey = 'id';

    public function bulkUpsert(Array $players) {
        $allPlayers = $this::all();
        return $this::insert(array_slice($players, 1, 100));
    }
}
