<?php

Route::get('test', function(){
    //$x = DB::table('translation')->orderBy('id_num', 'desc')->first()->id_num;
    //dd($x);

    echo trans2("A280");
});

// Auth routes
Route::group(['prefix' => '/', 'namespace' => 'Auth'], function() {
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@getLogout');
	Route::get('register', 'AuthController@getRegister');
	Route::post('register', 'AuthController@postRegister');

	// Socialite auth
	Route::get('socialauth/{provider}', 'SocialAuthController@redirectToProvider');
	Route::get('socialauth/{provider}/callback', 'SocialAuthController@handleProviderCallback');
});

// For ajax rquesting
Route::controller('/requesting/ajax', "ajaxRequestController");

// Localization (langs)
Route::controller('/locale', 'localeController');


/**** BACKEND ****/

	// Super admin & admins routes
	Route::group(['middleware' => 'authenticated:super_admin,admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
		Route::group(['prefix' => 'products', 'namespace' => 'Products'], function(){

			Route::controller('search', 'searchController');

			Route::group(['prefix' => 'categories'], function(){
				Route::post('/get-data-by-method1', 'categoriesController@postGetDataByMethod1');
				Route::post('/refresh-parameters', 'categoriesController@postRefreshParameters');
				Route::resource('/', 'categoriesController', ['parameters' => ['' => 'id']]);
			});

			Route::group(['prefix' => 'image'], function(){
				Route::get('/set-primary', 'imageController@setPrimary');
			});

			Route::group(['prefix' => 'carousel'], function(){
				Route::resource('/', 'carouselController');
				Route::post('/live-status', 'carouselController@liveStatus');
				Route::get('/set-primary', 'carouselController@setPrimary');
			});

			Route::group(['prefix' => 'tags'], function(){
				Route::post('view-by-keyword', 'tagsController@viewByKeyword');
				// APT: admin products tags
				Route::post('view-append-modal', ['as' => 'APT.view-append-modal', 'uses' => 'tagsController@viewAppendModal']);
				Route::resource('/', 'tagsController', ['parameters' => ['' => 'id']]);
			});

			Route::resource('/', 'productsController', ['parameters' => ['' => 'id']]);
			Route::get('create/step/{step_id}', 'productsController@create');
			Route::post('store/step/{step_id}', 'productsController@store')->where('step_id', '[0-9]+');
			Route::post('/live-status', 'productsController@liveStatus');
			Route::post('/is-new-status', 'productsController@isNewStatus');
			Route::post('/create/generate-serial-number', 'productsController@generateUniqueSerialNumber');
		});

		Route::group(['namespace' => 'Clients', 'prefix' => 'clients'], function(){
			Route::resource('admins/accounts', 'normalAdminsController', ['parameters' => ['' => 'id']]);
			Route::resource('users/accounts', 'usersController', ['parameters' => ['' => 'id']]);
		});

		Route::group(['namespace' => 'Cart', 'prefix' => 'review-cart'], function(){
			Route::resource('pending-requests', "pendingRequestsController", ['parameters' => ['' => 'id']]);
            Route::post('pending-requests/accept', "pendingRequestsController@accept");
			Route::post('pending-requests/reject', "pendingRequestsController@reject");
			
			Route::resource('accepting-requests', "acceptingRequestController", ['parameters' => ['' => 'id']]);
			Route::post('accepting-requests/pay', "acceptingRequestController@pay");
		});

        Route::group(['prefix' => 'translations'], function(){
            Route::get('take-backup', 'translationController@takeBackup');
            Route::resource('/', 'translationController', ['parameters' => ['' => 'id']]);
        });

        Route::controller('/super-admin', 'superAdminController', ['parameters' => ['' => 'id']]);
		Route::controller('/', 'mainController', ['parameters' => ['' => 'id']]);
	});

	// Uploads CRUD routes
	Route::group(['namespace' => 'Uploads'], function(){
		Route::group(['prefix' => 'image'], function(){
			Route::post('upload', ['as' => 'image-upload', 'uses' => 'ImageController@upload']);
			Route::post('update', ['as' => 'image-update-modal', 'uses' => 'ImageController@updateModal']);
			Route::post('delete', ['as' => 'image-remove', 'uses' => 'ImageController@delete']);
		});
		Route::group(['prefix' => 'carousel'], function(){
			Route::post('upload', ['as' => 'carousel-upload', 'uses' => 'CarouselController@upload']);
			Route::post('delete', ['as' => 'carousel-remove', 'uses' => 'CarouselController@delete']);
		});
	});

/*****************/


/*** FRONTEND ****/

	Route::group(['namespace' => 'User'], function() {
        Route::controller('/profile', 'profileController'); // User profile routes
        Route::resource('/pay-requests', 'payRequestsController');

        // Products routes
		Route::group(['prefix' => 'products', 'namespace' => 'Products'], function() {
            // reviews routes 
            Route::get('review', 'reviewController@review');

			Route::controller('search', 'searchController');
			Route::get('category/{category_code}/{category_name}', 'searchController@byCategoryName');

			Route::get('/', 'productsController@getAll');
			Route::get('{serial_number}/{name?}', 'productsController@getProductName');
		});
	});

	// Cart routes
	Route::controller('/my-cart', 'User\cartController');

	// Payment routes
	Route::group(['middleware' => 'auth', 'namespace' => 'Payment'], function() {
		Route::controller("/paypal-payment", 'paypalController');
		Route::controller('/on-delivery-payment', 'onDeliveryContoller');
	});

	// Interface user pages
	Route::controller('/', "User\indexController");

/****************/
