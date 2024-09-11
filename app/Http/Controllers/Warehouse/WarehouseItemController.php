<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\WarehouseCreateRequest;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\WarehouseItem;
use Illuminate\Http\Request;

class WarehouseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouseItems = WarehouseItem::all();

        return view('user.warehouse.warehouse.index', compact('warehouseItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::where('approval_status', 'approved')->get();
        $suppliers = Supplier::all();

        return view('user.warehouse.warehouse.create', compact('purchases', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseCreateRequest $request)
    {
        try {
            $purchase = Purchase::findOrFail($request->purchase_id);
            $supplier = Supplier::findOrFail($request->supplier_id);

            $warehouseItem = new WarehouseItem([
                'purchase_id' => $purchase->id,
                'material_name' => $request->material_name,
                'material_code' => $request->material_code,
                'arrival_date' => $request->arrival_date,
                'supplier_id' => $supplier->id,
                'quantity' => $request->quantity,
                'storage_location' => $request->storage_location,
                'condition' => $request->condition,
                'unique_number' => $request->unique_number,
            ]);

            $warehouseItem->save();

            // Update or create stock
            $material = Material::where('code', $warehouseItem['material_code'])->first();
            if ($material) {
                $stock = Stock::where('material_id', $material->id)->first();
                if ($stock) {
                    $stock->increment('quantity', $warehouseItem['quantity']);
                } else {
                    Stock::create([
                        'material_id' => $material->id,
                        'quantity' => $warehouseItem['quantity'],
                    ]);
                }
            }

            session()->flash('success', 'Berhasil menambahkan pembelian');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function report(Request $request)
    {
        // Ambil filter tanggal dari request
        $from = $request->input('from');
        $to = $request->input('to');

        // Query data warehouse_items sesuai filter tanggal
        $query = WarehouseItem::query();

        if ($from) {
            $query->where('arrival_date', '>=', $from);
        }

        if ($to) {
            $query->where('arrival_date', '<=', $to);
        }

        // Dapatkan hasil query
        $items = $query->with('supplier')->get();

        // Tampilkan ke view laporan stok
        return view('user.warehouse.warehouse.report', compact('items', 'from', 'to'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
