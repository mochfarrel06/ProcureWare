<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function showBarcode($id)
    {
        // Ambil material berdasarkan ID
        $material = Material::findOrFail($id);

        // Ambil unique code dari material
        // $unique_code = $material->;

        // Kirim unique code ke view untuk generate barcode
        return view('material.barcode', compact('unique_code'));
    }

    public function printBarcode($id)
    {
        // Ambil material berdasarkan ID
        $material = Material::findOrFail($id);

        // Ambil unique code dari material
        $unique_code = $material->unique_code;

        // Generate view untuk barcode
        // $pdf = PDF::loadView('material.barcode', compact('unique_code'));

        // Return hasil generate PDF dengan ukuran 10x2 cm
        // return $pdf->setPaper([0, 0, 283.46, 56.69]) // Ukuran 10x2 cm dalam satuan points
        //     ->stream('barcode-' . $material->unique_code . '.pdf');
    }
}
