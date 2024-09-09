<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:staff')->only(['store']); // Staff access only
        $this->middleware('role:manager')->only(['index']); // Manager access only
    }

    public function index()
    {
        // Show warehouse items
    }

    public function store(Request $request)
    {
        // Store new warehouse item
    }
}
