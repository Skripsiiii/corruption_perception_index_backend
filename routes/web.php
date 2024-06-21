<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\DimensionController;
use App\Http\Controllers\DimensionResultController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DomicileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ViewPointController;
use App\Models\Questionnaire;
use App\Models\Dimension;

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

Route::get('/', [AuthenticationController::class, "index"]);

Route::get('/verify/notice', [AuthenticationController::class, 'notice'])
->name('verification.notice');

Route::post('/verify/request', [AuthenticationController::class, 'request'])
->name('verification.request');

Route::get('/verify/{id}/{hash}', [AuthenticationController::class, 'verify'])
->name('verification.verify');

Route::middleware('guest')->group(function(){

    Route::get("/login", function () {
        return view('guest.login');
    });
    Route::post("/login", [AuthenticationController::class, "login"])->name("login");

    Route::get("/register", function () {
        return view('guest.register');
    });

    Route::post("/register", [AuthenticationController::class, "register"]);

    Route::get("/forgot", function(){
        return view('guest.forgot-password');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['isUser'])->group(function () {
        Route::get('/participant',[AuthenticationController::class,'userHomeView']);
        Route::get("/getDomicileByYear/{year}", [UserController::class, "getDomicileByYear"]);
        Route::get('/questionnaire', [QuestionnaireController::class, "user_show_option"]);
        Route::get('/unfinished_questionnaire', [QuestionnaireController::class, "questionnaire_history"])->name("my_questionnaire");
        Route::post('/checkQuestionnaire', [QuestionnaireController::class, "check_user_questionnaire"]);
        Route::get('/startQuestionnaire/{year}/{city}', [QuestionnaireController::class, "user_show"]);
        Route::post('/prev_questions', [QuestionnaireController::class, "prev_questions"]);
        Route::post('/next_questions', [QuestionnaireController::class, "next_questions"]);
        Route::post('/userquestionnaire', [ResponseController::class, "storeReponse"]);
        Route::post('/checkQuestionnaireArea', [QuestionnaireController::class, "checkQuestionnaireArea"]);
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin',[AuthenticationController::class,'adminHomeView']);
        Route::resource('questionnaires', QuestionnaireController::class)->only(['store']);

        Route::get('/questionnaire/{questionnaire}', [QuestionnaireController::class, "show"]);

        Route::resource('dimensions', DimensionController::class)->only(['update', 'destroy']);

        Route::post('/questionnaire/{questionnaire}/dimensions', [DimensionController::class, "store"]);

        Route::post('/updateIndicatorChosen', [QuestionnaireController::class, "updateChosenIndicator"]);

        Route::resource('indicators', IndicatorController::class)->only(['store', 'update', 'destroy']);

        Route::resource('questions', QuestionController::class)->only(['show', 'store', 'update', 'destroy']);

        Route::resource('participants', UserController::class)->only(['index', 'show', 'destroy']);

        Route::resource("responses", ResponseController::class)->only(['show', 'destroy']);
        Route::get("/searchResponse/{response}", [ResponseController::class, "searchResponse"]);
        Route::get("/responses/{response}/{id}", [ResponseController::class, "showDetail"]);

        Route::get("/getCities", [CityController::class, "getCities"]);
        Route::get("/getIndicators", [IndicatorController::class, "getIndicators"]);

        Route::get("/searchAnswer/{response}", [AnswerController::class, "searchAnswer"]);
        Route::get("/searchQuestion/{questionnaire}", [QuestionController::class, "searchQuestion"]);
        Route::get("/searchParticipant", [UserController::class, "searchParticipants"]);

        Route::get("/calculateDimensionResult/{response}", [ResponseController::class, "calculateDimensionResult"]);
        Route::get("/calculateProvinceResult/{response}", [ResponseController::class, "calculateProvinceResult"]);
        Route::get("/searchAdmins", [AdminController::class, "searchAdmins"]);

        Route::get("/changePassword", function () {
            return view("admin.change-password");
        });

        Route::get('/dashboard/{questionnaire}', function ($questionnaire) {
            $questionnaire = Questionnaire::where("year", "=", $questionnaire)->first();

            $dimensionGroup = $questionnaire->dimensions()->withAvg("dimensionResults as cpi_score", "corruption_index")->get()->pluck("cpi_score", "name");

            $data = [
                "questionnaire" => $questionnaire,
                "dimensionGroup" => $dimensionGroup
            ];
            return view('admin.dashboard', $data);
        });

        Route::get('/statistic', [DimensionResultController::class, "index"]);

        Route::middleware('superadmin')->group(function () {
            Route::resource('/admins', AdminController::class)->only(['index', 'store', 'destroy']);
            Route::get('/admins/accept/{admin}', [AdminController::class, "accept"]);
            Route::get('/admins/promote/{admin}', [AdminController::class, "promote"]);
        });
    });

    // table data
    Route::get('/provinceData', [ProvinceController::class, 'provinceDataCorruption']);
    Route::get('/provinceResponse', [ProvinceController::class, "export_provinces"]);
    Route::get('/cityResponse/{province_id}', [CityController::class, "export_cities"]);
    Route::get('/cityData/{id}', [CityController::class, 'cityCorruptionData']);
    Route::get('/dimensionCityData/{id}', [DimensionController::class, 'dimensionCorruptionData']);
    Route::get('/indicatorCityData/{id}', [IndicatorController::class, 'indicatorCorruptionData']);
    // end table data

    Route::get('/map', [ProvinceController::class, "mapView"]);
    Route::get('/map/{city}', [CityController::class, "cityView"]);


    //settings
    Route::get('/settings/editprofile', [UserController::class, 'editPofileView'])->name("editProfileView");
    Route::get('/settings/changepassword', [UserController::class, 'accountSettingView'])->name("changePasswordView");
    Route::get('/settings/domicilie', [UserController::class, 'domicilieView'])->name("domicilieView");
    Route::get('/settings/viewpoint', [UserController::class, 'viewPointView'])->name("viewPointView");

    Route::post('/changePassword', [UserController::class, 'changePassword'])->name("changePassword");
    Route::post('/updateProfile', [UserController::class, "updateProfile"])->name("updateProfile");
    Route::post('/domiciles', [DomicileController::class, 'store']);
    Route::post('/viewPointUpdate', [ViewPointController::class, 'viewPointUpdate']);
    // end settings

    Route::get("/getCities", [CityController::class, "getCities"]);
});

Route::get("/logout", [AuthenticationController::class, "logout"]);

// Route::get("/getProvinces", [ProvinceController::class, "getProvinces"]);
// Route::get("/getCitiesResult", [ProvinceController::class, "getCitiesResult"]);

// Route::get('/profile', function () {
//     return view("user.edit-profile");
// });



// Route::post('/changePassword', [AuthController::class, "changePassword"]);

Route::get('/randomDataView', [ResponseController::class, "randomDataView"]);
Route::get('/randomData/{startNumber}/{endNumber}/{check}', [ResponseController::class, "randomData"]);
Route::get('/randomDataNoAnswers', [ResponseController::class, "randomDataNoAnswers"]);

// Route::get('/provinceData', [ProvinceController::class, 'provinceDataCorruption']);
// Route::get('/cityData/{id}', [CityController::class, 'cityCorruptionData']);
// Route::get('/dimensionCityData/{id}', [DimensionController::class, 'dimensionCorruptionData']);
// Route::get('/indicatorCityData/{id}', [IndicatorController::class, 'indicatorCorruptionData']);





//testing
// Route::get('/layoutTesting', [Controller::class, 'index']);
// Route::get('/homepage', [Controller::class, 'index1']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

