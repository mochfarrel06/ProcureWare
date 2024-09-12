<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseReportCreateRequest;
use App\Models\Purchase;
use App\Models\PurchaseReport;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function index()
    {
        $reports = PurchaseReport::with('purchase')->get();
        return view('user.purchase.purchase-report.index', compact('reports'));
    }

    public function create()
    {
        $purchases = Purchase::all(); // Mendapatkan semua data pembelian
        return view('user.purchase.purchase-report.create', compact('purchases'));
    }

    public function store(PurchaseReportCreateRequest $request)
    {
        try {
            $purchase = Purchase::findOrFail($request->purchase_id);

            $purchaseReport = new PurchaseReport([
                'purchase_id' => $purchase->id,
                'report_type' => $request->report_type,
                'report_date' => $request->report_date,
            ]);

            $purchaseReport->save();

            session()->flash('success', 'Berhasil menambahkan daftar pembelian barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses daftar pembelian barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
