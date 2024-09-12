<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\DeliveryCreateRequest;
use App\Http\Requests\Warehouse\DeliveryItemCreateRequest;
use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;

class DeliveryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryItems = DeliveryItem::with(['delivery', 'supplier'])->get();
        return view('user.warehouse.delivery-item.index', compact('deliveryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deliveries = Delivery::whereDoesntHave('deliveryItems')->get();
        $suppliers = Supplier::all();
        return view('user.warehouse.delivery-item.create', compact('deliveries', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryItemCreateRequest $request)
    {
        try {
            $delivery = Delivery::findOrFail($request->delivery_id);
            $supplier = Supplier::findOrFail($request->supplier_id);

            $deliveryItem = new DeliveryItem([
                'delivery_id' => $delivery->id,
                'supplier_id' => $supplier->id,
                'arrival_date' => now(),
                'quantity' => $request->quantity,
                'condition' => $request->condition,
                'unique_code' => $request->unique_code,
                'storage_location' => $request->storage_location,
            ]);

            $deliveryItem->save();

            $material = Material::where('code',  $delivery->purchase->purchaseRequest->material->code)->first();
            if ($material) {
                $warehouseStock = WarehouseStock::where('material_id', $material->id)->first();
                if ($warehouseStock) {
                    $warehouseStock->increment('quantity', $deliveryItem['quantity']);
                } else {
                    WarehouseStock::create([
                        'material_id' => $material->id,
                        'quantity' => $deliveryItem['quantity'],
                    ]);
                }
            }

            session()->flash('success', 'Berhasil menambahkan Item Pembelian');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses Item Pembelian: ' . $e->getMessage());
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
