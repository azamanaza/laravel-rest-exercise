<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayerModel;

class PlayersController extends Controller
{
    private $playerModel;

    public function __construct(PlayerModel $playerModel) {
        $this->playerModel = $playerModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->playerModel::all('id','first_name', 'second_name')->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->playerModel::find($id)->toJson();
    }

}
