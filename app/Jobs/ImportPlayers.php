<?php

namespace App\Jobs;

use App\Models\PlayerModel;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ImportPlayers {

    public function __invoke() {
        $data = $this->getData();
        // var_dump($data);
        $this->insertToDb($data);
    }

    private function getData() {
        $httpClient = new Client();
        $options = [
            'headers' => [
                'User-Agent' => 'PHP/Laravel/fantasyfootball'
            ]
        ];
        $res = $httpClient->request('GET', config('app.import_players.url'), $options);
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
        $allPlayerIds = array_map(function($player){
            return $player['id'];
        }, PlayerModel::all(['id'])->toArray());
        $data = array_filter($data, function($player) use ($allPlayerIds) {
            return !in_array($player['id'], $allPlayerIds);
        });
        $next100 = array_slice($data, 0, 100);
        return (new PlayerModel())->bulkUpsert(array_slice($data, 0, 100));
    }
}