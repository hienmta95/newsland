<?php

Route::group(['middleware' => ['web'], 'prefix' => ''], function()
{

    Route::get('', 'HomepageController@index')->name('homepage');

    Route::get('/{id}/{slug}', 'BietthuController@getBietthu')->name('bietthu');

    Route::get('/tinh-thanh-pho/{id}/{slug}', 'BietthuController@getThanhpho')->name('thanhpho');
    Route::get('/quan-huyen/{id}/{slug}', 'BietthuController@getQuanhuyen')->name('quanhuyen');
    Route::get('/category/{id}/{slug}', 'BietthuController@getTheloai')->name('theloai');

    Route::get('/gioi-thieu/{id}/{slug}', 'PageController@getGioithieu')->name('gioithieu');
    Route::get('/noi-that/{id}/{slug}', 'PageController@getNoithat')->name('noithat');
    Route::get('/tin-tuc/{id}/{slug}', 'PageController@getTintuc')->name('tintuc');

    Route::get('/tin-tuc', 'PageController@getTintucList')->name('tintuc.list');
    Route::get('/noi-that', 'PageController@getNoithatList')->name('noithat.list');
    Route::get('/gioi-thieu', 'PageController@getGioithieuList')->name('gioithieu.list');


    Route::get('/lien-he', 'FrontendController@getLienhe')->name('lienhe');
    Route::post('/lien-he', 'FrontendController@postLienhe')->name('post.lienhe');
    Route::get('/lien-he-thanh-cong', 'FrontendController@getLienhethanhcong')->name('get.thanhcong');
    Route::get('/videos', 'FrontendController@getVideos')->name('videos');

    Route::get('/search', 'FrontendController@getSearch')->name('search');

});
