<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager_a,manager_b');
    }

    public function index()
    {
        $purchases = Purchase::all();
        return view('user.purchase.purchase-approval.index', compact('purchases'));
    }

    public function approved(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->approval_status = 'approved';
            $purchase->save();

            session()->flash('success', 'Berhasil menyetujui');
        } catch (\Exception $e) {
            // Menyimpan pesan error ke dalam sesi jika terjadi kesalahan
            session()->flash('error', "Terdapat kesalahan pada pengajuan lahan: " . $e->getMessage());
        }

        return redirect()->back();
    }

    public function rejected(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->approval_status = 'rejected';
            $purchase->save();

            session()->flash('success', 'Berhasil menolak');
        } catch (\Exception $e) {
            // Menyimpan pesan error ke dalam sesi jika terjadi kesalahan
            session()->flash('error', "Terdapat kesalahan pada pengajuan lahan: " . $e->getMessage());
        }

        return redirect()->back();
    }
}
