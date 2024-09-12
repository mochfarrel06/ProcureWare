<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Purchase\MaterialController;
use App\Http\Controllers\Purchase\PurchaseApprovalController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseReportController;
use App\Http\Controllers\Purchase\PurchaseRequestController;
use App\Http\Controllers\Purchase\SupplierController;
use App\Http\Controllers\Warehouse\DeliveryController;
use App\Http\Controllers\Warehouse\DeliveryItemController;
use App\Http\Controllers\Warehouse\WarehouseController;
use App\Http\Controllers\Warehouse\WarehouseReportController;
use App\Http\Controllers\Warehouse\WarehouseStockController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'role:manager_a,manager_b']);

Route::middleware(['auth', 'role:staff_purchase,manager_a,manager_b'])->group(function () {
    // Material
    Route::resource('material', MaterialController::class);

    // Supplier
    Route::resource('supplier', SupplierController::class);

    // Purchase Request
    Route::resource('purchase-request', PurchaseRequestController::class);

    // Purchases
    Route::resource('purchases', PurchaseController::class);

    // Approval Manager
    Route::get('purchase-approval', [PurchaseApprovalController::class, 'index'])->name('purchaseApproval.index');
    Route::post('purchase-approval/{id}/approved', [PurchaseApprovalController::class, 'approved'])->name('purchaseApproval.approved');
    Route::post('purchase-approval/{id}/rejected', [PurchaseApprovalController::class, 'rejected'])->name('purchaseApproval.rejected');

    // Report
    Route::get('purchase-report', [PurchaseReportController::class, 'index'])->name('purchase-report.index');
    Route::get('purchase-report/exportExcel', [PurchaseReportController::class, 'exportExcel'])->name('purchase-report.exportExcel');
});

Route::middleware(['auth', 'role:manager_a,staff_warehouse'])->group(function () {

    Route::resource('delivery', DeliveryController::class);

    Route::resource('delivery-item', DeliveryItemController::class);

    Route::get('warehouse-stock', [WarehouseStockController::class, 'index'])->name('warehouse-stock.index');

    Route::get('warehouse-report', [WarehouseReportController::class, 'index'])->name('warehouse-report.index');
    Route::get('warehouse-report/exportExcel', [WarehouseReportController::class, 'exportExcel'])->name('warehouse-report.exportExcel');
});


require __DIR__ . '/auth.php';
