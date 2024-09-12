<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\DeliveryCreateRequest;
use App\Models\Delivery;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return view('user.warehouse.delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::all(); // Hanya pembelian yang statusnya 'delivered'
        return view('user.warehouse.delivery.create', compact('purchases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryCreateRequest $request)
    {
        try {
            // $material = Material::findOrFail($request->material_id);
            // $supplier = Supplier::findOrFail($request->supplier_id);
            // $purchaseRequest = PurchaseRequest::findOrFail($request->purchase_request_id);
            // $user = User::findOrFail($request->deliver);
            $purchase = Purchase::findOrFail($request->purchase_id);

            $delivery = new Delivery([
                'purchase_id' => $purchase->id,
                'received_by' => auth()->user()->id,
                'delivery_date' => now(),
            ]);

            $delivery->save();

            $purchase->status = 'delivered';
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
