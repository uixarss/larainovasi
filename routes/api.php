<?php

use Illuminate\Http\Request;


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


/**
 * URL API untuk E-Perencanaan
 *
 */
Route::group(['prefix' => 'v1'], function () {
    
    Route::group(['middleware' => 'auth:api'], function () {

        /**
         * Inovasi Daerah
         */
        Route::get('inovasi/all', 'API\InovasiController@all');
        Route::post('inovasi/filter', 'API\InovasiController@filter'); // parameter nama_inovasi
        Route::get('skpd/{kd_unit}/inovasi', 'API\InovasiController@inovasiOPD'); 

        /**
         * Data OPD
         * 
         */
        Route::get('data/skpd/all', 'API\InovasiController@dataOPD');



    });
});