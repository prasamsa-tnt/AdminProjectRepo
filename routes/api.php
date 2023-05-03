<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Model\Blog;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BlogController;

use App\Http\Controllers\UserControllerPassport;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});

// Route::resource('blog',ApiBlogController::class);
Route::get('employees',[EmployeeController::class,'index']);
Route::post('employees',[EmployeeController::class,'store']);
Route::get('employees/{employee}',[EmployeeController::class,'show']);
 

Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login',[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function () {
   Route::get('/me',function(Request $request){
    return auth()->user();
   });
//    Route::post('/auth/logout',[AuthController::class,'logout']);
});

Route::middleware('auth:api')->get('/user',function (Request $request) {
      
   return $request()->user();
  });
Route::post('/login',[UserControllerPassport::class,'userlogin']);
Route::post('/register',[UserControllerPassport::class,'userregister']);

Route::group(['middleware'=>['auth:api']],function () {
     
      // Route::get('blogs',[BlogController::class,'index']);
      Route::post('blogs',[BlogController::class,'store']);
      // Route::get('blogs/{blog}',[BlogController::class,'show']);

   Route::get('/details',[UserControllerPassport::class,'details']);
   });

// Route::middleware('auth:api')->group(function () {
//    Route::resource('posts', PostController::class);
// });

// Route::get('blogs/index',[BlogController::class,'index']);

Route::get('categories',[CategoryController::class,'index']);
Route::post('categories',[CategoryController::class,'store']);
Route::get('categories/{category}',[CategoryController::class,'show']);


Route::get('blogs',[BlogController::class,'index']);
// Route::post('blogs',[BlogController::class,'store']);
Route::get('blogs/{blog}',[BlogController::class,'show']);

