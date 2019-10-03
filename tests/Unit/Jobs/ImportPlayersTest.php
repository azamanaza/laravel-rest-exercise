<?php

namespace Tests\Unit\Jobs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Jobs\ImportPlayers;
use App\Models\PlayerModel;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;

class ImportPlayersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetData()
    {
        $mockResponse = Mockery::mock(Response::class);
        $mockResponse->shouldReceive('getBody')->andReturn(json_encode(['elements' => []]));
        $clientMock = Mockery::mock(Client::class);
        $clientMock->shouldReceive('request')->andReturn($mockResponse);
        $clientMock = Mockery::mock(Client::class);
        $clientMock->shouldReceive('request')->andReturn($mockResponse);
        $playerModelMock = Mockery::mock(PlayerModel::class);
        $mockElo = Mockery::mock('mockElo', [
            'toArray' => []
        ]);
        $playerModelMock->shouldReceive('all')->withArgs([['id']])->andReturn($mockElo);
        $playerModelMock->shouldReceive('bulkUpsert');

        $result = (new ImportPlayers($clientMock, $playerModelMock))();
    }
}
