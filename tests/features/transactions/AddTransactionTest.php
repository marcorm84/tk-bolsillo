<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddTransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseMigrations;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
    @test
    **/
    public function user_can_add_income()
    {

        $accounts = $this->getAccounts();

        $this->call('post', 'transactions', [
            'account_id' => 1,
            'title' => 'pack empanadas + coca cola',
            'amount' => '12.50',
            'type' => 2,
            'category' => 1,
            'labels' => ['empanadas', 'metro', 'tk'],
            'description' => 'empanadas en metro de tarata'
        ]);

        $this->assertResponseStatus(200);
    }
}
