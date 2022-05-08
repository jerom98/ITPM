<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginAccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryItemCategoryController;
use App\Http\Controllers\InventoryItemSubcategoryController;
use App\Http\Controllers\InventoryItemBrandController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\InventorySellerTypeController;
use App\Http\Controllers\InventorySellerController;
use App\Http\Controllers\InventoryPurchaseOrderController;

Route::get('/', [UserController::class, 'token'])->name('user.token');
Route::get('/admin/login', [UserController::class, 'token']);
Route::post('/admin/login', [UserController::class, 'login'])->name('login');
Route::get('/admin/logout', [UserController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth']], function () { //' '
    // main dashboard
    Route::get('/main/dashboard', [DashboardController::class, 'mainDashboard'])->name('main.dashboard');
    
    // home access
    Route::get('/admin/home', [UserController::class, 'home'])->name('user.home');

    //reset Password
    Route::get('/admin/main_reset', [UserController::class, 'resetIndex'])->name('main_reset.index');
    Route::post('/admin/main_reset/store', [UserController::class, 'resetStore'])->name('main_reset.store');

    //login access
    Route::get('/admin/loginAccess/', [LoginAccessController::class, 'index'])->name('login_access.index');
    Route::post('/admin/loginAccess/store', [LoginAccessController::class, 'store'])->name('login_access.store');
    Route::post('/admin/loginAccess/destroy', [LoginAccessController::class, 'destroy'])->name('login_access.destroy');

    // item category
    Route::get('/item-category-show-all',[InventoryItemCategoryController::class,'itemCategoryShowAll'])->name('inventory.itemCategoryShowAll');
    Route::post('/item-category-add-process',[InventoryItemCategoryController::class,'itemCategoryAddProcess'])->name('inventory.itemCategoryAddProcess');
    Route::get('/item-cat-delete-all/{id}',[InventoryItemCategoryController::class,'delete']);

    // item subcategory
    Route::get('/item-subcategory-show-all',[InventoryItemSubcategoryController::class,'itemSubcategoryShowAll'])->name('inventory.itemSubcategoryShowAll');
    Route::post('/item-subcategory-add-process',[InventoryItemSubcategoryController::class,'itemSubcategoryAddProcess'])->name('inventory.itemSubcategoryAddProcess');

    // item brand
    Route::get('/item-brand-show-all',[InventoryItemBrandController::class,'itemBrandShowAll'])->name('inventory.itemBrandShowAll');
    Route::post('/item-brand-add-process',[InventoryItemBrandController::class,'itemBrandAddProcess'])->name('inventory.itemBrandAddProcess');
    Route::get('/brands-delete-all/{id}',[InventoryItemBrandController::class,'delete']);
    
    // item
    Route::get('/item-show-all',[InventoryItemController::class,'itemShowAll'])->name('inventory.itemShowAll');
    Route::post('/item-add-process',[InventoryItemController::class,'itemAddProcess'])->name('inventory.itemAddProcess');
    Route::get('/items-delete-all/{id}',[InventoryItemController::class,'delete']);
    Route::get('/item-reports',[InventoryItemController::class,'ItemReport'])->name('inventory.itemReport');
    Route::post('/item-report',[InventoryItemController::class,'ItemReportPost'])->name('inventory.itemReportpost');
    
    // seller type
    Route::get('/seller-type-show-all',[InventorySellerTypeController::class,'sellerTypeShowAll'])->name('inventory.sellerTypeShowAll');
    Route::post('/seller-type-add-process',[InventorySellerTypeController::class,'sellerTypeAddProcess'])->name('inventory.sellerTypeAddProcess');
    Route::get('/seller-show-all',[InventorySellerController::class,'sellerShowAll'])->name('inventory.sellerShowAll');
    Route::post('/seller-add-process',[InventorySellerController::class,'sellerAddProcess'])->name('inventory.sellerAddProcess');
    Route::get('/seller-delete-all/{id}',[InventorySellerController::class,'delete']);
    Route::get('/seller-reports',[InventorySellerController::class,'sellerReport'])->name('inventory.sellerReport');

    // purchase order
    Route::get('/purchase-show-all',[InventoryPurchaseOrderController::class,'purchaseShowAll'])->name('inventory.purchaseShowAll');
    Route::get('/purchase-add',[InventoryPurchaseOrderController::class,'purchaseAdd'])->name('inventory.purchaseAdd');
    Route::post('/purchase-add-process',[InventoryPurchaseOrderController::class,'purchaseAddProcess'])->name('inventory.purchaseAddProcess');
    Route::get('/purchase-edit/{id}', [InventoryPurchaseOrderController::class, 'purchaseEdit'])->name("inventory.purchaseEdit");
    Route::get('/purchase-view/{id}', [InventoryPurchaseOrderController::class, 'purchaseView'])->name("inventory.purchaseView");
    Route::post('/purchase-update-process',[InventoryPurchaseOrderController::class,'purchaseUpdateProcess'])->name('inventory.purchaseUpdateProcess');
    Route::get('/purchase-delete/{id}', [InventoryPurchaseOrderController::class, 'delete']);
    Route::get('/purchase-report', [InventoryPurchaseOrderController::class, 'purchaseItemReport']);

});

