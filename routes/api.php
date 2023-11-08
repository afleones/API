<?php

// Controladores sin uso
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
// Controladores sin uso


// Laravel Libraries
use Illuminate\Http\Request;
use App\Http\Middleware\SwitchDatabaseMiddleware;
use Illuminate\Support\Facades\Route;
// Laravel Libraries End

// API Controllers
use App\Http\Controllers\Api\AuthController; /* Controlador de Autenticación */
use App\Http\Middleware\CorsMiddleware; /* Politicas de Seguridad API */
use App\Http\Controllers\UsersAccountsController; /* controlador de Usuarios */
// API Controllers End

//Api Controllers GenomaX_Documents Start
use App\Http\Controllers\Documents\livingplaceController; /* Controlador de Viviendas */
use App\Http\Controllers\Documents\personController; /* Controlador de Personas */
use App\Http\Controllers\Documents\companyController; /* controlador de Compañía */
use App\Http\Controllers\Documents\roleController; /* controlador de Roles */
use App\Http\Controllers\Documents\childhoodController; /* controlador de Infancia */
use App\Http\Controllers\Documents\earlychildhoodController; /* controlador de Primera Infancia */
use App\Http\Controllers\Documents\communicablediseasesController; /* controlador de Enfermedades Transmisibles */
use App\Http\Controllers\Documents\womenhealthController; /* controlador de Salud de la Mujer */
use App\Http\Controllers\Documents\adolescenceController; /* controlador de Adolescentes */
use App\Http\Controllers\Documents\adultController; /* controlador de Adulto */
use App\Http\Controllers\Documents\oldController; /* controlador de Adulto Mayor */
use App\Http\Controllers\Documents\youthController; /* controlador de Adulto Mayor */
use App\Http\Controllers\Documents\gestationbirthpostpartumController; /* controlador de Adulto Mayor */
//Api Controllers GenomaX_Documents End

// Academy Controllers
use App\Http\Controllers\Academy\AcademyCategoryController; /* Controlador de Categorias */
use App\Http\Controllers\Academy\AcademyCourseController; /* Controlador de Cursos */
use App\Http\Controllers\Academy\AcademyClassController; /* Controlador de Clases */
use App\Http\Controllers\Academy\AcademyStudentController; /* Controlador de Estudiantes */
use App\Http\Controllers\Academy\AcademyCommentController; /* Controlador de Comentarios */
use App\Http\Controllers\Academy\AcademyVideoController; /* Controlador de Carga de videos */
use App\Http\Controllers\Academy\AcademyExamController; /* Controlador de Examenes */
use App\Http\Controllers\Academy\AcademyCertificateController; /* Controlador de Certificados */
// Academy Controllers End

//Meet Controllers

/* Events Controller */
use App\Http\Controllers\Meets\MeetEventsController; /* Conttolador de Eventos */
/* end */

/* Aqui inician las Rutas de la API */

// rutas para gestionar Usuarios
Route::post('register', [AuthController::class, 'register']); /* endPoint para Registrar Nuevo Usuario */
Route::post('login', [AuthController::class, 'login']); /* endPoint para Iniciar Sesion */
Route::get('users', [AuthController::class, 'allUsers']); /* endPoint para Listar Todos los Usuarios  */
// End

// Controllers app Meet
Route::post('subir-video', [AcademyVideoController::class, 'subirVideo']); /* endPoint para Almacenar Videos */
//Route::get('/exportar', 'livingplaceController@export');
Route::get('exportarhouse', [livingplaceController::class, 'export']);
Route::group(['middleware'=>['auth:sanctum', SwitchDatabaseMiddleware::class]], function(){

    //Api Controllers GenomaX_Documents Start

    /*Rutas de Viviendas*/
    Route::post('saveLivingPlace', [livingplaceController::class, 'store']); /* endPoint para crear */
    Route::get('livingPlaces', [livingplaceController::class, 'index']); /* endPoint para Listar */
    Route::post('livingplace', [livingplaceController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('showLivingplacePerson', [livingplaceController::class, 'showLivingplacePerson'])->middleware(CorsMiddleware::class);
    Route::get('/download-excel', 'LivingplaceController@downloadExcel');
    Route::post('updateLivingPlace', [livingplaceController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteLivingPlace', [livingplaceController::class, 'destroy']); /* endPoint para Borrar */
    Route::post('showTableLivingPlace', [livingplaceController::class, 'showTableLivingPlace']);
    /* End */

    /* Rutas de Personas */
    Route::post('savePerson', [personController::class, 'store']); /* endPoint para crear */
    Route::get('People', [personController::class, 'index']); /* endPoint para listar */
    Route::post('Person', [personController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updatePerson', [personController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deletePerson', [personController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Empresas */
    Route::post('saveCompany', [companyController::class, 'store']); /* endPoint para crear */
    Route::get('companies', [companyController::class, 'index']); /* endPoint para Listar */
    Route::post('company', [companyController::class, 'show']); /* endPoint para Mostrar {ID} */
    Route::post('updateCompany', [companyController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteCompany', [companyController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Roles */
    Route::post('saveRole', [roleController::class, 'store']); /* endPoint para crear */
    Route::get('roles', [roleController::class, 'index']); /* endPoint para Listar */
    Route::post('role', [roleController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateRole', [roleController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteRole', [roleController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Primera Infancia */
    Route::post('saveEarlyChildHood', [earlychildhoodController::class, 'store']); /* endPoint para crear */
    Route::get('earlyChildHoods', [earlychildhoodController::class, 'index']); /* endPoint para Listar */
    Route::post('earlyChildHood', [earlychildhoodController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateEarlyChildHood', [earlychildhoodController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteEarlyChildHood', [earlychildhoodController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Enfermedades Transmisibles */
    Route::post('saveCommunicableDiseases', [communicablediseasesController::class, 'store']); /* endPoint para crear */
    Route::get('communicableDiseases', [communicablediseasesController::class, 'index']); /* endPoint para Listar */
    Route::post('communicableDisease',[communicablediseasesController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateCommunicableDiseases', [communicablediseasesController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteCommunicableDiseases', [communicablediseasesController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Salud de la Mujer */
    Route::post('saveWomenHealth', [womenhealthController::class, 'store']); /* endPoint para Crear */
    Route::get('womenHealths', [womenhealthController::class, 'index']); /* endPoint para Listar */
    Route::post('womenHealth', [womenhealthController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateWomenHealth', [womenhealthController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteWomenHealth', [womenhealthController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Infancia */
    Route::post('saveChildHood', [childhoodController::class, 'store']); /* endPoint para Crear */
    Route::get('childHoods', [childhoodController::class, 'index']); /* endPoint para Listar */
    Route::post('childHood', [childhoodController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateChildHood', [childhoodController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteChildHood', [childhoodController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Adolescencia */
    Route::post('saveAdolescence', [adolescenceController::class, 'store']); /* endPoint para Crear */
    Route::get('adolescences', [adolescenceController::class, 'index']); /* endPoint para Listar */
    Route::post('adolescence', [adolescenceController::class, 'show']); /* endPoint para Mostrar {id} */
    Route::post('updateAdolescence', [adolescenceController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteAdolescence', [adolescenceController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Adulto */
    Route::post('saveAdult', [adultController::class, 'store']); /* endPoint para  */
    Route::get('adults', [adultController::class, 'index']); /* endPoint para  */
    Route::post('adult', [adultController::class, 'show']); /* endPoint para  */
    Route::post('updateAdult', [adultController::class, 'update']); /* endPoint para  */
    Route::post('deleteAdult', [adultController::class, 'destroy']); /* endPoint para  */
    /* End */

    /* Rutas de Adulto Mayor */
    Route::post('saveOld', [oldController::class, 'store']); /* endPoint para Crear */
    Route::get('olds', [oldController::class, 'index']); /* endPoint para Listar */
    Route::post('old', [oldController::class, 'show']); /* endPoint para Mostrat {id} */
    Route::post('updateOld', [oldController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteOld', [oldController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Juventud */
    Route::post('saveYouth', [youthController::class, 'store']); /* endPoint para Guardar */
    Route::get('youths', [youthController::class, 'index']); /* endPoint para  Listar */
    Route::post('youth', [youthController::class, 'show']); /* endPoint para Nostrat {id} */
    Route::post('updateYouth', [youthController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteYouth', [youthController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Rutas de Gestacion Parto y PostParto */
    Route::post('saveGestation', [gestationbirthpostpartumController::class, 'store']); /* endPoint para Crear */
    Route::get('gestations', [gestationbirthpostpartumController::class, 'index']); /* endPoint para Listar */
    Route::post('gestation', [gestationbirthpostpartumController::class, 'show']); /* endPoint para  Mostrar {id} */
    Route::post('updateGestation', [gestationbirthpostpartumController::class, 'update']); /* endPoint para Actualizar */
    Route::post('deleteGestation', [gestationbirthpostpartumController::class, 'destroy']); /* endPoint para Borrar */
    /* End */

    /* Estadisticas */
    Route::post('getLivingplaces', [livingplaceController::class, 'showLivingplace']);
    Route::post('getCaminantes', [personController::class, 'showCaminante']);
    /* End */

    /* Rutas de Usuarios */
    Route::post('createUser', [AuthController::class, 'store']);
    Route::post('updateUser', [AuthController::class, 'update']);
    Route::post('updateAcademyUser', [AuthController::class, 'updateAcademyUser']);
    /* End */

    /* Rutas para Listar Lideres */
    Route::post('showLider', [AuthController::class, 'showLider']); /* endPoint para Listar Usuarios con rol de Lider  */
    /* End */


    //Api Routes GenomaX_Documents End


    //Api Routes Academy Start
    Route::get('Categories', [AcademyCategoryController::class, 'index']);
    Route::post('Category', [AcademyCategoryController::class, 'show']);
    Route::post('SaveCategory', [AcademyCategoryController::class, 'store']);
    Route::post('UpdateCategory', [AcademyCategoryController::class, 'update']);
    Route::get('DeleteCategory', [AcademyCategoryController::class, 'destroy']);

    
    Route::post('CoursexCategory', [AcademyCategoryController::class, 'showCoursexCategory']);
    Route::post('CoursexCategoryStudent', [AcademyCategoryController::class, 'showCoursexCategoryStudent']);

    Route::get('Courses', [AcademyCourseController::class, 'index']);
    Route::post('Course', [AcademyCourseController::class, 'show']);
    Route::post('SaveCourse', [AcademyCourseController::class, 'store']);
    Route::post('UpdateCourse', [AcademyCourseController::class, 'update']);
    Route::get('DeleteCourse', [AcademyCourseController::class, 'destroy']);


    Route::get('Classes', [AcademyClassController::class, 'index']);
    Route::post('Class', [AcademyClassController::class, 'show']);
    Route::post('SaveClass', [AcademyClassController::class, 'store']);
    Route::post('UpdateClass', [AcademyClassController::class, 'update']);
    Route::get('DeleteClass', [AcademyClassController::class, 'destroy']);

    Route::get('Students', [AcademyStudentController::class, 'index']);
    Route::post('Student', [AcademyStudentController::class, 'show']);
    Route::post('SaveStudent', [AcademyStudentController::class, 'store']);
    Route::post('UpdateStudent', [AcademyStudentController::class, 'update']);


    Route::get('Comments', [AcademyCommentController::class, 'index']);
    Route::post('Comment', [AcademyCommentController::class, 'show']);
    Route::post('SaveComment', [AcademyCommentController::class, 'store']);
    Route::post('DeleteComment', [AcademyCommentController::class, 'destroy']);
    Route::post('DeleteCommentDetail', [AcademyCommentController::class, 'destroyDetail']);
    Route::post('SaveCommentDetail', [AcademyCommentController::class, 'storeDetail']);
    Route::post('UpdateComment', [AcademyCommentController::class, 'update']);
    Route::post('UpdateCommentDetail', [AcademyCommentController::class, 'updateDetail']);


    
    Route::post('insertExam', [AcademyExamController::class, 'insertExam']);
    Route::post('showExams', [AcademyExamController::class, 'showExams']);
    Route::post('updateExam', [AcademyExamController::class, 'updateExam']);

    Route::get('Certificates', [AcademyCertificateController::class, 'index']);
    Route::post('Certificate', [AcademyCertificateController::class, 'show']);
    Route::post('saveCertificate', [AcademyCertificateController::class, 'store']);
    Route::post('updateCertificate', [AcademyCertificateController::class, 'update']);
    Route::get('/ViewPDF/{certificate}', [AcademyCertificateController::class, 'ViewPDF']);
    Route::post('storeExamCertificateStudent', [AcademyCertificateController::class, 'storeExamCertificateStudent']);
    Route::post('showCertificateStudent', [AcademyCertificateController::class, 'showCertificateStudent']);

    //Api Routes Academy End


    //Api Routes Meet Start

    /* events */
    Route::post('createEvent', [MeetEventsController::class, 'store']); /* endPoint para crear nuevo Evento */
    Route::post('showEvents', [MeetEventsController::class, 'index']); /* endPoint para Listar Eventos y sus Invitados */
    Route::post('updateEvent', [MeetEventsController::class, 'update']); /* endPoint para Actualizar Evento */
    Route::post('event', [MeetEventsController::class, 'show']); /* endPoint para Listar Eventos */
    Route::post('notify', [MeetEventsController::class, 'validarReunion']); /* endPoint para Validar si estoy invitado a una reunion */
    Route::post('notification', [MeetEventsController::class, 'notifyStatus']); /* endPoint para Notificar al creador de la reunion */
    Route::post('discard', [MeetEventsController::class, 'deleteNotification']); /* endPoint para Eliminar una Notificacion  */
    Route::get('guests', [AuthController::class, 'showGuests']); /* endPoint para Listar Usuarios Docente o Estudiante */
    /* end */

    //Api Routes Meet end


    /* Rutas no Pertenecientes a Maite_Backend */
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
    /* Rutas no Pertenecientes a Maite_Backend */

});

Route::get('plans', [PlansController::class, 'show']);

Route::get('/invoice-pdf/{dbname}/{invoice}', [PdfController::class, 'invoicePdf']);
Route::get('/quote-pdf/{dbname}/{invoice}', [PdfController::class, 'quotePdf']);
