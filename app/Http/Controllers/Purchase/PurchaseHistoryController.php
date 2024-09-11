<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();

        return view('user.purchase.purchase-history.index', compact('purchases'));
    }
}
