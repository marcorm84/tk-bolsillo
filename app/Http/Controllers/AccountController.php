<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Currency;

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
        $currencies    = Currency::all();

        return view('app.accounts.add_account', compact('currencies', 'account_types'));
    }

    public function store()
    {
        $data = request()->all();
        $data['user_id'] = Auth::user()->id;
        $data['icon']    = 'default1.jpg';

        Account::create($data);

        return redirect()->route('my_accounts')->with('message', 'Account added successfully.');
    }
}
