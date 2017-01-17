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

        $this->actingAs($user);

        $this->visit('/accounts/add')
             ->type('Bolsillo', 'name')
             ->select('Soles', 'currency')
             ->type('', 'description')
             ->type('0.00', 'balance')
             ->type('coins', 'type')
             ->press('Add');

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');
    }
}
