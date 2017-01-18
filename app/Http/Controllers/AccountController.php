<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Currency;
use App\AccountType;

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
        $account_types = AccountType::all();

        return view('app.accounts.add_account', compact('currencies', 'account_types'));
    }
}
