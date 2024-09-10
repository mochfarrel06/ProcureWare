<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\MaterialCreateRequest;
use App\Http\Requests\Purchase\MaterialUpdateRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager_a,manager_b,staff_purchase'])->only('index');
        $this->middleware(['auth', 'role:manager_b, staff_purchase'])->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $materials = Material::all();

        return view('user.purchase.material.index', compact('materials'));
    }

    public function create()
    {
        return view('user.purchase.material.create');
    }

    public function store(MaterialCreateRequest $request)
    {
        try {
            $material = new Material([
                'name' => $request->name,
                'code' => $request->code,
                'category' => $request->category,
                'stock' => $request->stock
            ]);
            $material->save();

            session()->flash('success', 'Berhasil menambahkan data barang masuk');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses pembelian: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id)
    {
        $material = Material::findOrFail($id);

        return view('user.purchase.material.show', compact('material'));
    }

    public function edit(string $id)
    {
        $material = Material::findOrFail($id);

        return view('user.purchase.material.edit', compact('material'));
    }

    public function update(MaterialUpdateRequest $request, string $id)
    {
        try {
            $material = Material::findOrFail($id);

            $materials = $request->all();
            $material->fill($materials);

            if ($material->isDirty()) {
                $material->save();

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
            $material = Material::findOrFail($id);
            $material->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data barang']);
        } catch (\Exception $e) {
            // Menangani exception jika terjadi kesalahan saat menghapus
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
