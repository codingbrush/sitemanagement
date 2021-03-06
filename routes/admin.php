<?php


    // Login and Logout
    Route::GET('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::POST('/', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('admin.logout');

    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::GET('/password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');
    Route::POST('/password/change', 'AdminController@changePassword');

    // Register Admins
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/{admin}/edit', 'RegisterController@edit')->name('admin.edit');
    Route::delete('/{admin}', 'RegisterController@destroy')->name('admin.delete');
    Route::patch('/{admin}', 'RegisterController@update')->name('admin.update');

    // Admin Lists
    Route::get('/show', 'AdminController@show')->name('admin.show');
    Route::get('/me', 'AdminController@me')->name('admin.me');

    // Admin Roles
    Route::post('/{admin}/role/{role}', 'AdminRoleController@attach')->name('admin.attach.roles');
    Route::delete('/{admin}/role/{role}', 'AdminRoleController@detach');

    // Roles
    Route::get('/roles', 'RoleController@index')->name('admin.roles');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
    Route::delete('/role/{role}', 'RoleController@destroy')->name('admin.role.delete');
    Route::get('/role/{role}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::patch('/role/{role}', 'RoleController@update')->name('admin.role.update');

    // active status
    Route::post('activation/{admin}', 'ActivationController@activate')->name('admin.activation');
    Route::delete('activation/{admin}', 'ActivationController@deactivate');
    Route::resource('permission', 'PermissionController');


Route::group(['namespace' => '\App\Http\Controllers','middleware'=> 'admin'], function()
{
    Route::GET('/home', 'AdminController@index')->name('admin.home');
    Route::get('/customer', 'CustomerController@index')->name('customer.index');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
    Route::get('/customer/edit/{id}','CustomerController@edit')->name('customer.edit');
    Route::get('/customer/show/{id}','CustomerController@show')->name('customer.show');
    Route::post('/customer', 'CustomerController@store')->name('customer.store');
    Route::put('/customer/{id}/update','CustomerController@update')->name('customer.update');
//Route::delete('/customer/{id}','CustomerController@destroy')->name('customer.delete');

    Route::get('/payment/{id}','PaymentController@index')->name('payment.index');
    Route::get('getDetails/{id}','PaymentController@getDetails')->name('payment.details');
    Route::post('/payment','PaymentController@store')->name('payment.store');
});




    Route::fallback(function () {
        return abort(404);
    });
