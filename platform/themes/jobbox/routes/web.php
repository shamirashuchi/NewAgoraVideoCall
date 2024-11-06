<?php

// Custom routes
Route::group(['namespace' => 'Theme\Jobbox\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::group(['as' => 'public.'], function () {
            Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
                Route::controller('JobboxController')->group(function () {
                    Route::get('testimonials', [
                        'as' => 'testimonials',
                        'uses' => 'ajaxGetTestimonials',
                    ]);

                    Route::get('categories', [
                        'as' => 'categories',
                        'uses' => 'ajaxGetJobCategories',
                    ]);

                    Route::get('jobs-by-category/{category_id}', [
                        'as' => 'jobs-by-category',
                        'uses' => 'ajaxGetJobByCategories',
                    ]);
                });
            });
        });

        Route::group(['as' => 'public.'], function () {
            Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
                Route::get('cities', 'JobboxController@ajaxGetCities')->name('cities');
            });
        });
    });
});

Theme::routes();
