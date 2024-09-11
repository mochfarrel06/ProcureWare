<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\SupplierCreateRequest;
use App\Http\Requests\Purchase\SupplierUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:manager_a,manager_b,staff_purchase'])->only('index');
    //     $this->middleware(['auth', 'role:manager_b, staff_purchase'])->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    // }

    public function index()
    {
        $suppliers = Supplier::all();

        return view('user.purchase.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('user.purchase.supplier.create');
    }

    public function store(SupplierCreateRequest $request)
    {
        try {
            $supplier = new Supplier([
                'name' => $request->name,
                'code' => $request->code,
                'contact' => $request->contact,
                'address' => $request->address
            ]);

            $supplier->save();

            session()->flash('success', 'Berhasil menambahkan data barang masuk');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('user.purchase.supplier.show', compact('supplier'));
    }

    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('user.purchase.supplier.edit', compact('supplier'));
    }

    public function update(SupplierUpdateRequest $request, string $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $suppliers = $request->all();
            $supplier->fill($suppliers);

            if ($supplier->isDirty()) {
                $supplier->save();

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
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
