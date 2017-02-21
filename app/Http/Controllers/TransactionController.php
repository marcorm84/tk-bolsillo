<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use Carbon\Carbon;
use App\Account;
use App\Label;
use Auth;

class TransactionController extends Controller
{
    public function add()
    {
        $rules = [
            'title' => 'required|max:50',
            'amount' => 'required|gt:0',
            'category' => 'required|exists:categories,id,transaction_type_id,' . request('type'),
            'date' => 'date_format:Y-m-d|before:' . Carbon::tomorrow()->format('Y-m-d')
        ];

        $this->validate(request(), $rules);

        $account = Account::find(request('account_id'));

        $label_ids = [];
        if ($account->balance >= request('amount')) {
            $transaction = new Transaction;
            $transaction->title       = request('title');
            $transaction->account_id  = request('account_id');
            $transaction->type_id     = request('type');
            $transaction->category_id = request('category');
            $transaction->description = request('description');
            $transaction->amount      = request('amount');
            $transaction->date        = request('date', '');
            $transaction->user_id     = Auth::user()->id;

            $transaction->save();

            if (request('labels')) {
                $label_ids = array_map(function ($label) {
                    return Label::firstOrCreate(['name' => $label])->id;
                }, request('labels'));
                $transaction->labels()->attach($label_ids);
            }

            $account->balance -= request('amount');
            $account->save();

            return response()->json([], 200);
        }

        return response()->json([], 400);
    }
}
