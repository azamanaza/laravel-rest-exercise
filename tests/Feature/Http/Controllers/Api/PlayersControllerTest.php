<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayersControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetPlayers()
    {
        $response = $this->get('/api/players');
        $response->assertStatus(200);
        $this->assertTrue(! empty($response->getContent()));
    }

    /**
     * @return void
     */
    public function testGetPlayerDetail()
    {
        $response = $this->get('/api/players/2');
        $player = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertTrue(! empty($player));
        $this->assertTrue($player->id === 2);
    }
}
