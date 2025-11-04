<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('top');

Route::get('/forget_password', [App\Http\Controllers\Auth\UserController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forget_password', [App\Http\Controllers\Auth\UserController::class, 'forgetPassword'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\UserController::class, 'resetPassword'])->name('password.update');
Route::get('news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('news/show/{news_id}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

Route::get('/privacy_policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms_of_service', [App\Http\Controllers\HomeController::class, 'terms_of_service'])->name('terms_of_service');
Route::middleware(['user', 'verified'])->group(function () {
    Route::get('/inquiry', [App\Http\Controllers\HomeController::class, 'inquiry'])->name('inquiry');
    Route::post('/inquiry_post', [App\Http\Controllers\HomeController::class, 'inquiry_post'])->name('inquiry_post');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\UserController::class, 'login'])->name('login_post');
    Route::post('/logout', [App\Http\Controllers\Auth\UserController::class, 'logout'])->name('logout');
    Route::get('/retire', [App\Http\Controllers\Auth\UserController::class, 'retire'])->name('retire');
    Route::post('/retire_post', [App\Http\Controllers\Auth\UserController::class, 'retire_post'])->name('retire_post');
    Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
    Route::get('/verify', [App\Http\Controllers\HomeController::class, 'showVerifyCodeForm'])->name('verify_code');
    Route::post('/verify_post', [App\Http\Controllers\HomeController::class, 'verifyAuthCode'])->name('verify_code_post');
    Route::post('/register_post', [App\Http\Controllers\HomeController::class, 'register_post'])->name('register_post');
    Route::get('/register/edit/{id}', [App\Http\Controllers\Auth\UserController::class, 'register_edit'])->name('register_edit');
    Route::put('/register/update/{id}', [App\Http\Controllers\Auth\UserController::class, 'register_update'])->name('register_update');
    Route::get('/question_box/index', [App\Http\Controllers\User\QuestionBoxController::class, 'index'])->name('question_box.index');
    Route::get('/question_box/{question_id}', [App\Http\Controllers\User\QuestionBoxController::class, 'show'])->name('question_box.show');
    Route::get('/article/index', [App\Http\Controllers\User\ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/show/{article_id}', [App\Http\Controllers\User\ArticleController::class, 'show'])->name('article.show');
    Route::get('/article/instructions', [App\Http\Controllers\User\ArticleController::class, 'instructions'])->name('article.instructions');
    Route::get('/profile/{user_id}', [App\Http\Controllers\HomeController::class, 'showUserProfile'])->name('profile');

    Route::middleware(['user', 'verified'])->group(function () {
        Route::get('/my_page', [App\Http\Controllers\User\MyPageController::class, 'index'])->name('my_page');
        Route::post('/question_box/store', [App\Http\Controllers\User\QuestionBoxController::class, 'store'])->name('question_box.store');
        Route::put('/question_box/update/{question_id}', [App\Http\Controllers\User\QuestionBoxController::class, 'update'])->name('question_box.update');
        Route::delete('/question/{question_id}', [App\Http\Controllers\User\QuestionBoxController::class, 'delete'])->name('question_box.delete');
        Route::post('/question_box/answer/{question_id}', [App\Http\Controllers\User\QuestionBoxController::class, 'answer'])->name('question_box.answer');
        Route::get('/question_box/answer/{question_id}/edit', [App\Http\Controllers\User\QuestionBoxController::class, 'answer_edit'])->name('answer.edit');
        Route::put('/question_box/answer/{answer_id}/update', [App\Http\Controllers\User\QuestionBoxController::class, 'answer_update'])->name('answer.update');
        Route::delete('/question_box/answer/{answer_id}/delete', [App\Http\Controllers\User\QuestionBoxController::class, 'answer_delete'])->name('answer.delete');
        Route::get('/article/create', [App\Http\Controllers\User\ArticleController::class, 'create'])->name('article.create');
        Route::post('/article/store', [App\Http\Controllers\User\ArticleController::class, 'store'])->name('article.store');
        Route::get('/article/edit/{article_id}', [App\Http\Controllers\User\ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/article/update/{article_id}', [App\Http\Controllers\User\ArticleController::class, 'update'])->name('article.update');
        Route::delete('/article/delete/{article_id}', [App\Http\Controllers\User\ArticleController::class, 'delete'])->name('article.delete');
        Route::post('/article/uploadImage', [App\Http\Controllers\User\ArticleController::class, 'uploadImage'])->name('article.uploadImage');
        Route::post('/article/uploadImageByUrl', [App\Http\Controllers\User\ArticleController::class, 'uploadImageByUrl'])->name('article.uploadImageByUrl');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\AdminController::class, 'login'])->name('login_post');
    Route::post('/logout', [App\Http\Controllers\Auth\AdminController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
            Route::get('/show/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
            Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
            Route::get('/edit/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
            Route::put('/update/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
            Route::delete('/delete/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('delete');
        });
        Route::prefix('question')->name('question.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\QuestionBoxController::class, 'index'])->name('index');
            Route::get('/show/{question_id}', [App\Http\Controllers\Admin\QuestionBoxController::class, 'show'])->name('show');
            Route::get('/edit/{question_id}', [App\Http\Controllers\Admin\QuestionBoxController::class, 'edit'])->name('edit');
            Route::put('/update/{question_id}', [App\Http\Controllers\Admin\QuestionBoxController::class, 'update'])->name('update');
            Route::delete('/delete/{question_id}', [App\Http\Controllers\Admin\QuestionBoxController::class, 'delete'])->name('delete');
            Route::get('/bot/index/{question_id}', [App\Http\Controllers\Admin\ClaudeController::class, 'index'])->name('bot_index');
            Route::post('/bot/{question_id}', [App\Http\Controllers\Admin\ClaudeController::class, 'bot'])->name('bot');
            Route::post('/bot_register', [App\Http\Controllers\Admin\ClaudeController::class, 'bot_register'])->name('bot_register');
        });
        Route::prefix('answer')->name('answer.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\AnswerController::class, 'index'])->name('index');
            Route::get('/show/{answer_id}', [App\Http\Controllers\Admin\AnswerController::class, 'show'])->name('show');
            Route::get('/edit/{answer_id}', [App\Http\Controllers\Admin\AnswerController::class, 'edit'])->name('edit');
            Route::put('/update/{answer_id}', [App\Http\Controllers\Admin\AnswerController::class, 'update'])->name('update');
            Route::delete('/delete/{answer_id}', [App\Http\Controllers\Admin\AnswerController::class, 'delete'])->name('delete');
        });
        Route::prefix('news')->name('news.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('index');
            Route::get('/show/{news_id}', [App\Http\Controllers\Admin\NewsController::class, 'show'])->name('show');
            Route::get('/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('store');
            Route::get('/edit/{news_id}', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('edit');
            Route::put('/update/{news_id}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('update');
            Route::delete('/delete/{news_id}', [App\Http\Controllers\Admin\NewsController::class, 'delete'])->name('delete');
        });

        Route::prefix('inquiry')->name('inquiry.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('index');
            Route::get('/show/{inquiry_id}', [App\Http\Controllers\Admin\InquiryController::class, 'show'])->name('show');
            Route::delete('/delete/{inquiry_id}', [App\Http\Controllers\Admin\InquiryController::class, 'delete'])->name('delete');
        });

        Route::prefix('article')->name('article.')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('index');
            Route::get('/show/{article_id}', [App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('show');
            Route::delete('/delete/{article_id}', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('delete');
        });
    });
});
