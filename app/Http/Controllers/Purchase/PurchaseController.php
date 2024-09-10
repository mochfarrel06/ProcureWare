<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseCreateRequest;
use App\Http\Requests\Purchase\PurchaseUpdateRequest;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:staff')->only(['create', 'store']);
    //     $this->middleware('role:manager')->only(['approve']);
    // }

    public function index()
    {
        $purchases = Purchase::with(['supplier', 'material'])->get();

        return view('user.purchase.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $materials = Material::all();
        $suppliers = Supplier::all();
        return view('user.purchase.purchases.create', compact('materials', 'suppliers'));
    }

    public function store(PurchaseCreateRequest $request)
    {
        try {
            $material = Material::findOrFail($request->material_id);
            $supplier = Supplier::findOrFail($request->supplier_id);

            $purchase = new Purchase([
                'material_id' => $material->id,
                'supplier_id' => $supplier->id,
                'purchase_date' => $request->purchase_date,
                'quantity' => $request->quantity,
                'approval_status' => 'pending',
            ]);

            $purchase->save();

            session()->flash('success', 'Berhasil menambahkan pembelian');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses pembelian: ' . $e->getMessage());
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

                session()->flash('success', 'Berhasil melakukan perubahan pada data barang');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan pada data barang');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada data barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // public function approve($id)
    // {
    //     $purchase = Purchase::find($id);
    //     if ($purchase) {
    //         $purchase->approval_status = 'approved';
    //         $purchase->save();
    //     }

    //     return redirect()->route('purchases.index');
    // }
}
