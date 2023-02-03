<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\SingleAuctionController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegistrationController;
use App\Models\Customer;
use App\Http\Controllers\CustomerController;
use App\Models\ImageGallery;
use App\Http\Controllers\ImageGalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Route::get('/register',[RegistrationController::class,'index']);
Route::post('/register',[RegistrationController::class,'register']);

Route::get('/customer',[CustomerController::class,'index']);
Route::post('/customer',[CustomerController::class,'store']);

Route::get('/image-gallery',[ImageGalleryController::class,'index']);
Route::post('/image-gallery',[ImageGalleryController::class,'upload']);

Route::delete('/image-gallery/{id}',[ImageGalleryController::class,'destroy']);




// Route::get('/customer',function(){
//     $customers = Customer::all();
//     echo"<pre>";
//     print_r($customers ->toArray());

// });

// Route::get('/',[DemoController::class,'index']);
// Route::get('/courses',SingleAuctionController::class);

// Route::resource('photo',PhotoController::class);

// Route::get('/', function(){
//     return view('homes');
// });

// Route::get('/about',function(){
//     return view('about');
// });

// Route::get('/courses',function(){
//     return view('courses');
// });


// Route::get('/{name?}',function($name=null){
//     $demo = "<h2>biswajitDas</h2>";
//     $data = compact('name','demo');
//     return view('home')->with($data);
// });
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/demo/{name}/{id?}',function($name,$id = null){
//     echo $name . "  ";
//     echo $id;
// });

// Route::get('/demo/{name}/{id?}',function($name,$id = null){
//     //viewpage
//     $data = compact('name','id');
//    // print_r($data);
//    //now we send the data forward 
//    return view('demo') -> with ($data);
// });


// Route::get('/demo',function(){
//     return view('demo');
// });
// Route::get('/demo',function(){
//     echo"hi biswajit";
// });

// Route::post('/test',function(){
//     echo"Testing the route";
// });
// Route::put('users/{id}',function ($id){

// });
// Route::patch();

// Route::delete('users/{id}',function {$id}{

// });

// Route::any('/test',function(){
//     echo"any testing";
// });
