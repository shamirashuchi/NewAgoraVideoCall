<?php

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Category;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\Tag;

Route::group(['namespace' => 'Botble\JobBoard\Http\Controllers\Fronts', 'middleware' => ['web', 'core']], function () {
    Route::post('jobs/apply/{id?}', [
        'as' => 'public.job.apply',
        'uses' => 'PublicController@postApplyJob',
    ]);

    Route::get('currency/switch/{code?}', [
        'as' => 'public.change-currency',
        'uses' => 'PublicController@changeCurrency',
    ]);

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('ajax/jobs', [
            'as' => 'public.ajax.jobs',
            'uses' => 'PublicController@getJobs',
        ]);

        Route::get('ajax/candidates', [
            'as' => 'public.ajax.candidates',
            'uses' => 'PublicController@getCandidates',
        ]);

        Route::get('ajax/companies', [
            'as' => 'public.ajax.companies',
            'uses' => 'PublicController@getCompanies',
        ]);

        Route::get(SlugHelper::getPrefix(Job::class, 'jobs') . '/{slug}', [
            'as' => 'public.job',
            'uses' => 'PublicController@getJob',
        ]);

        Route::get(SlugHelper::getPrefix(Category::class, 'job-categories') . '/{slug}', [
            'as' => 'public.job-category',
            'uses' => 'PublicController@getJobCategory',
        ]);

        Route::get(SlugHelper::getPrefix(Tag::class, 'job-tags') . '/{slug}', [
            'as' => 'public.job-tag',
            'uses' => 'PublicController@getJobTag',
        ]);

        Route::get(SlugHelper::getPrefix(Company::class, 'companies') . '/{slug}', [
            'as' => 'public.company',
            'uses' => 'PublicController@getCompany',
        ]);

        Route::get(SlugHelper::getPrefix(Account::class, 'candidates') . '/{slug}', [
            'as' => 'public.candidate',
            'uses' => 'PublicController@getCandidate',
        ]);
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::post('checkout', 'CheckoutController@postCheckout')->name('payments.checkout');
    });
});

Route::group([
    'namespace' => 'Botble\LanguageAdvanced\Http\Controllers',
    'middleware' => ['web', 'core'],
], function () {
    Route::group([
        'prefix' => 'account',
        'as' => 'public.account.',
        'middleware' => ['account'],
    ], function () {
        Route::post('language-advanced/save/{id}', [
            'as' => 'language-advanced.save',
            'uses' => 'LanguageAdvancedController@save',
        ]);
    });
});
