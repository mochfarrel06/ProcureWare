<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Purchase\MaterialController;
use App\Http\Controllers\Purchase\PurchaseApprovalController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseHistoryController;
use App\Http\Controllers\Purchase\PurchaseItemController;
use App\Http\Controllers\Purchase\PurchaseRequestController;
use App\Http\Controllers\Purchase\SupplierController;
use App\Http\Controllers\Warehouse\StockController;
use App\Http\Controllers\Warehouse\WarehouseItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'role:manager_a,manager_b']);

Route::middleware(['auth', 'role:staff_purchase,manager_a,manager_b'])->group(function () {
    // Purchases
    Route::resource('purchases', PurchaseController::class);

    // Material
    Route::resource('material', MaterialController::class);

    // Supplier
    Route::resource('supplier', SupplierController::class);

    // Purchase Request
    Route::resource('purchase-request', PurchaseRequestController::class);

    // Purchase Item
    Route::resource('purchase-item', PurchaseItemController::class);

    // Approval Manager
    Route::get('purchase-approval', [PurchaseApprovalController::class, 'index'])->name('purchaseApproval.index');
    Route::post('purchase-approval/{id}/approved', [PurchaseApprovalController::class, 'approved'])->name('purchaseApproval.approved');
    Route::post('purchase-approval/{id}/rejected', [PurchaseApprovalController::class, 'rejected'])->name('purchaseApproval.rejected');

    // History Purchase
    Route::get('purchase-history', [PurchaseHistoryController::class, 'index'])->name('purchaseHistory.index');
});

Route::middleware(['auth', 'role:manager_a,staff_warehouse'])->group(function () {

    // Warehouse
    Route::get('warehouse', [WarehouseItemController::class, 'index'])->name('warehouse.index');
    Route::get('warehouse/create', [WarehouseItemController::class, 'create'])->name('warehouse.create');
    Route::post('warehouse', [WarehouseItemController::class, 'store'])->name('warehouse.store');
    Route::get('warehouse/{id}/show', [WarehouseItemController::class, 'show'])->name('warehouse.show');

    // Route untuk menampilkan form dan hasil laporan stok
    Route::get('report', [WarehouseItemController::class, 'report'])->name('warehouse.report');

    // Route untuk mengekspor laporan stok ke Excel
    Route::get('report/export', [WarehouseItemController::class, 'exportReport'])->name('warehouse.report.export');


    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
});


require __DIR__ . '/auth.php';
