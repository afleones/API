<?php

use Illuminate\Http\Request;
use App\Http\Middleware\SwitchDatabaseMiddleware;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PriceController;
use App\Http\Controllers\DetailpriceController;

use App\Http\Controllers\maiteController;
use App\Http\Controllers\DetailmaiteController;

use App\Http\Controllers\CreditnoteController;
use App\Http\Controllers\DetailcreditnoteController;

use App\Http\Controllers\DebitnoteController;
use App\Http\Controllers\DocumentsupportController;

use App\Http\Controllers\CustomerController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\RegistercompanyController;

use App\Http\Controllers\PlansController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TaxesController;
use App\Http\Controllers\ResolutionController;

use App\Http\Controllers\TypedocumentidentificationsController;

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\MunicipalitiesController;

use App\Http\Controllers\PutsendmaiteController;


use App\Http\Controllers\FileController;

use App\Http\Controllers\PdfController;

use App\Http\Controllers\CryptDBController;

use App\Http\Controllers\DashBoardController;




//Api Controllers GenomaX_Documents Start
use App\Http\Controllers\Api\AuthContoller;
use App\Http\Controllers\viviendaController;
use App\Http\Controllers\personaController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\weightController;
use App\Http\Controllers\conditionsController;
//Api Controllers GenomaX_Documents End


Route::post('register', [AuthContoller::class, 'register']);
Route::post('login', [AuthContoller::class, 'login']);


 Route::group(['middleware'=>['auth:sanctum', SwitchDatabaseMiddleware::class]], function(){
    Route::get('user-profile', [AuthContoller::class, 'userProfile']);
    Route::post('logout', [AuthContoller::class, 'logOut']);
    Route::post('change-password', [AuthContoller::class, 'changePassword']);
    Route::get('load-menu', [MenuController::class, 'getMenuWithItems']);

    Route::get('taxes', [TaxesController::class, 'index']);
    Route::get('taxeslist', [TaxesController::class, 'list']);
    Route::get('tax/{idtax}', [TaxesController::class, 'show']);
    Route::post('savetax', [TaxesController::class, 'store']);

    Route::get('prices', [PriceController::class, 'show']);
    Route::post('saveprices', [PriceController::class, 'store']);
    Route::post('savedetailprices', [DetailpriceController::class, 'store']);
    Route::post('deleteprices', [PriceController::class, 'destroy']);

    Route::post('getprices', [maiteController::class, 'getprice']);

    Route::get('invoices', [maiteController::class, 'show']);
    Route::post('savemaite', [maiteController::class, 'store']);
    Route::post('savedetailmaite', [DetailmaiteController::class, 'store']);
    Route::post('deleteinvoices', [maiteController::class, 'destroy']);

    Route::post('getinvoices', [maiteController::class, 'getinvoice']);



    Route::get('creditnotes', [creditnoteController::class, 'show']);
    Route::post('savecreditnotes', [creditnoteController::class, 'store']);
    Route::post('savedetailcreditnotes', [DetailcreditnoteController::class, 'store']);
    Route::post('deletecreditnotes', [creditnoteController::class, 'destroy']);

    Route::post('getcreditnotes', [creditnoteController::class, 'getcreditnote']);


    Route::get('debitnotes', [debitnoteController::class, 'show']);
    Route::get('documentsupports', [documentsupportController::class, 'show']);


    Route::get('customers', [customerController::class, 'show']);
    Route::post('savecustomers', [customerController::class, 'store']);

    Route::get('products', [productController::class, 'show']);
    Route::post('saveproducts', [productController::class, 'store']);

    Route::post('registercompany', [registercompanyController::class, 'store']);
    Route::get('bearerdian', [registercompanyController::class, 'show']);
    Route::get('showcompany', [registercompanyController::class, 'showcompany']);
    Route::get('showsoftware', [registercompanyController::class, 'showsoftware']);
    Route::get('showcertificate', [registercompanyController::class, 'showcertificate']);
    Route::get('showresolution', [resolutionController::class, 'showresolution']);
    


    Route::get('typedocumentidentifications', [typedocumentidentificationsController::class, 'show']);

    Route::get('departments', [departmentsController::class, 'show']);
    Route::get('municipalities', [municipalitiesController::class, 'show']);

    Route::get('resolutions', [resolutionController::class, 'show']);


    Route::post('putsendmaite', [putsendmaiteController::class, 'show']);
    Route::post('updatecufemaite', [putsendmaiteController::class, 'update']);


    Route::post('upload-image/{filename}', [FileController::class, 'uploadImage']);

    Route::get('/maite-pdf/{invoice}', [PdfController::class, 'maitePdf']);
    Route::get('/quotex-pdf/{invoice}', [PdfController::class, 'quotexPdf']);

    Route::get('/CryptDB', [CryptDBController::class, 'KryptDB']);

    // DashBoard
    Route::get('monthly-sales', [DashBoardController::class, 'dash_monthly_sales']);


    //Api Controllers GenomaX_Documents Start

    /*living place*/
    Route::get('vivienda', [viviendaController::class, 'show']);
    Route::post('saveVivienda', [viviendaController::class, 'store']);
    Route::post('updateVivienda', [viviendaController::class, 'update']);
    Route::post('deleteVivienda', [viviendaController::class, 'destroy']);
    /* End */

    /* person start */
    Route::get('persona', [personaController::class, 'show']);
    Route::post('savePersona', [personaController::class, 'store']);
    Route::post('updatePersona', [personaController::class, 'update']);
    Route::post('deletePersona', [personaController::class, 'destroy']);
    /* End */

    /* company */
    Route::get('company', [companyController::class, 'show']);
    Route::post('saveCompany', [companyController::class, 'store']);
    Route::post('updateCompany', [companyController::class, 'update']);
    Route::post('deleteCompany', [companyController::class, 'destroy']);
    /* End */

    /* empresa */
    Route::get('role', [roleController::class, 'show']);
    Route::post('saveRole', [roleController::class, 'store']);
    Route::post('updateRole', [roleController::class, 'update']);
    Route::post('deleteRole', [roleController::class, 'destroy']);
    /* End */

    /* weight */
    Route::get('Weight', [weightController::class, 'show']);
    Route::post('saveWeight', [weightController::class, 'store']);
    Route::post('updateWeight', [weightController::class, 'update']);
    Route::post('deleteWeight', [weightController::class, 'destroy']);
    /* End */

    /* conditions */
    Route::get('conditions', [conditionsController::class, 'show']);
    Route::post('saveConditions', [conditionsController::class, 'store']);
    Route::post('updateConditions', [conditionsController::class, 'update']);
    Route::post('deleteConditions', [conditionsController::class, 'destroy']);
    /* End */

    /* CommunicableDiseases */
    Route::post('saveCommunicableDiseases', [communicablediseasesController::class, 'store']);
    Route::get('CommunicableDiseases', [communicablediseasesController::class, 'show']);
    Route::post('updateCommunicableDiseases', [communicablediseasesController::class, 'update']);
    Route::post('deleteCommunicableDiseases', [communicablediseasesController::class, 'destroy']);
    /* End */

    //Api Routes GenomaX_Documents End
});



Route::get('users', [AuthContoller::class, 'allUsers']);
Route::get('plans', [PlansController::class, 'show']);

Route::get('/invoice-pdf/{dbname}/{invoice}', [PdfController::class, 'invoicePdf']);
Route::get('/quote-pdf/{dbname}/{invoice}', [PdfController::class, 'quotePdf']);