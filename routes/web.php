<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransactionController;

// WELCOME VIEW 
    Route::get('/', function () {
        return view('welcome');
    });

//BUSINESS ROUTES BY PAGES---------

    Route::get('/business', [BusinessController::class, 'businessdashboard'])
        ->middleware(['auth', 'verified', 'rolemanager:business'])
        ->name('business');

    Route::get('/business/create', [SurveyController::class, 'create'])
        ->middleware(['auth', 'verified', 'rolemanager:business'])
        ->name('business.create-survey');

    Route::post('business/create', [SurveyController::class, 'store'])->name('survey.store');

    Route::get('/business/viewsurvey', [BusinessController::class, 'viewsurvey'])
        ->middleware(['auth', 'verified', 'rolemanager:business'])
        ->name('business.viewsurvey');

    Route::get('/business/viewsurvey/{id}', [BusinessController::class, 'viewsurveydetail'])
    ->middleware(['auth', 'verified', 'rolemanager:business']) // Add rolemanager:admin middleware here
    ->name('business.view-survey-detail');


    Route::get('/business/analytics', [BusinessController::class, 'analytics'])
    ->middleware(['auth', 'verified', 'rolemanager:business'])
    ->name('business.view-analytics');

    Route::get('/business/deposit', function () {
        return view('business.deposit');
        })->middleware(['auth', 'verified', 'rolemanager:business'])
        ->name('business.deposit');



    Route::post('/business/deposit', [TransactionController::class, 'createDeposit'])
    ->middleware(['auth', 'verified', 'rolemanager:business'])
    ->name('business.deposit'); 

    Route::get('/business/deposithistory', [TransactionController::class, 'deposithistory'])
    ->middleware(['auth', 'verified', 'rolemanager:business'])
    ->name('business.deposithistory'); // 


    Route::get('/business/ticket', function () {
        return view('business.ticket'); // Adjust the view name as necessary
    })->middleware(['auth', 'verified', 'rolemanager:business'])
     ->name('business.ticket');
    

    Route::post('/business/ticket', [SurveyController::class, 'createticket'])
    ->middleware(['auth', 'verified', 'rolemanager:business'])
    ->name('business.ticket');


    Route::get('/business/tickethistory', [SurveyController::class, 'tickethistory'])
        ->middleware(['auth', 'verified', 'rolemanager:business'])
        ->name('business.tickethistory');




    
    Route::delete('/surveys/{id}', [BusinessController::class, 'destroy'])
        ->middleware(['auth', 'verified', 'rolemanager:business']) // Adjust as needed
        ->name('surveys.destroy');

//USER ROUTES BY PAGE

    Route::get('/user', [SurveyController::class, 'userviewsurvey']) // Pointing to the index method in SurveyController
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('dashboard');

    Route::get('/user/settings', [SurveyController::class, 'usersettings']) // Pointing to the index method in SurveyController
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('usersettings');


    Route::post('/user/save-profile', [SurveyController::class, 'saveProfile'])
        ->middleware(['auth', 'verified', 'rolemanager:user'])
        ->name('saveProfile');

    Route::get('/user/add-profile', [SurveyController::class, 'showAddProfilePage'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('addProfilePage');

    Route::get('/user/surveys', [SurveyController::class, 'showallsurveys']) // Pointing to the index method in SurveyController
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('user.showallsurveys');
    
    Route::get('/survey/{id}', [SurveyController::class, 'show'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('survey.show');

    Route::post('/survey/{id}/submit', [SurveyController::class, 'submitAnswers'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('survey.submit');


    Route::get('/user/withdraw', [TransactionController::class, 'showWithdrawForm'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('user.withdraw'); // To handle the deposit form submission
    
    Route::post('/withdraw', [TransactionController::class, 'processWithdraw'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('user.withdraw.submit');

    Route::get('/user/withdrawhistory', [TransactionController::class, 'withdrawhistory'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('user.withdrawhisoty'); // To handle the deposit form submission

    Route::get('/user/ticket', function () {
        return view('user.ticket'); // Adjust the view name as necessary
    })->middleware(['auth', 'verified', 'rolemanager:user'])
     ->name('user.ticket');
    

     
    Route::post('/user/ticket', [SurveyController::class, 'usercreateticket'])
    ->middleware(['auth', 'verified', 'rolemanager:user'])
    ->name('user.ticket');


    Route::get('/user/tickethistory', [SurveyController::class, 'usertickethistory'])
        ->middleware(['auth', 'verified', 'rolemanager:user'])
        ->name('user.usertickethistory');

    

    Route::get('/admin', function () {
        return view('admin');
    })->middleware(['auth', 'verified','rolemanager:admin'])->name('admin');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // routes/web.php
    Route::middleware(['auth'])->group(function () {
        Route::get('/protect', [DashboardController::class, 'protectedMethod'])->name('protect');
    });





//view surveys from user side

    Route::get('/surveys/{id}/responses', [SurveyController::class, 'showsingle'])->name('survey.showsingle');
    



require __DIR__.'/auth.php';