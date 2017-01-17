<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;

use Auth;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->accounts;

        return view('app.accounts.my_accounts', ['accounts' => $accounts]);
    }
}
