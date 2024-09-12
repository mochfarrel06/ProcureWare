<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;

class WarehouseStockController extends Controller
{
    public function index()
    {
        $warehouseStocks = WarehouseStock::with('material')->get();

        return view('user.warehouse.warehouse-stock.index', compact('warehouseStocks'));
    }
}
