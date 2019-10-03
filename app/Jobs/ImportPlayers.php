<?php

namespace App\Jobs;

use App\Models\PlayerModel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ImportPlayers {

    private $client;
    private $playerModel;

    public function __construct(Client $client = null, PlayerModel $playerModel = null) {
        if ($client) {
            $this->client = $client;
        }

        if ($playerModel) {
            $this->playerModel = $playerModel;
        }
    }
    public function __invoke() {
        $data = $this->getData();
        $this->insertToDb($data);
    }

    private function getData() {
        $options = [
            'headers' => [
                'User-Agent' => 'PHP/Laravel/fantasyfootball'
            ]
        ];
        $res = $this->getClient()->request('GET', config('app.import_players.url'), $options);
        $data = $this->parseResponse($res);
        return $data[config('app.import_players.prop')];
    }

    private function parseResponse($response) {
        return config('app.import_players.content_type') === 'json' ? json_decode($response->getBody(), true) :
            //do xml parse
            $response->getBody();
        ;
    }

    private function insertToDb($data) {
        $model = $this->getModel();
        $allPlayerIds = array_map(function($player){
            return $player['id'];
        }, $model::all(['id'])->toArray());
        $data = array_filter($data, function($player) use ($allPlayerIds) {
            return !in_array($player['id'], $allPlayerIds);
        });
        $next100 = array_slice($data, 0, 100);
        return $model->bulkUpsert(array_slice($data, 0, 100));
    }

    private function getClient() {
        if (! $this->client) {
            $this->client = new Client();
        }
        return $this->client;
    }

    private function getModel() {
        if (! $this->playerModel) {
            $this->playerModel = new PlayerModel();
        }
        return $this->playerModel;
    }
}