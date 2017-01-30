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

    function setUp()
    {
        parent::setUp();
        Currency::create(['name' => 'Soles']);
        Currency::create(['name' => 'Dollars']);
    }

    /** @test */
    function user_can_register_an_account()
    {
        $this->actingAs(factory(User::class)->create());

        $this->visit('/my-accounts/add')
             ->see('Soles')
             ->see('Dollars');

        $this->type('Pocket', 'name')
             ->select(1, 'currency_id')
             ->type('', 'description')
             ->type('0.00', 'balance')
             ->press('Add');

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');
    }

    /** @test */
    function user_can_register_an_account_with_collaborators()
    {
        $this->actingAs(factory(User::class)->create());

        $this->post('/my-accounts/add', [
            'name' => 'Pocket',
            'currency_id' => 1,
            'description' => 'bolsillo',
            'balance' => 100.0,
            'collaborators' => [
                'test@example.com',
                'prueba@prueba.com',
                'admin@admin.com',
                'larry@tekton.com'
            ],
        ]);

        $this->followRedirects();

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');

        $this->seeInDatabase('account_collaborators', ['email' => 'test@example.com']);
        $this->seeInDatabase('account_collaborators', ['email' => 'prueba@prueba.com']);
        $this->seeInDatabase('account_collaborators', ['email' => 'admin@admin.com']);
        $this->seeInDatabase('account_collaborators', ['email' => 'larry@tekton.com']);
    }

    /** @test */
    function user_cannot_register_an_account_without_name()
    {
        $this->actingAs(factory(User::class)->create());

        $this->post('/my-accounts/add', [
            'currency_id' => 1,
            'description' => 'bolsillo',
            'balance' => 100.0,
        ]);

        $this->followRedirects();

        $this->seePageIs('/my-accounts/add')
             ->see('The name field is required.');
    }

    /** @test */
    function user_cannot_register_an_account_without_currency()
    {
        $this->actingAs(factory(User::class)->create());

        $this->post('/my-accounts/add', [
            'name' => 'Pocket',
            'description' => 'bolsillo',
            'balance' => 100.0,
        ]);

        $this->followRedirects();

        $this->seePageIs('/my-accounts/add')
             ->see('The currency field is required.');
    }

    /** @test */
    function user_can_register_an_account_without_description()
    {
        $this->actingAs(factory(User::class)->create());

        $this->post('/my-accounts/add', [
            'name' => 'Pocket',
            'currency_id' => 1,
            'balance' => 100.0,
        ]);

        $this->followRedirects();

        $this->seePageIs('/my-accounts')
             ->see('Account added successfully.');
    }
}
