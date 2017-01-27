<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;

use Auth;

class TransactionController extends Controller
{
    public function add()
    {
        $transaction = new Transaction;
        $transaction->title       = request('title');
        $transaction->account_id  = request('account_id');
        $transaction->type_id     = request('type');
        $transaction->category_id = request('category');
        $transaction->description = request('description');
        $transaction->amount      = request('amount');
        $transaction->user_id     = Auth::user()->id;

        $transaction->save();

        return response()->json([], 200);
    }
}
