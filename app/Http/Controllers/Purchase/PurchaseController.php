<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseCreateRequest;
use App\Http\Requests\Purchase\PurchaseMaterialCreateRequest;
use App\Http\Requests\Purchase\PurchaseUpdateRequest;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Models\User;

class PurchaseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:manager_a,manager_b,staff_purchase'])->only('index');
    //     $this->middleware(['auth', 'role:manager_b,staff_purchase'])->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    // }

    public function index()
    {
        $purchases = Purchase::with(['purchaseRequest', 'user'])->get();

        return view('user.purchase.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $purchaseRequests = PurchaseRequest::where('status', 'approved')->get();
        $users = User::all();
        return view('user.purchase.purchases.create', compact('purchaseRequests', 'users'));
    }

    public function store(PurchaseMaterialCreateRequest $request)
    {
        try {
            // $material = Material::findOrFail($request->material_id);
            // $supplier = Supplier::findOrFail($request->supplier_id);
            $purchaseRequest = PurchaseRequest::findOrFail($request->purchase_request_id);
            $user = User::findOrFail($request->processed_by);

            $purchase = new Purchase([
                'purchase_request_id' => $purchaseRequest->id,
                'processed_by' => $user->id,
                'purchase_date' => $request->purchase_date,
                'expected_delivery_date' => $request->expected_delivery_date,
                'total_price' => $request->total_price,
                'status' => $request->status
            ]);

            $purchase->save();

            session()->flash('success', 'Berhasil menambahkan daftar pembelian barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses daftar pembelian barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $material = $purchase->material;
        $supplier = $purchase->supplier;

        return view('user.purchase.purchases.show', compact('purchase', 'material', 'supplier'));
    }

    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $materials = Material::all();
        $suppliers = Supplier::all();

        return view('user.purchase.purchases.edit', compact('purchase', 'materials', 'suppliers'));
    }

    public function update(PurchaseUpdateRequest $request, string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $materialID = $request->input('material_id');
            $supplierID = $request->input('supplier_id');

            $material = Material::findOrFail($materialID);
            $supplier = Supplier::findOrFail($supplierID);

            $purchases = $request->all();
            $purchases['material_id'] = $material->id;
            $purchases['supplier_id'] = $supplier->id;

            $purchase->fill($purchases);

            if ($purchase->isDirty()) {
                $purchase->save();

                session()->flash('success', 'Berhasil melakukan perubahan pada daftar pembelian');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan pada daftar pembelian');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada daftar pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus daftar pembelian']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
