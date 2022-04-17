<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the cards.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cards($user_id = null)
    {
        if($user_id == null){
            $cards = Card::with('user')->get();
        } else {
            $cards = Card::with('user')->where('user_id', $user_id)->get();
        }

        return view('admin.cards', compact('cards'));
    }

    /**
     * Show the transactions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transactions($user_id = null)
    {
        if($user_id == null){
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('user_id', $user_id)->get();
        }

        return view('admin.transactions', compact('transactions'));
    }
}
