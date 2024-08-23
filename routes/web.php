<?php

use App\Http\Controllers\Backend\Amenities;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\ProfileController;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\propertyTypeController;
use App\Http\Controllers\Backend\RoleController;




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
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'store'])->name('admin.profile.store');
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('admin/change_password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('admin/UpdatePassword', [AdminController::class, 'UpdatePassword'])->name('admin.UpdatePassword');
});


Route::middleware(['auth', 'roles:admin'])->group(function () {
Route::controller(propertyTypeController::class)->group(function () {
    
    Route::get('/admin/all_types', 'AllType')->name('all.types')->middleware('permission:type.all');

    Route::get('/admin/add_types', 'AddType')->name('add.types')->middleware('permission:type.add');

    Route::get('/admin/add_types/edit/{propertyType}', 'EditType')->name('edit.types');
    Route::post('/admin/store_types', 'storeType')->name('store.types');
    Route::delete('/admin/delete_types/{propertyType}', 'DestroyType')->name('destroy.types');
    Route::patch('/admin/update_types/{propertyType}', 'UpdateType')->name('update.types');
});

Route::controller(AmenitiesController::class)->group(function () {
    Route::get('/admin/all_amenities', 'AllAmenities')->name('all.amenities');
    Route::get('/admin/add_amenities', 'AddAmenities')->name('add.amenities');
    Route::get('/admin/edit_amenities/{amenities}', 'EditAmenities')->name('edit.amenities');
    Route::post('/admin/store_amenities', 'StoreAmenities')->name('store.amenities');
    Route::patch('/admin/update/{amenities}', 'UpdateAmenities')->name('update.amenities');
    Route::delete('/admin/delete_amenities/{amenities}', 'DestroyAmenities')->name('destroy.amenities');
});

//permission controllers
Route::controller(RoleController::class)->group(function () {
    Route::get('/admin/all_permission', 'AllPermission')->name('all.permission');
    Route::get('/admin/add_permission', 'AddPermission')->name('add.permission');
    Route::post('/admin/store_permission', 'StorePermission')->name('store.permission');
    Route::get('/admin/edit_permission/{permissions}', 'EditPermission')->name('edit.permission');
    Route::patch('/admin/update_permission/{permissions}', 'UpdatePermission')->name('update.permission');
    Route::delete('/admin/update_permission/{permissions}', 'destroy')->name('delete.permission');
    Route::get('/admin/import_permission', 'ImportPermission')->name('import.permission');
    Route::get('/admin/export', 'export')->name('export');
    Route::post('/admin/import', 'import')->name('import');
    //end
});

       //roles controller

        Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/all_roles', 'AllRoles')->name('all.roles');
        Route::get('/admin/add_roles', 'AddRoles')->name('add.roles');
        Route::post('/admin/store_roles', 'StoreRoles')->name('store.roles');
        Route::get('/admin/edit_roles/{roles}', 'EditRoles')->name('edit.roles');
        Route::patch('/admin/update_roles/{roles}', 'UpdateRoles')->name('update.roles');
        Route::delete('/admin/update_roles/{roles}', 'deleteRoles')->name('delete.roles');
        Route::get('/admin/role/permission', 'RolePermission')->name('role.permission');
        Route::post('/admin/role/permission', 'StoreRolePermission')->name('store.role.permission');
        Route::get('/admin/all/role/permission', 'AllRolePermission')->name('allrole.permission');
        Route::get('/admin/all/edit/roles/{id}', 'EditRolePermission')->name('editrole.permission');
        Route::post('/admin/all/update/roles/{id}', 'UpdateRolePermission')->name('updaterole.permission');
        Route::delete('/admin/all/delete/roles/{id}', 'deleteRolePermission')->name('deleterole.permission');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/alladmin', 'AllAdmin')->name('alladmin');
    Route::get('/admin/addadmin', 'AddAdmin')->name('addadmin');
    Route::post('/admin/store', 'StoreAdmin')->name('storeadmin');
    Route::delete('/admin/destroy/{id}', 'deleteAdmin')->name('destroyadmin');
    Route::get('/admin/edit/{id}', 'EditAdmin')->name('editAdmin');
    Route::patch('/admin/store/{id}', 'UpdateAdmin')->name('UpdateAdmin');








});


});


Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent', [AgentController::class, 'index'])->name('agent.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user.index');
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');







