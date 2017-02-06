<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Currency;
use App\Collaborator;

use Auth;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->accounts;

        return view('app.accounts.my_accounts', ['accounts' => $accounts]);
    }

    public function create()
    {
        $currencies = Currency::all();

        return view('app.accounts.add_account', compact('currencies'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required',
            'currency'    => 'required',
        ]);

        $account = new Account;
        $account->name        = request('name');
        $account->balance     = request('balance');
        $account->description = request('description');
        $account->currency_id = request('currency');
        $account->icon        = 'default1.jpg';
        $account->user_id     = Auth::user()->id;

        $account->save();

        collect(request('collaborators'))->each(function($collaborator) use($account) {
            Collaborator::create(['email' => $collaborator, 'account_id' => $account->id]);
        });

        return response()->json(['message' => 'Account added successfully.']);
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);

        return view('app.accounts.my_account_detail')->with('account', $account);
    }
}
