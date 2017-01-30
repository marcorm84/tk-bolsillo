<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Currency;
use App\AccountType;

class CreateAccountTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register_an_account()
    {
        $user = factory(User::class)->create();
        $currency_soles   = Currency::create(['name' => 'Soles']);
        $currency_dollars = Currency::create(['name' => 'Dollars']);

        $this->actingAs($user);

        $this->visit('/my-accounts/add')
             ->see('Soles')
             ->see('Dollars');

        $this->type('Pocket', 'name')
             ->select($currency_soles->id, 'currency_id')
             ->type('', 'description')
             ->type('0.00', 'balance')
             ->press('Add');

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');
    }
}
