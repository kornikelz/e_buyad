<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login');
});

Route::get('/maintenance', function()
{
    return Redirect::to('/maintenance/products/med');
});

Route::get('/maintenance/employee', function()
{
    return Redirect::to('/maintenance/employee/branchdet');
});


Route::get('/maintenance/products/nonmed', function()
{
    return Redirect::to('/maintenance/products/nonmed/category');
});

Route::get('/maintenance/products/med', function()
{
    return Redirect::to('/maintenance/products/med/theraclass');
});

Route::get('/maintenance/members', 'MaintMemController@index');
Route::post('/maintenance/members/update-member', 'MaintMemController@updateMember');
Route::post('/maintenance/members/delete-member', 'MaintMemController@deleteMember');

Route::get('/maintenance/employee/branchdet','MaintEmpController@index');
Route::post('/maintenance/employee/branchdet/add-branch','MaintEmpController@addBranch');
Route::post('/maintenance/employee/branchdet/update-branch','MaintEmpController@updateBranch');
Route::post('/maintenance/employee/branchdet/delete-branch','MaintEmpController@deleteBranch');

Route::get('/maintenance/employee/jobdet','MaintEmpController@showJobs');
Route::post('/maintenance/employee/jobdet/add-job','MaintEmpController@addJob');
Route::post('/maintenance/employee/jobdet/update-job','MaintEmpController@updateJob');
Route::post('/maintenance/employee/jobdet/delete-job','MaintEmpController@deleteJob');

Route::get('/maintenance/employee/empdet', 'MaintEmpController@showEmployee');
Route::post('/maintenance/employee/empdet/add-employee', 'MaintEmpController@addEmployee');
Route::post('/maintenance/employee/empdet/update-employee', 'MaintEmpController@updateEmployee');
Route::post('/maintenance/employee/empdet/delete-employee', 'MaintEmpController@deleteEmployee');


Route::get('/maintenance/products/nonmed/category', 'MaintNonMedController@index');
Route::post('/maintenance/products/nonmed/category/update-category', 'MaintNonMedController@updateCategory');
Route::post('/maintenance/products/nonmed/category/delete-category', 'MaintNonMedController@deleteCategory');
Route::post('/maintenance/products/nonmed/category/add-category', 'MaintNonMedController@addCategory');

Route::get('/maintenance/products/nonmed/details', 'MaintNonMedController@showDetails');
Route::post('/maintenance/products/nonmed/details/update-details', 'MaintNonMedController@updateDetails');
Route::post('/maintenance/products/nonmed/details/delete-details', 'MaintNonMedController@deleteDetails');
Route::post('/maintenance/products/nonmed/details/add-details', 'MaintNonMedController@addDetails');

Route::get('/maintenance/products/med/theraclass','MaintMedController@showTheraClass');
Route::post('/maintenance/products/med/theraclass/update-class','MaintMedController@updateTheraClass');
Route::post('/maintenance/products/med/theraclass/delete-class','MaintMedController@deleteTheraClass');
Route::post('/maintenance/products/med/theraclass/add-class','MaintMedController@addTheraClass');

Route::get('/maintenance/products/med/gendet','MaintMedController@showGeneric');
Route::post('/maintenance/products/med/gendet/update-generic','MaintMedController@updateGeneric');
Route::post('/maintenance/products/med/gendet/delete-generic','MaintMedController@deleteGeneric');
Route::post('/maintenance/products/med/gendet/add-generic','MaintMedController@addGeneric');

Route::get('/maintenance/products/med/brandet','MaintMedController@showBrand');
Route::post('/maintenance/products/med/brandet/update-branded','MaintMedController@updateBranded');
Route::post('/maintenance/products/med/brandet/delete-branded','MaintMedController@deleteBranded');
Route::post('/maintenance/products/med/brandet/add-branded','MaintMedController@addBranded');

Route::get('/maintenance/products/med/manudet','MaintMedController@showManufacturer');
Route::post('/maintenance/products/med/manudet/update-manufacturer','MaintMedController@updateManufacturer');
Route::post('/maintenance/products/med/manudet/delete-manufacturer','MaintMedController@deleteManufacturer');
Route::post('/maintenance/products/med/manudet/add-manufacturer','MaintMedController@addManufacturer');

Route::get('/maintenance/products/med/proddet','MaintMedController@showProduct');
Route::post('/maintenance/products/med/proddet/add-product','MaintMedController@addProduct');
Route::post('/maintenance/products/med/proddet/update-product','MaintMedController@updateProduct');
Route::post('/maintenance/products/med/proddet/delete-product','MaintMedController@deleteProduct');

Route::get('/maintenance/fpu/forms','MaintFPUController@showForms');
Route::post('maintenance/fpu/forms/add-form','MaintFPUController@addForm');
Route::post('maintenance/fpu/forms/update-form','MaintFPUController@updateForm');
Route::post('maintenance/fpu/forms/delete-form','MaintFPUController@deleteForm');

Route::get('/maintenance/fpu/packaging','MaintFPUController@showPackaging');
Route::post('/maintenance/fpu/packaging/add-pack','MaintFPUController@addPackaging');
Route::post('/maintenance/fpu/packaging/update-pack','MaintFPUController@updatePackaging');
Route::post('/maintenance/fpu/packaging/delete-pack','MaintFPUController@deletePackaging');

Route::get('/maintenance/fpu/uom','MaintFPUController@showUOM');
Route::post('/maintenance/fpu/uom/add-uom','MaintFPUController@addUOM');
Route::post('/maintenance/fpu/uom/update-uom','MaintFPUController@updateUOM');
Route::post('/maintenance/fpu/uom/delete-uom','MaintFPUController@deleteUOM');

Route::get('/maintenance/ppd/discount','MaintPPDController@showDiscount');
Route::post('/maintenance/ppd/discount/add-discount','MaintPPDController@addDiscount');
Route::post('/maintenance/ppd/discount/delete-discount','MaintPPDController@deleteDiscount');
Route::post('/maintenance/ppd/discount/update-discount','MaintPPDController@updateDiscount');

Route::get('/maintenance/ppd/packages','MaintPPDController@showPackages');
Route::get('/maintenance/ppd/packages/get-participating-products','MaintPPDController@getParticipatingProducts');
Route::get('/maintenance/ppd/packages/get-search-names','MaintPPDController@getNames');
Route::post('/maintenance/ppd/packages/add-package','MaintPPDController@addPackage');


Route::get('/transaction/registration','TransactionController@showRegistration');
Route::get('/transaction/reload','TransactionController@showReload');
Route::get('/transaction/sell','TransactionController@showSell');
Route::get('/transaction/sell/verify-qr','TransactionController@getPinCode');
Route::get('/transaction/sell/get-mem-details','TransactionController@getMemDetails');
Route::post('/transaction/sell/get-receipt','TransactionController@showReceipt');
Route::post('/transaction/sell/reload-mem','TransactionController@reloadMember');

Route::get('/transaction/return', 'TransactionController@showReturn');
Route::get('/transaction/return/trans-info', 'TransactionController@getTransInfo');
Route::get('/transaction/return/trans-det', 'TransactionController@fillBought');
Route::post('/transaction/return/save', 'TransactionController@saveReturns');

Route::post('/transaction/registration/upload-temp-image', 'RegistrationController@uploadTempImage');
Route::get('/transaction/registration/get-last-mem-id', 'RegistrationController@getLastMemId');
Route::post('/transaction/registration/register-member', 'RegistrationController@insertMemInfo');

Route::get('/transaction/generate-card', 'TransactionController@showGenCard');
Route::get('/transaction/generate-card/process-card', 'RegistrationController@generateCard');
Route::post('/transaction/generate-card/set-basic-info', 'RegistrationController@updateUser');

Route::get('/transaction/egc','TransactionController@showEGC');
Route::post('/transaction/egc/submit-nm-cash','EGCController@saveEGCCash');
Route::post('/transaction/egc/submit-nm-prod','EGCController@saveEGCProds');
Route::get('/transaction/egc/generate-nm-cash-receipt/{ecode}',[ 'uses' => 'EGCController@showEGCCashReceipt' ]);
Route::get('/transaction/egc/generate-nm-prod-receipt/{ecode}',[ 'uses' => 'EGCController@showEGCProdsReceipt' ]);

Route::get('/transaction/egcmem','TransactionController@showEGCMem');

Route::get('/transaction/reload','TransactionController@showReload');
Route::get('/transaction/reload/get-pin-code','ReloadController@getPinCode');
Route::get('/transaction/reload/get-mem-det','ReloadController@getMemDetails');
Route::post('/transaction/reload/credit-reload','ReloadController@reloadCredit');

//utilities
Route::get('/utils/pointload','PointLoadUtilController@showPointLoad');
Route::post('/utils/pointload/update-mech','PointLoadUtilController@updatePointLoad');

Route::get('/utils/memberreactivation','MemberReactivationController@index');

Route::get('/utils/therareactivation','MemberReactivationController@thera');

Route::get('/utils/genreactivation','MemberReactivationController@generic');

Route::get('/utils/brandreactivation','MemberReactivationController@brand');

Route::get('/utils/manureactivation','MemberReactivationController@manufacturer');

Route::get('/utils/prodreactivation','MemberReactivationController@product');

Route::get('/utils/prodcatreactivation','MemberReactivationController@prodcat');

Route::get('/utils/proddetreactivation','MemberReactivationController@proddet');

Route::get('/utils/formreactivation','MemberReactivationController@form');

Route::get('/utils/packreactivation','MemberReactivationController@pack');

Route::get('/utils/uomreactivation','MemberReactivationController@uom');

Route::get('/utils/branchreactivation','MemberReactivationController@branch');

Route::get('/utils/jobreactivation','MemberReactivationController@job');

Route::get('/utils/empreactivation','MemberReactivationController@emp');

Route::get('/utils/discountreactivation','MemberReactivationController@discount');

Route::get('/utils/promoreactivation','MemberReactivationController@promos');

Route::get('/utils/packagereactivation','MemberReactivationController@package');

//dashboard
Route::get('/dashboard','DashboardController@dashboard');

//reports
Route::get('/reports/salesreport','ReportsController@sales');
Route::post('/reports/salesreport/genreport','ReportsController@salesreport');

Route::get('/reports/productreport','ReportsController@product');
Route::post('/reports/productreport/genreport','ReportsController@productreport');

Route::get('/reports/creditreport','ReportsController@credit');
Route::post('/reports/creditreport/genreport','ReportsController@creditreport');

Route::get('/reports/egcreport','ReportsController@egc');
Route::post('/reports/egcreport/genreport','ReportsController@egcreport');