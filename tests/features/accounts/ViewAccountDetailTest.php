<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TransactionType;
use App\Category;
use App\Account;
use App\Transaction;
use App\Collaborator;
use App\User;
use App\Currency;

class ViewAccountDetailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_account_detail()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        TransactionType::create(['name' => 'Income']);
        TransactionType::create(['name' => 'Expenses']);

        Currency::create([
            'name' => 'Soles',
            'symbol' => 'S/'
        ]);

        Currency::create([
            'name' => 'Dolares' ,
            'symbol' => '$'
        ]);

        Category::create(['name' => 'Salary', 'transaction_type_id' => 1]);

        $account = factory(Account::class)->create([
            'name'    => 'First Account',
            'balance' => 5.00
        ]);

        factory(Transaction::class)->create([
            'type_id' => 2,
            'amount' => 12
        ]);
        factory(Transaction::class)->create([
            'type_id' => 2,
            'amount' => 15
        ]);
        factory(Transaction::class)->create([
            'type_id' => 1,
            'amount' => 20
        ]);

        factory(Collaborator::class)->create(['email' => 'col1@test.com']);
        factory(Collaborator::class)->create(['email' => 'col2@test.com']);
        factory(Collaborator::class)->create(['email' => 'col3@test.com']);

        $this->visit('/my-account/'.$account->id);

        $this->see('First Account')
             ->see('Soles')
             ->see('test test test')
             ->see('S/ 5.00')
             ->see('default.png')
             ->see('col1@test.com')
             ->see('col2@test.com')
             ->see('col3@test.com')
             ->see('Expenses')
             ->see('12')
             ->see('Expenses')
             ->see('15')
             ->see('Income')
             ->see('20');
    }
}