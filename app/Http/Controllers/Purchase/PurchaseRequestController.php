<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseCreateRequest;
use App\Http\Requests\Purchase\PurchaseUpdateRequest;
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

            session()->flash('success', 'Berhasil menambahkan permintaan pembelian, silahkan sampai permintaan anda di setujui');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses permintaan pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $user = $purchaseRequest->user;
        $material = $purchaseRequest->material;
        $supplier = $purchaseRequest->supplier;

        return view('user.purchase.purchase-request.show', compact('purchaseRequest', 'user', 'material', 'supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $materials = Material::all();
        $suppliers = Supplier::all();

        return view('user.purchase.purchase-request.edit', compact('purchaseRequest', 'materials', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseUpdateRequest $request, string $id)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $materialID = $request->input('material_id');
            $supplierID = $request->input('supplier_id');

            $material = Material::findOrFail($materialID);
            $supplier = Supplier::findOrFail($supplierID);

            $purchaseRequests = $request->all();
            $purchaseRequests['material_id'] = $material->id;
            $purchaseRequests['supplier_id'] = $supplier->id;

            $purchaseRequest->fill($purchaseRequests);

            if ($purchaseRequest->isDirty()) {
                $purchaseRequest->save();

                session()->flash('success', 'Berhasil melakukan perubahan pada Permintaan Pembelian');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan pada Permintaan Pembelian');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada Permintaan Pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $purchaseRequest->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus Permintaan Pembelian']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
