<?php

use App\Models\Disease;


use BigV\ImageCompare;

require __DIR__ . "/../vendor/autoload.php";

Route::get('/', function () {

    $diseases = Disease::all();
    $disease = Disease::find(1);

    foreach($disease->images as $key => $media){
        $image = new ImageCompare();
        echo $image->compare($media->getUrl('thumb'),$media->getUrl('thumb'));        
    }

    return view('welcome',compact('diseases'));
});

// Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Diseases
    Route::delete('diseases/destroy', 'DiseasesController@massDestroy')->name('diseases.massDestroy');
    Route::post('diseases/media', 'DiseasesController@storeMedia')->name('diseases.storeMedia');
    Route::post('diseases/ckmedia', 'DiseasesController@storeCKEditorImages')->name('diseases.storeCKEditorImages');
    Route::resource('diseases', 'DiseasesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
