<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServicePartController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\WORequestController;
use App\Http\Controllers\EstimationController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WOTypeController;
use App\Http\Controllers\InvoiceController;


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

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->middleware(
    [

        'XSS',
    ]
);
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware(
    [

        'XSS',
    ]
);
Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware(
    [

        'XSS',
    ]
);

//-------------------------------User-------------------------------------------

Route::resource('users', UserController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Subscription-------------------------------------------


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {

    Route::resource('subscriptions', SubscriptionController::class);
    Route::get('coupons/history', [CouponController::class, 'history'])->name('coupons.history');
    Route::delete('coupons/history/{id}/destroy', [CouponController::class, 'historyDestroy'])->name('coupons.history.destroy');
    Route::get('coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');
    Route::resource('coupons', CouponController::class);
    Route::get('subscription/transaction', [SubscriptionController::class, 'transaction'])->name('subscription.transaction');
}
);

//-------------------------------Subscription Payment-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {

    Route::post('subscription/{id}/stripe/payment', [SubscriptionController::class, 'stripePayment'])->name('subscription.stripe.payment');
}
);
//-------------------------------Settings-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::get('settings/account', [SettingController::class, 'account'])->name('setting.account');
    Route::post('settings/account', [SettingController::class, 'accountData'])->name('setting.account');
    Route::delete('settings/account/delete', [SettingController::class, 'accountDelete'])->name('setting.account.delete');

    Route::get('settings/password', [SettingController::class, 'password'])->name('setting.password');
    Route::post('settings/password', [SettingController::class, 'passwordData'])->name('setting.password');

    Route::get('settings/general', [SettingController::class, 'general'])->name('setting.general');
    Route::post('settings/general', [SettingController::class, 'generalData'])->name('setting.general');

    Route::get('settings/smtp', [SettingController::class, 'smtp'])->name('setting.smtp');
    Route::post('settings/smtp', [SettingController::class, 'smtpData'])->name('setting.smtp');

    Route::get('settings/payment', [SettingController::class, 'payment'])->name('setting.payment');
    Route::post('settings/payment', [SettingController::class, 'paymentData'])->name('setting.payment');

    Route::get('settings/company', [SettingController::class, 'company'])->name('setting.company');
    Route::post('settings/company', [SettingController::class, 'companyData'])->name('setting.company');

    Route::get('language/{lang}', [SettingController::class, 'lanquageChange'])->name('language.change');
    Route::post('theme/settings', [SettingController::class, 'themeSettings'])->name('theme.settings');

    Route::get('settings/site-seo', [SettingController::class, 'siteSEO'])->name('setting.site.seo');
    Route::post('settings/site-seo', [SettingController::class, 'siteSEOData'])->name('setting.site.seo');

    Route::get('settings/google-recaptcha', [SettingController::class, 'googleRecaptcha'])->name('setting.google.recaptcha');
    Route::post('settings/google-recaptcha', [SettingController::class, 'googleRecaptchaData'])->name('setting.google.recaptcha');
}
);


//-------------------------------Role & Permissions-------------------------------------------
Route::resource('permission', PermissionController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('role', RoleController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Note-------------------------------------------
Route::resource('note', NoticeBoardController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Contact-------------------------------------------
Route::resource('contact', ContactController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------logged History-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {

    Route::get('logged/history', [UserController::class, 'loggedHistory'])->name('logged.history');
    Route::get('logged/{id}/history/show', [UserController::class, 'loggedHistoryShow'])->name('logged.history.show');
    Route::delete('logged/{id}/history', [UserController::class, 'loggedHistoryDestroy'])->name('logged.history.destroy');
});


//-------------------------------Plan Payment-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::post('subscription/{id}/bank-transfer', [PaymentController::class, 'subscriptionBankTransfer'])->name('subscription.bank.transfer');
    Route::get('subscription/{id}/bank-transfer/action/{status}', [PaymentController::class, 'subscriptionBankTransferAction'])->name('subscription.bank.transfer.action');
    Route::post('subscription/{id}/paypal', [PaymentController::class, 'subscriptionPaypal'])->name('subscription.paypal');
    Route::get('subscription/{id}/paypal/{status}', [PaymentController::class, 'subscriptionPaypalStatus'])->name('subscription.paypal.status');
}
);

//-------------------------------Client-------------------------------------------
Route::resource('client', ClientController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Services & Parts-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::delete('services/tasks', [ServicePartController::class, 'taskDestroy'])->name('service.task.destroy');
    Route::resource('services-parts', ServicePartController::class);
}
);

//-------------------------------Asset-------------------------------------------
Route::resource('asset', AssetController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
//-------------------------------WO Request-------------------------------------------
Route::resource('wo-request', WORequestController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
//-------------------------------Estimation-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {

    Route::get('estimation/{id}/status', [EstimationController::class,'estimationStatus'])->name('estimation.status');
    Route::delete('estimation/service/part/destroy', [EstimationController::class,'servicePartDestroy'])->name('estimation.service.part.destroy');
    Route::get('estimation/service/part', [EstimationController::class, 'getServicePart'])->name('estimation.service.part');
    Route::resource('estimation', EstimationController::class);
}
);


//-------------------------------Work Order-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::get('workorder/{id}/service/task/create', [WorkOrderController::class,'serviceTaskCreate'])->name('workorder.service.task.create');
    Route::post('workorder/{id}/service/task/store', [WorkOrderController::class,'serviceTaskStore'])->name('workorder.service.task.store');
    Route::get('workorder/{id}/service/task/{tid}/edit', [WorkOrderController::class,'serviceTaskEdit'])->name('workorder.service.task.edit');
    Route::put('workorder/{id}/service/task/{tid}/update', [WorkOrderController::class,'serviceTaskUpdate'])->name('workorder.service.task.update');
    Route::delete('workorder/{id}/service/task/{tid}/delete', [WorkOrderController::class,'serviceTaskDestroy'])->name('workorder.service.task.destroy');

    Route::get('workorder/{id}/service/appointment', [WorkOrderController::class,'serviceAppointment'])->name('workorder.service.appointment');
    Route::put('workorder/{id}/service/appointment/store', [WorkOrderController::class,'serviceAppointmentStore'])->name('workorder.service.appointment.store');
    Route::delete('workorder/{id}/service/appointment/delete', [WorkOrderController::class,'serviceAppointmentDestroy'])->name('workorder.service.appointment.destroy');

    Route::get('workorder/{id}/status', [WorkOrderController::class,'workorderStatus'])->name('workorder.status');
    Route::delete('workorder/service/part/destroy', [WorkOrderController::class,'servicePartDestroy'])->name('workorder.service.part.destroy');
    Route::get('workorder/service/part', [WorkOrderController::class, 'getServicePart'])->name('workorder.service.part');
    Route::resource('workorder', WorkOrderController::class);
}
);


//-------------------------------WO Type-------------------------------------------
Route::resource('wo-type', WOTypeController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Invoice-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::get('client/workorder/list', [InvoiceController::class,'getWorkorder'])->name('client.workorder');
    Route::get('workorders/details', [InvoiceController::class,'getWorkorderDetails'])->name('workorder.details');
    Route::resource('invoice', InvoiceController::class);
}
);


