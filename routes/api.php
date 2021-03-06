<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('register', 'api\RegisterController@cekRegist');
//Route::post('register', 'api\RegisterController@register')->name('register');
// Route::post('login', 'AuthController@login');

// Route::group(["middleware" => "jwt.auth"], function () {
//     Route::post('logout', 'AuthController@logout');
// });

Route::get('userinformation', 'api\BaseController@getUserInfo');
Route::get('index_classroom/file/{id_tugas}', 'api\BaseController@itemFile');

Route::post('refresh', 'AuthController@refresh');
Route::patch('user/update/profile/{id}', 'api\BaseController@updateProfile');
Route::get('faq-content', 'api\BaseController@getFaq');

Route::group(['middleware' => 'api.role:guru'], function () {
    Route::get('GuruSchedule', 'api\GuruInteractionController@GuruSchedule');
    Route::post('GuruSchedule/create_tugas/{id_jadwal}', 'api\GuruInteractionController@tugas_kelas');
    Route::get('GuruSchedule/index_classroom_guru/{id_jadwal}', 'api\GuruInteractionController@IndexClassroom');
    Route::get('GuruSchedule/index_classroom_guru/checkTask', 'api\GuruInteractionController@showCompletedUser');
    Route::get('GuruSchedule/checkTask', 'api\GuruInteractionController@showCompletedUser');
    Route::patch('GuruSchedule/nilai', "api\GuruInteractionController@setNilai");
    Route::get('listprof', 'api\GuruInteractionController@listProf');
});
Route::group(['middleware' => 'api.role:siswa'], function () {
    Route::get('SiswaSchedule', 'api\SiswaInteractionController@SiswaSchedule');
    Route::get('SiswaSchedule/index_classroom_siswa/{id_jadwal}', 'api\SiswaInteractionController@ClassRoomIndex');
    Route::post('SiswaSchedule/index_classroom_siswa/assign/{id_tugas_kelas}', 'api\SiswaInteractionController@assignTask');
});

Route::get('index_classroom/memberclass', 'api\ClassroomController@getMemberClass');
Route::get('classInfo', 'api\ClassroomController@getInfoClass');
Route::patch('upload/{id}', 'api\UploadController@uploadImageDecoded');
Route::get('get-image', 'api\UploadController@getPhoto');

Route::get('getHelp', 'api\BaseController@getHelp');

Route::post('GuruSchedule/create_tugas/{id_jadwal}', 'api\GuruInteractionController@tugas_kelas');

Route::post('Update_Profile/{id_user}', 'api\BaseController@updateprofile');
Route::get('ShowKelas', 'api\SiswaInteractionController@showkelas');

//========================================
//Forgot Reset Password
//========================================
// Route::post('forgot', 'api\ForgotPasswordController@forgot');
// Route::get('find/{token}', 'api\ForgotPasswordController@find');
// Route::post('resetpassword', 'api\ForgotPasswordController@reset');
//========================================
