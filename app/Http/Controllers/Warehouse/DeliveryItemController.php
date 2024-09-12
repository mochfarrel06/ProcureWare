<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\DeliveryCreateRequest;
use App\Http\Requests\Warehouse\DeliveryItemCreateRequest;
use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DeliveryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryItems = DeliveryItem::with(['delivery', 'material', 'supplier'])->get();
        return view('user.warehouse.delivery-item.index', compact('deliveryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deliveries = Delivery::all();
        $materials = Material::all();
        $suppliers = Supplier::all();
        return view('user.warehouse.delivery-item.create', compact('deliveries', 'materials', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryItemCreateRequest $request)
    {
        try {
            $delivery = Delivery::findOrFail($request->delivery_id);
            $material = Material::findOrFail($request->material_id);
            $supplier = Supplier::findOrFail($request->supplier_id);

            $deliveryItem = new DeliveryItem([
                'delivery_id' => $delivery->id,
                'material_id' => $material->id,
                'supplier_id' => $supplier->id,
                'quantity' => $request->quantity,
                'condition' => $request->condition,
                'unique_code' => $request->unique_code,
                'storage_location' => $request->storage_location,
            ]);

            $deliveryItem->save();

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
