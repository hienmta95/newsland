<?php

Route::group(['prefix' => 'admin'], function() {

    config(['session.cookie' => 'newsland_admin_cookie']);

    Route::get('/login', 'BackendLoginController@showLoginForm')->name('backend.login');
    Route::post('/login', 'BackendLoginController@login')->name('backend.login.submit');
    Route::get('/logout', 'BackendLoginController@logout')->name('backend.logout');

    // indexData
    Route::get('/user/indexData', 'UserController@indexData')->name('backend.user.indexData');
    Route::get('/slide/indexData', 'SlideController@indexData')->name('backend.slide.indexData');
    Route::get('/minislide/indexData', 'MinislideController@indexData')->name('backend.minislide.indexData');
    Route::get('/lienhe/indexData', 'LienheController@indexData')->name('backend.lienhe.indexData');
    Route::get('/tintuc/indexData', 'TintucController@indexData')->name('backend.tintuc.indexData');
    Route::get('/noithat/indexData', 'NoithatController@indexData')->name('backend.noithat.indexData');
    Route::get('/thanhpho/indexData', 'ThanhphoController@indexData')->name('backend.thanhpho.indexData');
    Route::get('/quan/indexData', 'QuanController@indexData')->name('backend.quan.indexData');
    Route::get('/theloai/indexData', 'TheloaiController@indexData')->name('backend.theloai.indexData');
    Route::get('/menu/indexData', 'MenuController@indexData')->name('backend.menu.indexData');
    Route::get('/gioithieu/indexData', 'GioithieuController@indexData')->name('backend.gioithieu.indexData');
    Route::get('/video/indexData', 'VideoController@indexData')->name('backend.video.indexData');
    Route::get('/bietthu/indexData', 'BietthuController@indexData')->name('backend.bietthu.indexData');


    // image ajax
    Route::post('/bietthu/image/delete/{product_id}', 'BietthuController@deleteImage')->name('backend.bietthu.image.delete');
    Route::post('/upload', 'BietthuController@uploadImage')->name('backend.uploadPhoto');


    Route::group(['middleware' => ['adminLogin']], function() {
        Route::get('/', 'BietthuController@index')->name('backend.dashboard');

        // Management
        Route::get('/user', 'UserController@index')->name('backend.user.index');
        Route::get('/user/create', 'UserController@create')->name('backend.user.create');
        Route::post('/user', 'UserController@store')->name('backend.user.store');
        Route::get('/user/view/{id}', 'UserController@show')->name('backend.user.show');
        Route::get('/user/update/{id}', 'UserController@edit')->name('backend.user.edit');
        Route::put('/user/update/{id}', 'UserController@update')->name('backend.user.update');
        Route::delete('/user/delete/{id}', 'UserController@destroy')->name('backend.user.destroy');

        // Management
        Route::get('/slide', 'SlideController@index')->name('backend.slide.index');
        Route::get('/slide/create', 'SlideController@create')->name('backend.slide.create');
        Route::post('/slide', 'SlideController@store')->name('backend.slide.store');
        Route::get('/slide/view/{id}', 'SlideController@show')->name('backend.slide.show');
        Route::get('/slide/update/{id}', 'SlideController@edit')->name('backend.slide.edit');
        Route::put('/slide/update/{id}', 'SlideController@update')->name('backend.slide.update');
        Route::delete('/slide/delete/{id}', 'SlideController@destroy')->name('backend.slide.destroy');

        // Management
        Route::get('/minislide', 'MinislideController@index')->name('backend.minislide.index');
        Route::get('/minislide/create', 'MinislideController@create')->name('backend.minislide.create');
        Route::post('/minislide', 'MinislideController@store')->name('backend.minislide.store');
        Route::get('/minislide/view/{id}', 'MinislideController@show')->name('backend.minislide.show');
        Route::get('/minislide/update/{id}', 'MinislideController@edit')->name('backend.minislide.edit');
        Route::put('/minislide/update/{id}', 'MinislideController@update')->name('backend.minislide.update');
        Route::delete('/minislide/delete/{id}', 'MinislideController@destroy')->name('backend.minislide.destroy');

        // Management
        Route::get('/lienhe', 'LienheController@index')->name('backend.lienhe.index');
        Route::get('/lienhe/create', 'LienheController@create')->name('backend.lienhe.create');
        Route::post('/lienhe', 'LienheController@store')->name('backend.lienhe.store');
        Route::get('/lienhe/view/{id}', 'LienheController@show')->name('backend.lienhe.show');
        Route::get('/lienhe/update/{id}', 'LienheController@edit')->name('backend.lienhe.edit');
        Route::put('/lienhe/update/{id}', 'LienheController@update')->name('backend.lienhe.update');
        Route::delete('/lienhe/delete/{id}', 'LienheController@destroy')->name('backend.lienhe.destroy');

        // Management
        Route::get('/loaisanpham', 'LoaisanphamController@index')->name('backend.loaisanpham.index');
        Route::get('/loaisanpham/create', 'LoaisanphamController@create')->name('backend.loaisanpham.create');
        Route::post('/loaisanpham', 'LoaisanphamController@store')->name('backend.loaisanpham.store');
        Route::get('/loaisanpham/view/{id}', 'LoaisanphamController@show')->name('backend.loaisanpham.show');
        Route::get('/loaisanpham/update/{id}', 'LoaisanphamController@edit')->name('backend.loaisanpham.edit');
        Route::put('/loaisanpham/update/{id}', 'LoaisanphamController@update')->name('backend.loaisanpham.update');
        Route::delete('/loaisanpham/delete/{id}', 'LoaisanphamController@destroy')->name('backend.loaisanpham.destroy');

        // Management
        Route::get('/sanpham', 'SanphamController@index')->name('backend.sanpham.index');
        Route::get('/sanpham/create', 'SanphamController@create')->name('backend.sanpham.create');
        Route::post('/sanpham', 'SanphamController@store')->name('backend.sanpham.store');
        Route::get('/sanpham/view/{id}', 'SanphamController@show')->name('backend.sanpham.show');
        Route::get('/sanpham/update/{id}', 'SanphamController@edit')->name('backend.sanpham.edit');
        Route::put('/sanpham/update/{id}', 'SanphamController@update')->name('backend.sanpham.update');
        Route::delete('/sanpham/delete/{id}', 'SanphamController@destroy')->name('backend.sanpham.destroy');

        // Management
        Route::get('/tintuc', 'TintucController@index')->name('backend.tintuc.index');
        Route::get('/tintuc/create', 'TintucController@create')->name('backend.tintuc.create');
        Route::post('/tintuc', 'TintucController@store')->name('backend.tintuc.store');
        Route::get('/tintuc/view/{id}', 'TintucController@show')->name('backend.tintuc.show');
        Route::get('/tintuc/update/{id}', 'TintucController@edit')->name('backend.tintuc.edit');
        Route::put('/tintuc/update/{id}', 'TintucController@update')->name('backend.tintuc.update');
        Route::delete('/tintuc/delete/{id}', 'TintucController@destroy')->name('backend.tintuc.destroy');

        // Management
        Route::get('/noithat', 'NoithatController@index')->name('backend.noithat.index');
        Route::get('/noithat/create', 'NoithatController@create')->name('backend.noithat.create');
        Route::post('/noithat', 'NoithatController@store')->name('backend.noithat.store');
        Route::get('/noithat/view/{id}', 'NoithatController@show')->name('backend.noithat.show');
        Route::get('/noithat/update/{id}', 'NoithatController@edit')->name('backend.noithat.edit');
        Route::put('/noithat/update/{id}', 'NoithatController@update')->name('backend.noithat.update');
        Route::delete('/noithat/delete/{id}', 'NoithatController@destroy')->name('backend.noithat.destroy');

        // Management
        Route::get('/section/{position}', 'SectionController@index')->name('backend.section.index');
        Route::get('/section/create/{position}', 'SectionController@create')->name('backend.section.create');
        Route::post('/section/{position}', 'SectionController@store')->name('backend.section.store');
        Route::get('/section/view/{position}/{id}', 'SectionController@show')->name('backend.section.show');
        Route::get('/section/update/{position}/{id}', 'SectionController@edit')->name('backend.section.edit');
        Route::put('/section/update/{position}/{id}', 'SectionController@update')->name('backend.section.update');
        Route::delete('/section/delete/{id}', 'SectionController@destroy')->name('backend.section.destroy');

        // Management
        Route::get('/thongtin', 'UserController@getThongtin')->name('backend.thongtin.edit');
        Route::post('/thongtin', 'UserController@postThongtin')->name('backend.thongtin.update');

        // Management
        Route::get('/gioithieu', 'UserController@getGioithieu')->name('backend.gioithieu.edit');
        Route::post('/gioithieu', 'UserController@postGioithieu')->name('backend.gioithieu.update');

        // Management
        Route::get('/thanhpho', 'ThanhphoController@index')->name('backend.thanhpho.index');
        Route::get('/thanhpho/create', 'ThanhphoController@create')->name('backend.thanhpho.create');
        Route::post('/thanhpho', 'ThanhphoController@store')->name('backend.thanhpho.store');
        Route::get('/thanhpho/view/{id}', 'ThanhphoController@show')->name('backend.thanhpho.show');
        Route::get('/thanhpho/update/{id}', 'ThanhphoController@edit')->name('backend.thanhpho.edit');
        Route::put('/thanhpho/update/{id}', 'ThanhphoController@update')->name('backend.thanhpho.update');
        Route::delete('/thanhpho/delete/{id}', 'ThanhphoController@destroy')->name('backend.thanhpho.destroy');

        // Management
        Route::get('/quan', 'QuanController@index')->name('backend.quan.index');
        Route::get('/quan/create', 'QuanController@create')->name('backend.quan.create');
        Route::post('/quan', 'QuanController@store')->name('backend.quan.store');
        Route::get('/quan/view/{id}', 'QuanController@show')->name('backend.quan.show');
        Route::get('/quan/update/{id}', 'QuanController@edit')->name('backend.quan.edit');
        Route::put('/quan/update/{id}', 'QuanController@update')->name('backend.quan.update');
        Route::delete('/quan/delete/{id}', 'QuanController@destroy')->name('backend.quan.destroy');

        // Management
        Route::get('/theloai', 'TheloaiController@index')->name('backend.theloai.index');
        Route::get('/theloai/create', 'TheloaiController@create')->name('backend.theloai.create');
        Route::post('/theloai', 'TheloaiController@store')->name('backend.theloai.store');
        Route::get('/theloai/view/{id}', 'TheloaiController@show')->name('backend.theloai.show');
        Route::get('/theloai/update/{id}', 'TheloaiController@edit')->name('backend.theloai.edit');
        Route::put('/theloai/update/{id}', 'TheloaiController@update')->name('backend.theloai.update');
        Route::delete('/theloai/delete/{id}', 'TheloaiController@destroy')->name('backend.theloai.destroy');

        // Management
        Route::get('/menu', 'MenuController@index')->name('backend.menu.index');
        Route::get('/menu/create', 'MenuController@create')->name('backend.menu.create');
        Route::post('/menu', 'MenuController@store')->name('backend.menu.store');
        Route::get('/menu/view/{id}', 'MenuController@show')->name('backend.menu.show');
        Route::get('/menu/update/{id}', 'MenuController@edit')->name('backend.menu.edit');
        Route::put('/menu/update/{id}', 'MenuController@update')->name('backend.menu.update');
        Route::delete('/menu/delete/{id}', 'MenuController@destroy')->name('backend.menu.destroy');

        // Management
        Route::get('/gioithieu', 'GioithieuController@index')->name('backend.gioithieu.index');
        Route::get('/gioithieu/create', 'GioithieuController@create')->name('backend.gioithieu.create');
        Route::post('/gioithieu', 'GioithieuController@store')->name('backend.gioithieu.store');
        Route::get('/gioithieu/view/{id}', 'GioithieuController@show')->name('backend.gioithieu.show');
        Route::get('/gioithieu/update/{id}', 'GioithieuController@edit')->name('backend.gioithieu.edit');
        Route::put('/gioithieu/update/{id}', 'GioithieuController@update')->name('backend.gioithieu.update');
        Route::delete('/gioithieu/delete/{id}', 'GioithieuController@destroy')->name('backend.gioithieu.destroy');

        // Management
        Route::get('/video', 'VideoController@index')->name('backend.video.index');
        Route::get('/video/create', 'VideoController@create')->name('backend.video.create');
        Route::post('/video', 'VideoController@store')->name('backend.video.store');
        Route::get('/video/view/{id}', 'VideoController@show')->name('backend.video.show');
        Route::get('/video/update/{id}', 'VideoController@edit')->name('backend.video.edit');
        Route::put('/video/update/{id}', 'VideoController@update')->name('backend.video.update');
        Route::delete('/video/delete/{id}', 'VideoController@destroy')->name('backend.video.destroy');

        // Management
        Route::get('/bietthu', 'BietthuController@index')->name('backend.bietthu.index');
        Route::get('/bietthu/create', 'BietthuController@create')->name('backend.bietthu.create');
        Route::post('/bietthu', 'BietthuController@store')->name('backend.bietthu.store');
        Route::get('/bietthu/view/{id}', 'BietthuController@show')->name('backend.bietthu.show');
        Route::get('/bietthu/update/{id}', 'BietthuController@edit')->name('backend.bietthu.edit');
        Route::put('/bietthu/update/{id}', 'BietthuController@update')->name('backend.bietthu.update');
        Route::delete('/bietthu/delete/{id}', 'BietthuController@destroy')->name('backend.bietthu.destroy');

    });
});
