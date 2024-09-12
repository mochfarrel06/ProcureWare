<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager_a,manager_b');
    }

    public function index()
    {
        $purchaseRequests = PurchaseRequest::all();
        return view('user.purchase.purchase-approval.index', compact('purchaseRequests'));
    }

    public function approved(string $id)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $purchaseRequest->status = 'approved';
            $purchaseRequest->save();

            session()->flash('success', 'Berhasil menyetujui permintaan pembelian, silahkan lanjutkan proses pembelian');
        } catch (\Exception $e) {
            // Menyimpan pesan error ke dalam sesi jika terjadi kesalahan
            session()->flash('error', "Terdapat kesalahan pada permintaan pembelian: " . $e->getMessage());
        }

        return redirect()->back();
    }

    public function rejected(string $id)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $purchaseRequest->status = 'rejected';
            $purchaseRequest->save();

            session()->flash('success', 'Berhasil menolak permintaan pembelian, harap di lakukan perbaikan');
        } catch (\Exception $e) {
            // Menyimpan pesan error ke dalam sesi jika terjadi kesalahan
            session()->flash('error', "Terdapat kesalahan pada permintaan pembelian: " . $e->getMessage());
        }

        return redirect()->back();
    }
}
