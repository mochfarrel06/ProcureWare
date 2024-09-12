<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\DeliveryCreateRequest;
use App\Models\Delivery;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager_a,staff_warehouse'])->only('index');
        $this->middleware(['auth', 'role:staff_warehouse'])->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::with(['purchase', 'user'])->get();
        return view('user.warehouse.delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::whereDoesntHave('delivery')->get();
        return view('user.warehouse.delivery.create', compact('purchases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryCreateRequest $request)
    {
        try {
            $purchase = Purchase::findOrFail($request->purchase_id);

            $delivery = new Delivery([
                'purchase_id' => $purchase->id,
                'user_id' => Auth::id(),
                'delivery_date' => now(),
            ]);

            $delivery->save();

            $purchase->status = 'delivered';
            $purchase->save();

            session()->flash('success', 'Berhasil menerima barang pembelian dari supplier');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses menerima barang pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $purchase = $delivery->purchase;
        $user = $delivery->user;

        return view('user.warehouse.delivery.show', compact('delivery', 'purchase', 'user'));
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
