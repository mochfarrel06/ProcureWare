<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseCreateRequest;
use App\Models\Material;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::with(['user', 'material', 'supplier'])->get();
        return view('user.purchase.purchase-request.index', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        $suppliers = Supplier::all();

        return view('user.purchase.purchase-request.create', compact('materials', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseCreateRequest $request)
    {
        try {
            $material = Material::findOrFail($request->material_id);
            $supplier = Supplier::findOrFail($request->supplier_id);

            $purchase = new PurchaseRequest([
                'user_id' => Auth::id(),
                'material_id' => $material->id,
                'supplier_id' => $supplier->id,
                'quantity' => $request->quantity,
                'status' => 'pending',
                'request_date' => now()
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
