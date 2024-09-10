<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Purchase\MaterialController;
use App\Http\Controllers\Purchase\PurchaseApprovalController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\SupplierController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
//     Route::get('purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
//     Route::post('purchases', [PurchaseController::class, 'store'])->name('purchases.store');
//     Route::post('purchases/{id}/approve', [PurchaseController::class, 'approve'])->name('purchases.approve');
// });

// Purchase
Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::post('purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('purchases/{id}/show', [PurchaseController::class, 'show'])->name('purchases.show');
Route::get('purchases/{id}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
Route::put('purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::delete('purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
Route::post('purchases/{id}/approve', [PurchaseController::class, 'approve'])->name('purchases.approve');

// Material
Route::get('material', [MaterialController::class, 'index'])->name('material.index');
Route::get('material/create', [MaterialController::class, 'create'])->name('material.create');
Route::post('material', [MaterialController::class, 'store'])->name('material.store');
Route::get('material/{id}/show', [MaterialController::class, 'show'])->name('material.show');
Route::get('material/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
Route::put('material/{id}', [MaterialController::class, 'update'])->name('material.update');
Route::delete('material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');

// Supplier
Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('supplier/{id}/show', [SupplierController::class, 'show'])->name('supplier.show');
Route::get('supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

// Approval Manager
Route::get('purchase-approval', [PurchaseApprovalController::class, 'index'])->name('purchaseApproval.index');
Route::post('purchase-approval/{id}/approved', [PurchaseApprovalController::class, 'approved'])->name('purchaseApproval.approved');
Route::post('purchase-approval/{id}/rejected', [PurchaseApprovalController::class, 'rejected'])->name('purchaseApproval.rejected');

require __DIR__ . '/auth.php';
