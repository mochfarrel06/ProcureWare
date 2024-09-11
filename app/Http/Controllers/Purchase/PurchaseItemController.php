<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseItemCreateRequest;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseItems = PurchaseItem::with('purchase', 'material')->get();
        return view('user.purchase.purchase-item.index', compact('purchaseItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::all();
        $materials = Material::all();
        return view('user.purchase.purchase-item.create', compact('purchases', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseItemCreateRequest $request)
    {
        try {
            $purchase = Purchase::findOrFail($request->purchase_id);
            $material = Material::findOrFail($request->material_id);

            $purchase = new PurchaseItem([
                'purchase_id' => $purchase->id,
                'material_id' => $material->id,
                'quantity' => $request->quantity,
                'price_per_unit' => $request->price_per_unit,
            ]);

            $purchase->save();

            session()->flash('success', 'Berhasil menambahkan daftar pembelian barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses daftar pembelian barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
