<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DimensionController;
use App\Http\Controllers\DomicileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ProvinceController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewPointDetailController;
use App\Http\Controllers\ViewPointController;
use App\Http\Controllers\FileController;
use App\Models\Product;
use App\Models\Questionnaire;
use Database\Factories\ViewPointDetailFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::resource('/products',ProductController::class);
// Route::get('/products/search/{name}',[ProductController::class,'search']);
// Route::get('/products', [ProductController::class,'index']);
// Route::post('/products',[ProductController::class,'store']);

Route::post("/auth/store",[AuthenticationController::class,"store"]);

Route::post("/auth/login",[AuthenticationController::class,"loginApp"]);
Route::post('/auth/register', [AuthenticationController::class, "registerApp"]);

Route::middleware('auth:sanctum')->group(function(){
    // Questionaire
    Route::get('/startQuestionnaire/{year}/{city}', [QuestionnaireController::class, "user_show_app"]);
    Route::post('/prev_questions', [QuestionnaireController::class, "prev_questions"]);
    Route::post('/next_questions', [QuestionnaireController::class, "next_questions"]);
    // 

    // Maps
    Route::get('/map', [ProvinceController::class, "mapViewApp"]);
    Route::get('/map/{city}', [CityController::class, "cityViewApp"]);
    // 

    // Data
    Route::get('/provinceData', [ProvinceController::class, 'provinceDataCorruptionApp']);
    Route::get('/cityData/{id}', [CityController::class, 'cityCorruptionDataApp']);
    Route::get('/dimensionCityData/{id}', [DimensionController::class, 'dimensionCorruptionDataApp']);
    Route::get('/indicatorCityData/{id}', [IndicatorController::class, 'indicatorCorruptionDataApp']);
    // 

    // Menu
    Route::post('/updateProfile', [UserController::class, "updateProfileApp"])->name("updateProfileApp");
    Route::post('/changePassword', [UserController::class, 'changePasswordApp'])->name("changePasswordApp");
    Route::post('/addDomiciles', [DomicileController::class, 'newDomicile']);
    Route::post('/viewpoints', [ViewPointController::class, "storeViewpoints"]);
    Route::post('/updateViewpoints', [ViewPointController::class, "viewPointUpdateApp"]);

    Route::get('/myProfile', [UserController::class, "myProfile"]);
    Route::get('/myDomicile', [UserController::class, "myDomicile"]);
    Route::get('/viewpointsResponse', [ViewpointController::class, "getViewpointResponses"]);
    Route::get('/unfinished_questionnaire', [QuestionnaireController::class, "questionnaire_history_app"])->name("my_questionnaire");
    // 
});

// Province Dropdown List
Route::get("/provinces", [ProvinceController::class, "getProvincesApp"]);
// City Dropdown List
Route::get("/cities/{provinceId}", [CityController::class, "getCitiesApp"]);
// Education Dropdown List
Route::get('/educations', [EducationController::class, "getEducation"]);
// Occupation Dropdown List
Route::get('/occupations', [OccupationController::class, "getOccupation"]);
// Viewpoints Statement
Route::get('/viewpoints', [ViewpointController::class, "getViewpoints"]);

Route::get('/questions', [QuestionsController::class, "getQuestion"]);

// logout
Route::post('/logout', [AuthenticationController::class, "logoutApp"]);


// Route::middleware('auth:sanctum')->group(function(){
//     Route::get('/auth/user', [AuthenticationController::class, "getUser"]);
//     Route::post('/auth/user/update', [AuthenticationController::class, "update"]);
//     Route::post('/auth/user/changePassword', [AuthenticationController::class, "changePassword"]);


//     Route::post('/auth/Response/store', [ResponseController::class, "store"]);
//     Route::post('/auth/Response/participantValidation', [ResponseController::class, "participantValidation"]);

    

//     Route::GET('/auth/user/getUserCities', [AuthenticationController::class, "getUserCities"]);
//     Route::GET('/auth/user/getQuestionnaire', [QuestionnaireController::class, "getQuestionnaire"]);
//     Route::GET('/auth/user/getQuestion', [QuestionsController::class, "getQuestion"]);
//     Route::get('/auth/user/getEducation', [EducationController::class, "getEducation"]);
//     Route::get('/auth/user/getOccupation', [OccupationController::class, "getOccupation"]);
//     Route::get('/auth/viewPointDetail/getViewPointDetail', [ViewPointDetailController::class, "getViewPointDetail"]);


//     // Route for logging out
//     Route::post('/auth/logout', [AuthenticationController::class, "logout"]);
// });

//admin
Route::get("/dimension/getDimensionTotal",[DimensionController::class,"getDimensionTotal"]);
Route::get("/dimension/getDimension",[DimensionController::class,"getDimension"]);

Route::get("/indicator/getIndicatorTotal",[IndicatorController::class,"getIndicatorTotal"]);
Route::get("/indicator/getIndicator",[IndicatorController::class,"getIndicator"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
