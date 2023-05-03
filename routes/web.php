<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employees;
use  App\Http\Controllers\OtpController;
// use App\Http\Controllers\Admin\AuthenticatedSessionController;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('tags',TagController::class);
Route::resource('authors',AuthorController::class);
Route::resource('blogs',BlogController::class);

Route::post('/fetchsubcategory/{id}', [BlogController::class, 'fetchsubcategory']);
// Route::get('blogs/create', [BlogController::class, 'create']);
// Route::post('blogs/store', [BlogController::class, 'store']);
Route::get('students',[StudentController::class,'index'])->name('students.index');

Route::get('students/create',[StudentController::class,'create'])->name('students.create');
Route::post('students',[StudentController::class,'store'])->name('students.store');

// Route::resource('students',StudentController::class);
Route::resource('employees',EmployeeController::class);
// Route::get('employees', [EmployeeController::class, 'index']);

// Route::get('employees/list', [EmployeeController::class, 'getEmployees'])->name('employees.list');

// Route::get('employees',[EmployeeController::class,'index']);
// Route::post('employees',[EmployeeController::class,'store']);
// Route::get('employees/{employee}',[EmployeeController::class,'show']);

//admin route

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->group(function(){
        // Route::get('register',[AuthenticatedSessionController::class, 'getLogin'])->name('login');
        // Route::post('register',[AuthenticatedSessionController::class, 'getLogin'])->name('login');

        Route::get('login',[AuthenticatedSessionController::class, 'getLogin'])->name('login');
        Route::post('login',[AuthenticatedSessionController::class, 'postLogin'])->name('adminlogin');

    });

    Route::middleware('admin')->group(function(){
        Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('adminhome');
    });

    Route::get('logout',[AuthenticatedSessionController::class, 'adminLogout'])->name('logout');
});

// Route::Controller([OtpController::class])->group(function(){
    Route::get('/otp/login',[OtpController::class,'login'])->name('otp.login');
// }); 
   Route::post('/otp/generate',[OtpController::class,'generate'])->name('otp.generate');
   Route::get('/otp/verification/{user_id}', [OtpController::class,'verification'])->name('otp.verification');
   Route::post('/otp/login', [OtpController::class,'loginWithOtp'])->name('otp.getlogin');





//    Route::namespace('Auth')->group(function(){
//             Route::get('/register/generate',[RegisterController::class,'generate'])->name('register.generate');

//    });
  
// Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
//     Route::namespace('Auth')->middleware('guest:admin')->group(function(){
//         // login route
//         Route::get('login','AuthenticatedSessionController@create')->name('login');
//         Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
//     });
//     Route::middleware('admin')->group(function(){
//         Route::get('dashboard','HomeController@index')->name('dashboard');

//         Route::get('admin-test','HomeController@adminTest')->name('admintest');
//         Route::get('editor-test','HomeController@editorTest')->name('editortest');

//         Route::resource('posts','PostController');

//     });
//     Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
// });

