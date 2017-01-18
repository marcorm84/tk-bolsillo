<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class CreateAccountTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register_an_account()
    {
        $user = factory(User::class)->create();
        $currency_soles   = Currency::create(['name' => 'Soles']);
        $currency_dollars = Currency::create(['name' => 'Dollars']);
        $account_type_coins       = AccountType::create(['name' => 'Coins']);
        $account_type_credit_card = AccountType::create(['name' => 'Credit Card']);

        $this->actingAs($user);

        $this->visit('/accounts/add')
             ->see('Soles')
             ->see('Dolares')
             ->see('Coins')
             ->see('Credit Card');

        $this->type('Pocket', 'name')
             ->select($currency_soles->id, 'currency_id')
             ->type('', 'description')
             ->type('0.00', 'balance')
             ->select($account_type_coins->id, 'type_id')
             ->press('Add');

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');
    }
}
