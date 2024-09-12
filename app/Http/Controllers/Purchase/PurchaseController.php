<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseCreateRequest;
use App\Http\Requests\Purchase\PurchaseMaterialCreateRequest;
use App\Http\Requests\Purchase\PurchaseMaterialUpdateRequest;
use App\Http\Requests\Purchase\PurchaseUpdateRequest;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            $purchaseRequest = PurchaseRequest::findOrFail($request->purchase_request_id);

            $purchase = new Purchase([
                'purchase_request_id' => $purchaseRequest->id,
                'user_id' => Auth::id(),
                'purchase_date' => now(),
                'expected_delivery_date' => $request->expected_delivery_date,
                'total_price' => $request->total_price,
                'status' => 'in_process'
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
        $purchaseRequest = $purchase->purchaseRequest;
        $user = $purchase->user;

        return view('user.purchase.purchases.show', compact('purchase', 'purchaseRequest', 'user'));
    }

    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchaseRequests = PurchaseRequest::all();

        return view('user.purchase.purchases.edit', compact('purchase', 'purchaseRequests'));
    }

    public function update(PurchaseMaterialUpdateRequest $request, string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchaseRequestId = $request->input('purchase_request_id');

            $purchaseRequest = PurchaseRequest::findOrFail($purchaseRequestId);

            $purchases = $request->all();
            $purchases['purchase_request_id'] = $purchaseRequest->id;

            $purchase->fill($purchases);

            if ($purchase->isDirty()) {
                $purchase->save();

                session()->flash('success', 'Berhasil melakukan perubahan pada daftar pembelian barang');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', 'Tidak melakukan perubahan pada daftar pembelian barang');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada daftar pembelian barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus daftar pembelian barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
