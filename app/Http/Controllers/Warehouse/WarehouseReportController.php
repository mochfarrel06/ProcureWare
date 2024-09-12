<?php

namespace App\Http\Controllers\Warehouse;

use App\Exports\WarehouseExport;
use App\Http\Controllers\Controller;
use App\Models\DeliveryItem;
use App\Models\WarehouseItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WarehouseReportController extends Controller
{
    public function getFilteredData($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->addDay()->format('Y-m-d');
            return DeliveryItem::whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return collect();
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $deliveryItems = $this->getFilteredData($startDate, $endDate);

        return view('user.warehouse.warehouse-report.index', compact('deliveryItems', 'startDate', 'endDate'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ideliveryItems = $this->getFilteredData($startDate, $endDate);

        return Excel::download(new WarehouseExport($ideliveryItems), 'laporan_data_gudang.xlsx');
    }
}
