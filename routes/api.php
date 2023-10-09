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

/* Controlador de Autenticación */
use App\Http\Controllers\Api\AuthController;
/*  */

/* Controlador de Viviendas */
use App\Http\Controllers\livingplaceController;
/*  */

/* Controlador de Personas */
use App\Http\Controllers\personController;
/*  */

/* controlador de Compañía */
use App\Http\Controllers\companyController;
/*  */

/* controlador de Roles */
use App\Http\Controllers\roleController;
/*  */

/* controlador de Infancia */
use App\Http\Controllers\childhoodController;
/*  */

/* controlador de Primera Infancia */
use App\Http\Controllers\earlychildhoodController;
/*  */

/* controlador de Enfermedades Transmisibles */
use App\Http\Controllers\communicablediseasesController;
/*  */

/* controlador de Salud de la Mujer */
use App\Http\Controllers\womenhealthController;
/*  */

/* controlador de Prueba de endPoints */
use App\Http\Controllers\pruebaController;
/*  */

/* controlador de Adolescencees */
use App\Http\Controllers\adolescenceController;
/*  */

/* controlador de Adulto */
use App\Http\Controllers\adultController;
/*  */

/* controlador de Adulto Mayor */
use App\Http\Controllers\oldController;
/*  */

/* controlador de Adulto Mayor */
use App\Http\Controllers\youthController;
/*  */

/* controlador de Adulto Mayor */
use App\Http\Controllers\gestationbirthpostpartumController;
/*  */


//Api Controllers GenomaX_Documents End


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum', SwitchDatabaseMiddleware::class]], function(){

    //Api Controllers GenomaX_Documents Start

    /*Rutas de Viviendas*/
    Route::post('saveLivingPlace', [livingplaceController::class, 'store']);
    Route::get('livingPlaces', [livingplaceController::class, 'index']);
    Route::post('livingplace', [livingplaceController::class, 'show']);
    Route::post('updateLivingPlace', [livingplaceController::class, 'update']);
    Route::post('deleteLivingPlace', [livingplaceController::class, 'destroy']);
    /* End */

    /* Rutas de Personas */
    Route::post('savePerson', [personController::class, 'store']);
    Route::get('People', [personController::class, 'index']);
    Route::post('Person', [personController::class, 'show']);
    Route::post('updatePerson', [personController::class, 'update']);
    Route::post('deletePerson', [personController::class, 'destroy']);
    /* End */

    /* Rutas de Empresas */
    Route::post('saveCompany', [companyController::class, 'store']);
    Route::get('companies', [companyController::class, 'index']);
    Route::post('company', [companyController::class, 'show']);
    Route::post('updateCompany', [companyController::class, 'update']);
    Route::post('deleteCompany', [companyController::class, 'destroy']);
    /* End */

    /* Rutas de Roles */
    Route::post('saveRole', [roleController::class, 'store']);
    Route::get('roles', [roleController::class, 'index']);
    Route::post('role', [roleController::class, 'show']);
    Route::post('updateRole', [roleController::class, 'update']);
    Route::post('deleteRole', [roleController::class, 'destroy']);
    /* End */

    /* Rutas de Primera Infancia */
    Route::post('saveEarlyChildHood', [earlychildhoodController::class, 'store']);
    Route::get('earlyChildHoods', [earlychildhoodController::class, 'index']);
    Route::post('earlyChildHood', [earlychildhoodController::class, 'show']);
    Route::post('updateEarlyChildHood', [earlychildhoodController::class, 'update']);
    Route::post('deleteEarlyChildHood', [earlychildhoodController::class, 'destroy']);
    /* End */

    /* Rutas de Enfermedades Transmisibles */
    Route::post('saveCommunicableDiseases', [communicablediseasesController::class, 'store']);
    Route::get('communicableDiseases', [communicablediseasesController::class, 'index']);
    Route::post('communicableDisease',[communicablediseasesController::class, 'show']);
    Route::post('updateCommunicableDiseases', [communicablediseasesController::class, 'update']);
    Route::post('deleteCommunicableDiseases', [communicablediseasesController::class, 'destroy']);
    /* End */

    /* Rutas de Salud de la Mujer */
    Route::post('saveWomenHealth', [womenhealthController::class, 'store']);
    Route::get('womenHealths', [womenhealthController::class, 'index']);
    Route::post('womenHealth', [womenhealthController::class, 'show']);
    Route::post('updateWomenHealth', [womenhealthController::class, 'update']);
    Route::post('deleteWomenHealth', [womenhealthController::class, 'destroy']);
    /* End */

    /* Rutas de Infancia */
    Route::post('saveChildHood', [childhoodController::class, 'store']);
    Route::get('childHoods', [childhoodController::class, 'index']);
    Route::post('childHood', [childhoodController::class, 'show']);
    Route::post('updateChildHood', [childhoodController::class, 'update']);
    Route::post('deleteChildHood', [childhoodController::class, 'destroy']);
    /* End */

    /* Rutas de Adolescencia */
    Route::post('saveAdolescence', [adolescenceController::class, 'store']);
    Route::get('adolescences', [adolescenceController::class, 'index']);
    Route::post('adolescence', [adolescenceController::class, 'show']);
    Route::post('updateAdolescence', [adolescenceController::class, 'update']);
    Route::post('deleteAdolescence', [adolescenceController::class, 'destroy']);
    /* End */

    /* Rutas de Adulto */
    Route::post('saveAdult', [adultController::class, 'store']);
    Route::get('adults', [adultController::class, 'index']);
    Route::post('adult', [adultController::class, 'show']);
    Route::post('updateAdult', [adultController::class, 'update']);
    Route::post('deleteAdult', [adultController::class, 'destroy']);
    /* End */

    /* Rutas de Adulto Mayor */
    Route::post('saveOld', [oldController::class, 'store']);
    Route::get('olds', [oldController::class, 'index']);
    Route::post('old', [oldController::class, 'show']);
    Route::post('updateOld', [oldController::class, 'update']);
    Route::post('deleteOld', [oldController::class, 'destroy']);
    /* End */

    /*Rutas de Viviendas*/
    Route::post('saveYouth', [youthController::class, 'store']);
    Route::get('youths', [youthController::class, 'index']);
    Route::post('youth', [youthController::class, 'show']);
    Route::post('updateYouth', [youthController::class, 'update']);
    Route::post('deleteYouth', [youthController::class, 'destroy']);
    /* End */

    /*Rutas de Viviendas*/
    Route::post('saveGestation', [gestationbirthpostpartumController::class, 'store']);
    Route::get('gestations', [gestationbirthpostpartumController::class, 'index']);
    Route::post('gestation', [gestationbirthpostpartumController::class, 'show']);
    Route::post('updateGestation', [gestationbirthpostpartumController::class, 'update']);
    Route::post('deleteGestation', [gestationbirthpostpartumController::class, 'destroy']);
    /* End */

    //Api Routes GenomaX_Documents End

    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::post('logout', [AuthController::class, 'logOut']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
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
});

Route::get('users', [AuthController::class, 'allUsers']);
Route::get('plans', [PlansController::class, 'show']);

Route::get('/invoice-pdf/{dbname}/{invoice}', [PdfController::class, 'invoicePdf']);
Route::get('/quote-pdf/{dbname}/{invoice}', [PdfController::class, 'quotePdf']);
