<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;
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
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

Route::middleware(['auth'])->group(function(){


    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
//admin route end
//employee route start
Route::controller(EmployeeController::class)->group(function(){

    Route::get('/all/employee', 'AllEmployee')->name('all.employee')->middleware('permission:employee.all');
    Route::get('/add/employee', 'AddEmployee')->name('add.employee')->middleware('permission:employee.add');
    Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee')->middleware('permission:employee.edit');
    Route::post('/store/employee', 'StoreEmployee')->name('employee.store')->middleware('permission:employee.store');
    Route::post('/update/employee', 'UpdateEmployee')->name('employee.update')->middleware('permission:employee.update');
    Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee')->middleware('permission:employee.delete');
});//end employee route

//customer route start
Route::controller(CustomerController::class)->group(function(){

    Route::get('/all/customer', 'AllCustomer')->name('all.customer');
    Route::get('/add/customer', 'AddCustomer')->name('add.customer');
    Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
    Route::post('/store/customer', 'StoreCustomer')->name('customer.store');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer.update');
    Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
});//end customer route

//supplier route start
Route::controller(SupplierController::class)->group(function(){

    Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
    Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
    Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
    Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store');
    Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update');
    Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
    Route::get('/view/supplier/{id}', 'ViewSupplier')->name('view.supplier');
});//end supplier route


//advance salary route start
Route::controller(SalaryController::class)->group(function(){

    Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');
    Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
    Route::post('/store/advance/salary', 'StoreAdvanceSalary')->name('store.advance.salary');
    Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit.advance.salary');
    Route::post('/update/advance/salary/', 'UpdateAdvanceSalary')->name('update.advance.salary');
    Route::get('/delete/advance/salary/{id}', 'DeleteAdvanceSalary')->name('delete.advance.salary');

});//end salary route

//pay salary route start
Route::controller(SalaryController::class)->group(function(){

    Route::get('/pay/salary', 'PaySalary')->name('pay.salary');
    Route::get('/month/salary', 'MonthSalary')->name('month.salary');
    Route::get('/pay/now/salary{id}', 'PayNowSalary')->name('pay.now.salary');
    Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee.salary.store');


});//end pay salary route

//category route start
Route::controller(CategoryController::class)->group(function(){

    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::get('/add/category', 'AddCategory')->name('add.category');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    Route::post('/store/category', 'StoreCategory')->name('category.store');
    Route::post('/update/category', 'UpdateCategory')->name('category.update');



});//end category route

//Product route start
Route::controller(ProductController::class)->group(function(){

    Route::get('/all/product', 'AllProduct')->name('all.product');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::post('/store/product', 'StoreProduct')->name('product.store');
    Route::post('/update/product', 'UpdateProduct')->name('product.update');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');
    Route::get('/import/product', 'ImportProduct')->name('import.product');
    Route::get('/export', 'Export')->name('export');
    Route::post('/import', 'Import')->name('import');

});//end category route

//expense route start
Route::controller(ExpenseController::class)->group(function(){

    Route::get('/add/expense', 'AddExpense')->name('add.expense');
    Route::post('/store/expense', 'StoreExpense')->name('expense.store');
    Route::post('/update/expense', 'UpdateExpense')->name('expense.update');
    Route::get('/today/expense', 'TodayExpense')->name('today.expense');
    Route::get('/month/expense', 'MonthExpense')->name('month.expense');
    Route::get('/year/expense', 'YearExpense')->name('year.expense');
    Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');




});//end expense route

//pos route start
Route::controller(PosController::class)->group(function(){

    Route::get('/pos', 'Pos')->name('pos');
    Route::post('/add-cart', 'AddCart');
    Route::post('/cart-update/{rowId}', 'UpdateCart');
    Route::post('/create-invoice', 'CreateInvoice');
    Route::get('/cart-delete/{rowId}', 'DeleteCart');
    Route::get('/allitem', 'AllItem');

});//end pos route

//order route start
Route::controller(OrderController::class)->group(function(){

    Route::post('/final-invoice', 'FinalInvoice');
    Route::get('/pending/order', 'PendingOrder')->name('pending.order');
    Route::get('/complete/order', 'CompleteOrder')->name('complete.order');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
    Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');
    Route::get('/stock/manage', 'StockManage')->name('stock.manage');
    Route::get('/order/invoice-download/{order_id}', 'InvoiceDownload');

    /////////DUE///////////////////
    Route::get('/pending/due', 'PendingDue')->name('pending.due');
    Route::get('/order/due/{id}', 'OrderDueAjax');
    Route::post('/update/due', 'UpdateDue')->name('update.due');

});//end order route

//permission route start
Route::controller(RoleController::class)->group(function(){


    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add.permission');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    Route::post('/store/permission', 'StorePermission')->name('permission.store');
    Route::post('/update/permission', 'UpdatePermission')->name('permission.update');


});//end permisison route

//roles route start
Route::controller(RoleController::class)->group(function(){


    Route::get('/all/roles', 'AllRoles')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->name('add.roles');
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
    Route::post('/store/roles', 'StoreRoles')->name('roles.store');
    Route::post('/update/roles', 'UpdateRoles')->name('roles.update');


});//end roles route

//add roles to permission route start
Route::controller(RoleController::class)->group(function(){


    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
    Route::post('/role/permission/store', 'StoreRolePermission')->name('role.permission.store');
    Route::post('/role/permission/update/{id}', 'UpdateRolePermission')->name('role.permission.update');
    Route::get('/admin/delete/roles/{id}', 'DeleteRolePermission')->name('admin.delete.roles');



});//end add roles to permission route

//add roles to permission route start
Route::controller(AdminController::class)->group(function(){


    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    Route::post('/admin/user/store', 'AdminUserStore')->name('admin.user.store');
    Route::post('/admin/user/update', 'AdminUserUpdate')->name('admin.user.update');

//database backup
    Route::get('/database/backup', 'DatabaseBackup')->name('database.backup');
    Route::get('/backup/now', 'BackupNow');
    Route::get('{getFileName}', 'DownloadDatabase');
    Route::get('delete/database/{getFileName}', 'DeleteDatabase');


});//end add roles to permission route


});


