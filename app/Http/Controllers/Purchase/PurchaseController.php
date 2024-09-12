<?php

namespace App\Http\Controllers\Purchase;

use App\Helpers\DateHelper;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:manager_a,manager_b,staff_purchase'])->only('index');
    //     $this->middleware(['auth', 'role:manager_b,staff_purchase'])->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    // }

    public function addBusinessDays($startDate, $days)
    {
        $businessDays = 0;
        $date = Carbon::parse($startDate);

        while ($businessDays < $days) {
            $date->addDay();

            // Hanya tambahkan jika hari kerja (Senin–Jumat)
            if (!$date->isWeekend()) {
                $businessDays++;
            }
        }

        return $date;
    }


    public function index()
    {
        $purchases = Purchase::with(['purchaseRequest', 'user'])->get();

        return view('user.purchase.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $purchaseRequests = PurchaseRequest::whereDoesntHave('purchase')->where('status', 'approved')->get();
        return view('user.purchase.purchases.create', compact('purchaseRequests'));
    }

    public function store(PurchaseMaterialCreateRequest $request)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($request->purchase_request_id);

            // Hitung total harga
            $pricePerUnit = $request->price_per_unit;
            $totalPrice = $purchaseRequest->quantity * $pricePerUnit;

            // Dapatkan tanggal saat pembelian diproses
            $purchaseDate = now();

            // Hitung tanggal maksimal pengiriman (5 hari kerja dari tanggal pembelian)
            $expectedDeliveryDate = DateHelper::addBusinessDays($purchaseDate, 5);

            $purchase = new Purchase([
                'purchase_request_id' => $purchaseRequest->id,
                'user_id' => Auth::id(),
                'purchase_date' => $purchaseDate,
                'expected_delivery_date' => $expectedDeliveryDate,
                'price_per_unit' => $pricePerUnit,
                'total_price' => $totalPrice,
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
            // Cari data purchase berdasarkan ID
            $purchase = Purchase::findOrFail($id);

            // Dapatkan data purchase request
            $purchaseRequestId = $request->input('purchase_request_id');
            $purchaseRequest = PurchaseRequest::findOrFail($purchaseRequestId);

            // Ambil data dari request
            $pricePerUnit = $request->input('price_per_unit') ?? $purchase->price_per_unit;
            $quantity = $purchaseRequest->quantity;

            // Hitung ulang total harga
            $newTotalPrice = $quantity * $pricePerUnit;

            // Ambil semua data request
            $purchases = $request->all();
            $purchases['purchase_request_id'] = $purchaseRequest->id;
            $purchases['total_price'] = $newTotalPrice; // Set total harga baru

            // Cek apakah ada perubahan manual, termasuk total_price
            $isChanged = $purchase->price_per_unit != $pricePerUnit ||
                $purchase->total_price != $newTotalPrice ||
                $purchase->purchase_request_id != $purchaseRequestId;

            // Isi data baru ke model purchase
            $purchase->fill($purchases);

            if ($isChanged) {
                // Jika ada perubahan, simpan dan tampilkan pesan sukses
                $purchase->save();

                session()->flash('success', 'Berhasil melakukan perubahan pada daftar pembelian barang');
                return response()->json(['success' => true], 200);
            } else {
                // Jika tidak ada perubahan, tampilkan pesan "tidak ada perubahan"
                session()->flash('info', 'Tidak melakukan perubahan pada daftar pembelian barang');
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan kesalahan
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
