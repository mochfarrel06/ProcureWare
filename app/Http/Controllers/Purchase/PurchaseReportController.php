<?php

namespace App\Http\Controllers\Purchase;

use App\Exports\PurchaseOrderExport;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager_a,manager_b,staff_purchase'])->only('index', 'getFilteredData', 'exportExcel');
    }
    public function getFilteredData($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->addDay()->format('Y-m-d');
            return Purchase::whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return collect();
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchases = $this->getFilteredData($startDate, $endDate);

        return view('user.purchase.purchase-report.index', compact('purchases', 'startDate', 'endDate'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $purchases = $this->getFilteredData($startDate, $endDate);

        return Excel::download(new PurchaseOrderExport($purchases), 'laporan_pembelian.xlsx');
    }
}
