<?php

use App\Repositories\VideoParse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

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

Route::get('test', function (){
    // dd(VideoParse::mergeChunkVideos(12));
});

Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    dd('Cache Clear.');
});

Route::group(['namespace' => 'Auth'], function() {

    Route::get('admin/password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

    Route::post('admin/password/reset', 'AdminResetPasswordController@reset');

    Route::get('admin/password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('register', 'RegisterController@register')->name('register');
});

Route::group(['namespace' => 'frontend'], function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('command', 'HomeController@command')->name('command');
    Route::get('/home', function () {
        return redirect('/');
    });
    
    Route::get('social/{provider}', 'SocialLoginController@redirectToProvider')->name('social');
    Route::get('social/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('social.callback');
    
    Route::get('about-us', 'AboutUsController@index')->name('about-us');
    Route::get('contact-us', 'ContactUsController@index')->name('contact-us');
    Route::post('contact-us', 'ContactUsController@store');
    Route::get('faqs', 'FaqController@index')->name('faqs');

    Route::resource('blogs', 'BlogController')->only(['index', 'show']);
    
    Route::get('create-your-story/step-1', 'CreateStoryController@step1')->name('create-your-story.step-1');
    Route::post('create-your-story/step-1', 'CreateStoryController@step1Store');
    Route::get('create-your-story/step-2', 'CreateStoryController@step2')->name('create-your-story.step-2');
    Route::post('create-your-story/step-2', 'CreateStoryController@step2Store');
    Route::get('create-your-story/step-3', 'CreateStoryController@step3')->name('create-your-story.step-3');
    Route::post('create-your-story/step-3', 'CreateStoryController@step3Store');


    Route::middleware(['auth'])->group(function () {
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile/update', 'ProfileController@updateProfile')->name('profile.update');
        Route::get('create-your-story/step-4', 'CreateStoryController@step4')->name('create-your-story.step-4');
        Route::post('upload/video', 'VideoRecordingController@store')->name('video.store');
        Route::get('create-your-story/step-4/{id}', 'CreateStoryController@step4Preview')->name('create-your-story.step-4.show');
        Route::get('create-your-story/step-5', 'CreateStoryController@step5')->name('create-your-story.step-5');

        Route::get('story/payment','PaymentController@pay')->name('story.pay');
        Route::post('store.payment-process','PaymentController@handlePayment')->name('store.payment-process');

        Route::get('family-trees', 'FamilyTreeController@index')->name('family-trees');
        Route::post('family-trees', 'FamilyTreeController@store')->name('family-trees.store');

        Route::get('view-story', "ProfileController@previewStory")->name('view-story');
    });
});

/*
 * All backend functionality route
 */
Route::group(['namespace' => 'backend'], function() {
    /*
     * Admin user Route
     */
    Route::prefix('admin')->group(function() {
        Route::get('login', 'AdminLoginController@showLogin')->name('admin.login');
        Route::post('login', 'AdminLoginController@login')->name('admin.login.submit');

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
            Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');

            Route::get('admins/editPassword', 'AdminController@password')->name('admin.editPassword');
            Route::post('admins/editPassword', 'AdminController@passwordUpdate');
            
            Route::get('admins/resetPassword/{id}', 'AdminController@resetPassword')->name('admin.admins.resetPassword');
            Route::patch('admins/resetPassword/{id}', 'AdminController@resetPasswordStore');
            
            Route::resource('admins', 'AdminController', [
                'as' => 'admin'
            ]);

            Route::resource('blogs', 'BlogController', [
                'as' => 'admin'
            ]);

            Route::resource('categories', 'CategoryController', [
                'as' => 'admin'
            ]);

            Route::resource('faqs', 'FaqController', [
                'as' => 'admin'
            ]);

            Route::resource('questions', 'QuestionController', [
                'as' => 'admin'
            ]);

            Route::resource('warmups', 'WarmupController', [
                'as' => 'admin'
            ]);
            
            Route::resource('settings', 'SettingController', [
                'as' => 'admin'
            ]);

            Route::resource('relations', 'RelationController', [
                'as' => 'admin'
            ]);
            
            Route::patch('users/activate/{id}', 'UserController@activate');
            Route::patch('users/deactivate/{id}', 'UserController@deactivate');

            Route::get('users', 'UserController@index')->name('admin.users.index');

            Route::get('contacts', 'ContactController@index')->name('admin.contacts.index');
        });
    });
});
