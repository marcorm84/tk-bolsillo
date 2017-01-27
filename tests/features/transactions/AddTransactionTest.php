<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddTransactionTest extends TestCase
{
    use DatabaseMigrations;

    /**
    @test
    **/
    public function user_can_add_expenses()
    {
        $user = factory(User::class)->create();

        $this->getAccounts();

        $this->be($user);

        TransactionType::create(['name' => 'Income']);
        TransactionType::create(['name' => 'Expenses']);

        Category::create(['name' => 'Salary', 'transaction_type_id' => 1]);
        Category::create(['name' => 'Savings', 'transaction_type_id' => 1]);

        Category::create(['name' => 'Food', 'transaction_type_id' => 2]);
        Category::create(['name' => 'Games', 'transaction_type_id' => 2]);

        $this->json('post', 'transactions', [
            'account_id' => 1,
            'title' => 'pack empanadas + coca cola',
            'amount' => '12.50',
            'type' => 2,
            'category' => 3,
            'labels' => ['empanadas', 'metro', 'tk'],
            'description' => 'empanadas en metro de tarata'
        ]);

        $this->assertResponseStatus(200);

        $this->seeInDatabase('transactions', ['title' => 'pack empanadas + coca cola');
    }
}
