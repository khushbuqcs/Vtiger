<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Middleware\ValidateTokenMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// register route
Route::prefix('vtiger/v1')->namespace('App\Http\Controllers\Auth')->group(function () {
    // Auth Controller
    Route::post('/login', 'AuthController@login')->name('auth.login');

    Route::get('/logout', 'AuthController@logout')->name('auth.logout');

});

Route::prefix('vtiger/v1')->middleware('check.vtiger.session')->namespace('App\Http\Controllers')->group(function () {

    // Search Controller
    Route::get('/search', 'SearchController@search')->name('search');
    
    // Email Controller 
    Route::get('/email_attachment', 'EmailController@emailAttachment')->name('attach.email');

    Route::get('/find_email', 'EmailController@findEmail')->name('find.email');


    // Module Controller

    Route::get('/related_module_list', 'ModuleController@relatedModuleList')->name('related.list.module');

    Route::get('/list_module', 'ModuleController@listModule')->name('list.module');

    Route::get('/get_all_module', 'ModuleController@getAllModule')->name('get.all.module');

    Route::get('/fetch_record_with_grouping', 'ModuleController@fetchGroupModule')->name('fetch.record.group');

    Route::get('/fetch_record', 'ModuleController@fetchRecord')->name('fetch.record');

    Route::post('/save_record', 'ModuleController@saveRecord')->name('save.record');


    // Tag Controller
    Route::post('/add_tag', 'TagController@addTag')->name('add.tag');

    Route::get('/tag_list', 'TagController@listTag')->name('list.tag');

    Route::get('/assign_tag', 'TagController@assignTag')->name('assign.tag');

    Route::post('/assigned_tag', 'TagController@assignedTag')->name('assigned.tag');


    // Comment Controller
    Route::get('/list_comment', 'CommentController@listComment')->name('list.comment');

    Route::post('/add_comment', 'CommentController@addComment')->name('add.comment');


    // Describe Controller
    Route::get('/describe', 'DescribeController@describe')->name('describe');


    // History Controller
    Route::get('/history', 'HistoryController@history')->name('history');

});

