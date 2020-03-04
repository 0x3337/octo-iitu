<?php

use IITU\Core\Classes\Translator;

App::before(function($request) {
    if (App::runningInBackend()) {
        return;
    }

    $translator = Translator::instance();

    if (
        !$translator->loadLocaleFromRequest() ||
        (!$locale_code = $translator->getLocale()) ||
        $locale_code === $translator->getDefaultLocale()
    ) {
        return;
    }

    /*
     * Register routes
     */
    Route::group(['prefix' => $locale_code, 'middleware' => 'web'], function() {
        Route::any('{slug}', 'Cms\Classes\CmsController@run')->where('slug', '(.*)?');
    });
    Route::any($locale_code, 'Cms\Classes\CmsController@run')->middleware('web');

    /*
     * Ensure Url::action() retains the localized URL
     * by re-registering the route after the CMS.
     */
    Event::listen('cms.route', function() use ($locale_code) {
        Route::group(['prefix' => $locale_code, 'middleware' => 'web'], function() {
            Route::any('{slug}', 'Cms\Classes\CmsController@run')->where('slug', '(.*)?');
        });
    });
});