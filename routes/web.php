<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('set_language/{lang}', 'Controller@setLanguage')->name('set_language');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){
    Route::get('/','ProfileController@index')->name('profile.index');
    Route::put('/','ProfileController@update')->name('profile.update');
});

Route::group(['prefix' => 'solicitude'], function(){
    Route::post('/teacher', 'SolicitudeController@teacher')->name('solicitude.teacher');
});
Route::group(['prefix' => 'teacher', 'middleware' => ['auth']], function(){
    Route::get('/courses', 'TeacherController@courses')->name('teacher.courses');
    Route::get('/students', 'TeacherController@students')->name('teacher.students');
    Route::post('send_message_to_student', 'TeacherController@sendMessageToStudent')
        ->name('teacher.send_message_to_student');
});


Route::group(['prefix' => 'courses'], function(){
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/subscribed', 'CourseController@subscribed')
            ->name('courses.subscribed');
        Route::get('/{course}/inscribe', 'CourseController@inscribe')
            ->name('courses.inscribe');
        Route::post('/add_review', 'CourseController@addReview')
            ->name('courses.add_review');
        Route::group(['middleware' => [sprintf("role:%s", \App\Role::TEACHER)]], function() {
            Route::resource('courses', 'CourseController')->except(['index', 'show']);
        });
    });

    Route::get('/{course}', 'CourseController@show')
        ->name('courses.detail');
});

Route::group(['middlewate' => ['auth']], function (){


    Route::group(['prefix' => 'subscriptions'],function(){
        Route::get('/plans','SubscriptionController@plans')
            ->name('subscription.plans');
        Route::post('/process_subscription','SubscriptionController@processSubscription')
            ->name('subscriptions.process_subscription');
        Route::get('/admin', 'SubscriptionController@admin')
            ->name('subscription.admin');
        Route::post('/resumen','SubscriptionController@resumen')
            ->name('subscription.resume');
        Route::post('/cancel','SubscriptionController@cancel')
            ->name('subscription.cancel');
    });

    Route::group(['prefix'=> 'invoices'], function (){
        Route::get('/admin', 'InvoiceController@admin')
            ->name('invoices.admin');
        Route::get('/{invoice}/download', 'InvoiceController@downlad')
            ->name('invoices.download');
    });


    Route::namespace('Admin')->group(function(){
        Route::group(['prefix' => 'manage',], function(){


                Route::group(['middleware' => ['auth', sprintf("role:%s", \App\Role::ADMIN)]], function() {

                    Route::get('/students/{user}/edit', 'StudentController@edit')
                        ->name('edit.student');
                    Route::get('/students', 'StudentController@index')
                        ->name('manage.students');
                    Route::put('/students/{user}/update', 'StudentController@update');
                    Route::delete('/students/{user}/destroy', 'StudentController@destroy');

                    Route::get('/courses','CourseController@index')
                        ->name('manage.courses');
                    Route::get('/courses/edit/{slug}', 'CourseController@edit')
                        ->name('admin.courses.edit');
                    Route::put('/courses/update/{slug}', 'CourseController@update')
                        ->name('admin.courses.update');
                    Route::get('/courses/activate/{slug}', 'CourseController@activate')
                        ->name('admin.courses.activate');
                    Route::get('/courses/publish/{slug}', 'CourseController@publish')
                        ->name('admin.courses.publish');
                    Route::get('/courses/cancel/{slug}', 'CourseController@cancel')
                        ->name('admin.courses.cancel');

                    Route::get('/teachers', 'TeacherController@index')
                        ->name('admin.teachers');
                    Route::get('/teachers/{user}/edit', 'TeacherController@edit')
                        ->name('edit.teachers');
                    Route::put('/teachers/{user}/update', 'TeacherController@update');
                    Route::delete('/teachers/{user}/destroy', 'TeacherController@destroy');
            });
        });
    });




});



Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
