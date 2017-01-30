<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use App\Account;

use Auth;

class TransactionController extends Controller
{
    public function add()
    {
        $rules = [
            'title' => 'required|max:50',
        ];

        $this->validate(request(), $rules);

        $account = Account::find(request('account_id'));

        if ($account->balance >= request('amount')) {
            $transaction = new Transaction;
            $transaction->title       = request('title');
            $transaction->account_id  = request('account_id');
            $transaction->type_id     = request('type');
            $transaction->category_id = request('category');
            $transaction->description = request('description');
            $transaction->amount      = request('amount');
            $transaction->user_id     = Auth::user()->id;

            $transaction->save();

            $account->balance -= request('amount');
            $account->save();

            return response()->json([], 200);
        }

        return response()->json([], 400);
    }
}
