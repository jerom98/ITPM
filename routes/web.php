<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;






use App\Http\Controllers\DashboardController;




use App\Http\Controllers\InventoryItemCategoryController;
use App\Http\Controllers\InventoryItemSubcategoryController;
use App\Http\Controllers\InventoryItemBrandController;
use App\Http\Controllers\InventoryItemController;


// end inventory






Route::get('/', [UserController::class, 'token'])->name('user.token');
Route::get('/admin/login', [UserController::class, 'token']);
Route::post('/admin/login', [UserController::class, 'login'])->name('login');
Route::get('/admin/logout', [UserController::class, 'logout'])->name('logout');








Route::group(['middleware' => ['auth']], function () { //' '
    // main dashboard
    Route::get('/main/dashboard', [DashboardController::class, 'mainDashboard'])->name('main.dashboard');
    
    // home access
    Route::get('/admin/home', [UserController::class, 'home'])->name('user.home');

   

    

    
   
   
    

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
    
  
    
    
     
});

