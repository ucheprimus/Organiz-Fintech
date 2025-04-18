<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\LoanOfficerController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UnionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SavingsController;
use App\Models\LoanType;
use App\Models\SavingsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/restricted-page', function () {
//         return view('general.restricted_page'); 
//     });
// });

// this will be auth users 

Route::get('/client', [ClientController::class, 'client'])->name('client');
Route::post('/clientstore', [ClientController::class, 'store'])->name('clientstore');
Route::get('/clientshow', [ClientController::class, 'store'])->name('clientshow');
Route::get('/clientedit', [ClientController::class, 'store'])->name('clientedit');
Route::delete('/clientdelete', [ClientController::class, 'store'])->name('clientdelete');


Route::get('/search-user', [ClientController::class, 'searchUser']);
Route::get('/account', [RegisterController::class, 'account'])->name('account');
Route::post('/account', [RegisterController::class, 'registerClient'])->name('registerclient');
// Edit user
Route::get('/account/{id}/edit', [RegisterController::class, 'editUser'])->name('account.edit');
Route::put('/account/{id}', [RegisterController::class, 'updateUser'])->name('account.update');
Route::delete('/account/{id}', [RegisterController::class, 'deleteUser'])->name('account.destroy');


// basically fur unionn members 
Route::get('/search-user', [MembersController::class, 'searchUser']);
Route::post('/add-user-to-union', [MembersController::class, 'addUserToUnion'])->name('union.addUser');
Route::get('/union/{id}/members', [MembersController::class, 'showMembers'])->name('union.members');



// password to remove user from unionn 
Route::post('/validate-admin-password-and-remove', [MembersController::class, 'validateAdminPasswordAndRemove']);



// giving loan, this should be a general route 

Route::get('/loan', [LoanController::class, 'index'])->name('giveloan');
Route::get('/view', [LoanController::class, 'view'])->name('viewloan');

Route::get('/search-user', [LoanController::class, 'searchUser']);
Route::post('/loan', [LoanController::class, 'store'])->name('loanstore');

// all loans section 
Route::get('/weekly_loan', [LoanController::class, 'weekly'])->name('weeklyloan');
Route::get('/monthly_loan_records', [LoanController::class, 'monthly'])->name('monthlyloan');
Route::get('/assets_loan_records', [LoanController::class, 'assets'])->name('assetsloan');



Route::get('/repayment', [LoanController::class, 'repayment'])->name('repayment');

Route::get('/user-loans/{userId}', [LoanController::class, 'getUserLoans']);
Route::post('/loan-repay', [LoanController::class, 'repayLoan'])->name('loan.repay');

Route::post('/loans/{loan}/repay', [LoanController::class, 'repay'])->name('loan.repay');
Route::post('/loans/{loan}/repay', [LoanController::class, 'show'])->name('loan.show');
Route::get('/search-user', [LoanController::class, 'searchUser'])->name('search.user');
Route::get('/fetch-loans', [LoanController::class, 'fetchLoans'])->name('fetch.loans');
Route::post('/transaction-process', [LoanController::class, 'processTransaction'])->name('transaction.process');

Route::get('/savings', [SavingsController::class, 'index'])->name('user_savings');
Route::post('/savings', [SavingsController::class, 'store'])->name('savings.store');
Route::get('/search-users', [SavingsController::class, 'searchUsers'])->name('searchUsers');
Route::delete('/savings/{saving}', [SavingsController::class, 'destroy'])->name('savings.destroy');
Route::get('/savings/user/{id}', [SavingsController::class, 'show'])->name('savings.show');
Route::get('/savings/{id}/edit', [SavingsController::class, 'edit'])->name('savings.edit');
Route::post('/savings/{id}/update', [SavingsController::class, 'update'])->name('savings.update');
Route::get('/withdraw', [SavingsController::class, 'withdrawview'])->name('withdraw');
Route::post('/withdraw/process', [SavingsController::class, 'process'])->name('withdraw.process');
Route::get('/withdrawal-history/{user_id}', [SavingsController::class, 'history'])->name('withdraw.history');
Route::get('/fetch-savings-balance', [SavingsController::class, 'fetchBalance'])->name('fetch.savings.balance');
Route::get('/withdrawals/{user_id}', [SavingsController::class, 'viewWithdrawals'])->name('withdrawals.view');
Route::put('/withdrawals/update', [SavingsController::class, 'wupdate'])->name('withdrawals.update');


// this is  normal usere accessible routes//
Route::get('/loan_apply', [LoanController::class, 'loan_apply'])->name('loan_apply');
Route::post('/loan_apply', [LoanController::class, 'apply'])->name('apply');

Route::get('/bio_data', [LoanController::class, 'bio_data'])->name('bio_data');


















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('top')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('AdminDashboard');
    Route::get('branch', [AdminController::class, 'branch'])->name('AdminBranch');
    Route::get('role', [AdminController::class, 'role'])->name('Adminrole');
    Route::get('manager', [AdminController::class, 'manager'])->name('Adminmanager');
    Route::get('officers', [AdminController::class, 'officer'])->name('Adminofficer');
    Route::get('individual', [AdminController::class, 'individualaccount'])->name('Adminindividualaccount');
    Route::get('group', [AdminController::class, 'groupaccount'])->name('Admingroupaccount');
    Route::get('group_members', [AdminController::class, 'groupmembers'])->name('Admingroupmembers');

    // Explicit routes for BranchController
    Route::get('/branch', [BranchController::class, 'index'])->name('adminbranchindex');
    Route::post('/branch', [BranchController::class, 'store'])->name('adminbranchstore');
    Route::get('/branch/{id}/edit', [BranchController::class, 'edit'])->name('adminbranchedit');
    // Correct route for updating branch
    Route::put('/branch/{id}', [BranchController::class, 'update'])->name('adminbranchupdate');
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('adminbranchdestroy');


    // Explicit routes for BranchController
    Route::get('/role', [RoleController::class, 'index'])->name('adminrole');
    Route::post('/role', [RoleController::class, 'store'])->name('adminrolestore');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('adminroledestroy');



    // Explicit routes for Nabager
    Route::get('/manager', [ManagerController::class, 'index'])->name('adminmanager');
    Route::post('/manager', [managerController::class, 'store'])->name('adminmanagerstore');
    Route::get('/manager/{id}/edit', [managerController::class, 'edit'])->name('adminmanageredit');
    // Correct route for updating manager
    Route::put('/manager/{id}', [managerController::class, 'update'])->name('adminmanagerupdate');
    Route::delete('/manager/{id}', [managerController::class, 'destroy'])->name('adminmanagerdestroy');


    // Explicit routes for Nabager
    Route::get('/loanofficer', [LoanOfficerController::class, 'index'])->name('adminloanofficer');
    Route::post('/loanofficer', [LoanOfficerController::class, 'store'])->name('adminloanofficerstore');
    Route::get('/loanofficer/{id}/edit', [LoanOfficerController::class, 'edit'])->name(name: 'adminloanofficeredit');
    
    // Correct route for updating loanofficer
    Route::put('/loanofficer/{id}', [LoanOfficerController::class, 'update'])->name('adminloanofficerupdate');
    Route::delete('/loanofficer/{id}', [LoanOfficerController::class, 'destroy'])->name('adminloanofficerdestroy');

    // Explicit routes for Nabager
    Route::get('/union', [UnionController::class, 'index'])->name('adminunion');
    Route::post('/union', [UnionController::class, 'store'])->name('adminunionstore');
    Route::get('/union/{id}/edit', [UnionController::class, 'edit'])->name(name: 'adminunionedit');

    // Correct route for updating union
    Route::put('/union/{id}', [UnionController::class, 'update'])->name('adminunionupdate');
    Route::delete('/union/{id}', [UnionController::class, 'destroy'])->name('adminuniondestroy');

    Route::get('/admin/unions/{id}', [UnionController::class, 'show'])->name('adminunionshow');


    Route::get('/loan_options', [LoanTypeController::class, 'index'])->name('loantype');
    Route::post('/loan_options', [LoanTypeController::class, 'store'])->name('loantypestore');
    Route::get('/loan_options/{id}/edit', [LoanTypeController::class, 'edit'])->name('loantypeedit');
    Route::delete('/loan_options/{id}', [LoanType::class, 'destroy'])->name('loantypedestroy');

    



});
