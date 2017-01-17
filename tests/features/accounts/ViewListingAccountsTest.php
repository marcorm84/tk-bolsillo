<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Account;
use App\User;

class ViewListingAccountsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_its_listing_accounts()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        Account::create([
            'name'        => 'bolsillo',
            'balance'     => 0.50,
            'user_id'     => 1,
            'type_id'     => 1,
            'currency_id' => 1,
            'icon'        => 'default1.jpg'
        ]);

        Account::create([
            'name'        => 'banco',
            'balance'     => 850.00,
            'user_id'     => 1,
            'type_id'     => 2,
            'currency_id' => 2,
            'icon'        => 'default2.jpg'
        ]);

        $this->visit('/my-accounts');

        $this->see('bolsillo')
             ->see('S/ 0.50')
             ->see('banco')
             ->see('$ 850.00');
    }
}
