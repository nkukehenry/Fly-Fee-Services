<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Factories\Factory;



Route::get('/cron', 'FrontendController@cron')->name('cron');

Route::get('/clear', function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('optimize:clear', array(), $output);
    return $output->fetch();
})->name('/clear');

Route::get('queue-work', function () {
    return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
});
Route::get('schedule-run', function () {
    return Illuminate\Support\Facades\Artisan::call('schedule:run');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['guest']], function () {
    Route::get('register/{sponsor?}', 'Auth\RegisterController@sponsor')->name('register.sponsor');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/check', 'User\VerificationController@check')->name('check');
    Route::get('/resend_code', 'User\VerificationController@resendCode')->name('resendCode');
    Route::post('/mail-verify', 'User\VerificationController@mailVerify')->name('mailVerify');
    Route::post('/sms-verify', 'User\VerificationController@smsVerify')->name('smsVerify');
    Route::post('twoFA-Verify', 'User\VerificationController@twoFAverify')->name('twoFA-Verify');

    Route::middleware('userCheck')->group(function () {

        Route::middleware('kyc')->group(function () {
            Route::get('/dashboard', 'User\HomeController@index')->name('home');

            Route::post('/calculation', 'User\HomeController@calculation')->name('calculation.store');
            Route::get('/send-money/{sendMoney:invoice}/{action}', 'User\HomeController@sendMoneyAction')->name('sendMoney.action');
            Route::get('/send-money/{sendMoney:invoice}', 'User\HomeController@sendMoney')->name('sendMoney');
            Route::post('/send-money/{sendMoney:invoice}', 'User\HomeController@sendMoneyFormData')->name('sendMoney.formData');
            Route::get('/transfer-log', 'User\HomeController@transferLog')->name('transfer-log');

            Route::get('pay-now', 'User\HomeController@addFund')->name('addFund');
            Route::post('pay-now', 'PaymentController@addFundRequest')->name('addFund.request');
            Route::get('pay-confirm', 'PaymentController@depositConfirm')->name('addFund.confirm');
            Route::post('pay-confirm', 'PaymentController@fromSubmit')->name('addFund.fromSubmit');


            //transaction
            Route::get('/transaction', 'User\HomeController@transaction')->name('transaction');
            Route::get('/transaction-search', 'User\HomeController@transactionSearch')->name('transaction.search');
            Route::get('/payment-history', 'User\HomeController@fundHistory')->name('fund-history');
            Route::get('/payment-history/search', 'User\HomeController@fundHistorySearch')->name('fund-history.search');


            // TWO-FACTOR SECURITY
            Route::get('/twostep-security', 'User\HomeController@twoStepSecurity')->name('twostep.security');
            Route::post('twoStep-enable', 'User\HomeController@twoStepEnable')->name('twoStepEnable');
            Route::post('twoStep-disable', 'User\HomeController@twoStepDisable')->name('twoStepDisable');

            Route::get('push-notification-show', 'SiteNotificationController@show')->name('push.notification.show');
            Route::get('push.notification.readAll', 'SiteNotificationController@readAll')->name('push.notification.readAll');
            Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');
            Route::get('push-chat-show/{id}', 'ChatNotificationController@show')->name('push.chat.show');
            Route::post('push-chat-newMessage', 'ChatNotificationController@newMessage')->name('push.chat.newMessage');
        });

        Route::get('/profile', 'User\HomeController@profile')->name('profile');
        Route::post('/updateProfile', 'User\HomeController@updateProfile')->name('updateProfile');
        Route::put('/updateInformation', 'User\HomeController@updateInformation')->name('updateInformation');
        Route::post('/updatePassword', 'User\HomeController@updatePassword')->name('updatePassword');
        Route::post('/verificationSubmit', 'User\HomeController@verificationSubmit')->name('verificationSubmit');
        Route::post('/addressVerification', 'User\HomeController@addressVerification')->name('addressVerification');


        Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
            Route::get('/', 'User\SupportController@index')->name('list');
            Route::get('/create', 'User\SupportController@create')->name('create');
            Route::post('/create', 'User\SupportController@store')->name('store');
            Route::get('/view/{ticket}', 'User\SupportController@ticketView')->name('view');
            Route::put('/reply/{ticket}', 'User\SupportController@reply')->name('reply');
            Route::get('/download/{ticket}', 'User\SupportController@download')->name('download');
        });
    });
});



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Admin\LoginController@login')->name('login');
    Route::post('/logout', 'Admin\LoginController@logout')->name('logout');


    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.update');



    Route::get('/403', 'Admin\DashboardController@forbidden')->name('403');

    Route::group(['middleware' => ['auth:admin','permission']], function () {

        Route::get('push-chat-show/{id}', 'ChatNotificationController@showByAdmin')->name('push.chat.show');
        Route::post('push-chat-newMessage', 'ChatNotificationController@newMessageByAdmin')->name('push.chat.newMessage');

        Route::get('push-notification-show', 'SiteNotificationController@showByAdmin')->name('push.notification.show');
        Route::get('push.notification.readAll', 'SiteNotificationController@readAllByAdmin')->name('push.notification.readAll');
        Route::get('push-notification-readAt/{id}', 'SiteNotificationController@readAt')->name('push.notification.readAt');
        Route::match(['get', 'post'], 'pusher-config', 'SiteNotificationController@pusherConfig')->name('pusher.config');


        Route::get('/profile', 'Admin\DashboardController@profile')->name('profile');
        Route::put('/profile', 'Admin\DashboardController@profileUpdate')->name('profileUpdate');
        Route::get('/password', 'Admin\DashboardController@password')->name('password');
        Route::put('/password', 'Admin\DashboardController@passwordUpdate')->name('passwordUpdate');


        Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

        Route::get('/staff', 'Admin\ManageRolePermissionController@staff')->name('staff');
        Route::post('/staff', 'Admin\ManageRolePermissionController@storeStaff')->name('storeStaff');
        Route::put('/staff/{id}', 'Admin\ManageRolePermissionController@updateStaff')->name('updateStaff');


        Route::get('/identy-form', 'Admin\IdentyVerifyFromController@index')->name('identify-form');
        Route::post('/identy-form', 'Admin\IdentyVerifyFromController@store')->name('identify-form.store');


        // Services
        Route::get('/service', 'Admin\UtilitesController@service')->name('service');
        Route::get('service/data', 'Admin\UtilitesController@getService')->name('list.service');
        Route::post('service/store', 'Admin\UtilitesController@storeService')->name('store.service');
        Route::post('service/update', 'Admin\UtilitesController@updateService')->name('update.service');
        Route::post('service/delete', 'Admin\UtilitesController@destroyService')->name('delete.service');

        // continent
        Route::get('/continent', 'Admin\UtilitesController@continent')->name('continent');
        Route::get('continent/data', 'Admin\UtilitesController@getContinent')->name('list.continent');
        Route::post('continent/store', 'Admin\UtilitesController@storeContinent')->name('store.continent');
        Route::post('continent/update', 'Admin\UtilitesController@updateContinent')->name('update.continent');
        Route::post('continent/delete', 'Admin\UtilitesController@destroyContinent')->name('delete.continent');

        // country
        Route::get('/country', 'Admin\CountryController@index')->name('country');
        Route::get('/country/add', 'Admin\CountryController@add')->name('country.create');
        Route::post('/country/add', 'Admin\CountryController@store')->name('country.store');
        Route::get('/country/{country}/edit', 'Admin\CountryController@edit')->name('country.edit');
        Route::patch('/country/{country}', 'Admin\CountryController@update')->name('country.update');
        Route::post('/country/active', 'Admin\CountryController@activeMultiple')->name('country.multiple-active');
        Route::post('/country/inactive', 'Admin\CountryController@inActiveMultiple')->name('country.multiple-inactive');
        Route::get('/country/{country}/service', 'Admin\CountryController@countryService')->name('country.service');
        Route::post('/country/{country}/service', 'Admin\CountryController@serviceStore')->name('country.service.store');
        Route::patch('/country/{country}/service', 'Admin\CountryController@serviceUpdate')->name('country.service.update');
        Route::get('/country/{country}/service/{service}/charge', 'Admin\CountryController@serviceCharge')->name('country.service.charge');
        Route::post('/country/serviceCharge', 'Admin\CountryController@serviceChargeStore')->name('country.service.charge.store');


        // Sending Purpose
        Route::get('/purpose', 'Admin\UtilitesController@purpose')->name('purpose');
        Route::get('purpose/data', 'Admin\UtilitesController@getPurpose')->name('list.purpose');
        Route::post('purpose/store', 'Admin\UtilitesController@storePurpose')->name('store.purpose');
        Route::post('purpose/update', 'Admin\UtilitesController@updatePurpose')->name('update.purpose');
        Route::post('purpose/delete', 'Admin\UtilitesController@destroyPurpose')->name('delete.purpose');

        // Source Of Fund
        Route::get('/sourceOfFund', 'Admin\UtilitesController@sourceOfFund')->name('sourceOfFund');
        Route::get('sourceOfFund/data', 'Admin\UtilitesController@getSF')->name('list.sourceOfFund');
        Route::post('sourceOfFund/store', 'Admin\UtilitesController@storeSF')->name('store.sourceOfFund');
        Route::post('sourceOfFund/update', 'Admin\UtilitesController@updateSF')->name('update.sourceOfFund');
        Route::post('sourceOfFund/delete', 'Admin\UtilitesController@destroySF')->name('delete.sourceOfFund');


        // Services
        Route::get('/coupon', 'Admin\CouponController@coupon')->name('coupon');
        Route::get('/coupon/used', 'Admin\CouponController@couponUsed')->name('coupon.used');
        Route::post('/coupon', 'Admin\CouponController@store')->name('coupon.store');




        Route::get('/money-transfer', 'Admin\TransferLogController@index')->name('money-transfer');
        Route::get('/money-transfer/complete', 'Admin\TransferLogController@complete')->name('money-transfer.complete');
        Route::get('/money-transfer/pending', 'Admin\TransferLogController@pending')->name('money-transfer.pending');
        Route::get('/money-transfer/cancelled', 'Admin\TransferLogController@cancelled')->name('money-transfer.cancelled');
        Route::get('/money-transfer/search', 'Admin\TransferLogController@search')->name('money-transfer.search');
        Route::get('/money-transfer/{sendMoney:id}/details', 'Admin\TransferLogController@details')->name('money-transfer.details');
        Route::get('/money-transfer/{file?}/download', 'Admin\TransferLogController@download')->name('money-transfer.download');
        Route::put('/money-transfer/{sendMoney?}/action', 'Admin\TransferLogController@action')->name('money-transfer.action');



        /*=====Payment Log=====*/
        Route::get('payment-methods', 'Admin\PaymentMethodController@index')->name('payment.methods');
        Route::any('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
        Route::post('sort-payment-methods', 'Admin\PaymentMethodController@sortPaymentMethods')->name('sort.payment.methods');
        Route::get('payment-methods/edit/{id}', 'Admin\PaymentMethodController@edit')->name('edit.payment.methods');
        Route::put('payment-methods/update/{id}', 'Admin\PaymentMethodController@update')->name('update.payment.methods');


        // Manual Methods
        Route::get('payment-methods/manual', 'Admin\ManualGatewayController@index')->name('deposit.manual.index');
        Route::get('payment-methods/manual/new', 'Admin\ManualGatewayController@create')->name('deposit.manual.create');
        Route::post('payment-methods/manual/new', 'Admin\ManualGatewayController@store')->name('deposit.manual.store');
        Route::get('payment-methods/manual/edit/{id}', 'Admin\ManualGatewayController@edit')->name('deposit.manual.edit');
        Route::put('payment-methods/manual/update/{id}', 'Admin\ManualGatewayController@update')->name('deposit.manual.update');


        Route::get('payment/pending', 'Admin\PaymentLogController@pending')->name('payment.pending');
        Route::get('payment/log', 'Admin\PaymentLogController@index')->name('payment.log');
        Route::get('payment/search', 'Admin\PaymentLogController@search')->name('payment.search');
        Route::put('payment/action/{id}', 'Admin\PaymentLogController@action')->name('payment.action');


        /*====Manage Users ====*/
        Route::get('/users', 'Admin\UsersController@index')->name('users');
        Route::get('/users/search', 'Admin\UsersController@search')->name('users.search');
        Route::post('/users-active', 'Admin\UsersController@activeMultiple')->name('user-multiple-active');
        Route::post('/users-inactive', 'Admin\UsersController@inactiveMultiple')->name('user-multiple-inactive');
        Route::get('/user/edit/{id}', 'Admin\UsersController@userEdit')->name('user-edit');
        Route::post('/user/update/{id}', 'Admin\UsersController@userUpdate')->name('user-update');
        Route::post('/user/password/{id}', 'Admin\UsersController@passwordUpdate')->name('userPasswordUpdate');
        Route::post('/user/balance-update/{id}', 'Admin\UsersController@userBalanceUpdate')->name('user-balance-update');

        Route::get('/user/send-email/{id}', 'Admin\UsersController@sendEmail')->name('send-email');
        Route::post('/user/send-email/{id}', 'Admin\UsersController@sendMailUser')->name('user.email-send');
        Route::get('/user/transaction/{id}', 'Admin\UsersController@transaction')->name('user.transaction');
        Route::get('/user/payment/{id}', 'Admin\UsersController@funds')->name('user.fundLog');
        Route::get('/user/transfer/{id}', 'Admin\UsersController@transfer')->name('user.transfer');
        Route::get('/user/loggedIn/{id}', 'Admin\UsersController@singleLoggedIn')->name('user.loggedIn');
        Route::get('/email-send', 'Admin\UsersController@emailToUsers')->name('email-send');
        Route::post('/email-send', 'Admin\UsersController@sendEmailToUsers')->name('email-send.store');
        Route::get('/users/loggedIn', 'Admin\UsersController@loggedIn')->name('users.loggedIn');

        Route::get('users/kyc/pending', 'Admin\UsersController@kycPendingList')->name('users.kyc.pending');
        Route::get('users/kyc', 'Admin\UsersController@kycList')->name('users.kyc');
        Route::put('users/kycAction/{id}', 'Admin\UsersController@kycAction')->name('users.Kyc.action');

        Route::get('user/{user}/kyc', 'Admin\UsersController@userKycHistory')->name('user.userKycHistory');




        /* ====== Transaction Log =====*/
        Route::get('/transaction', 'Admin\LogController@transaction')->name('transaction');
        Route::get('/transaction-search', 'Admin\LogController@transactionSearch')->name('transaction.search');


        /* ===== Support Ticket ====*/
        Route::get('tickets/{status?}', 'Admin\TicketController@tickets')->name('ticket');
        Route::get('tickets/view/{id}', 'Admin\TicketController@ticketReply')->name('ticket.view');
        Route::put('ticket/reply/{id}', 'Admin\TicketController@ticketReplySend')->name('ticket.reply');
        Route::get('ticket/download/{ticket}', 'Admin\TicketController@ticketDownload')->name('ticket.download');
        Route::post('ticket/delete', 'Admin\TicketController@ticketDelete')->name('ticket.delete');

        /* ===== Subscriber =====*/
        Route::get('subscriber', 'Admin\SubscriberController@index')->name('subscriber.index');
        Route::post('subscriber/remove', 'Admin\SubscriberController@remove')->name('subscriber.remove');
        Route::get('subscriber/send-email', 'Admin\SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
        Route::post('subscriber/send-email', 'Admin\SubscriberController@sendEmail')->name('subscriber.mail');



        /* ======== CONTROLS ========== */
        Route::get('/basic-controls', 'Admin\BasicController@index')->name('basic-controls');
        Route::post('/basic-controls', 'Admin\BasicController@updateConfigure')->name('basic-controls.update');
        Route::get('/color-settings', 'Admin\BasicController@colorSettings')->name('color-settings');
        Route::post('/color-settings', 'Admin\BasicController@colorSettingsUpdate')->name('color-settings.update');


        Route::get('/email-controls', 'Admin\EmailTemplateController@emailControl')->name('email-controls');
        Route::post('/email-controls', 'Admin\EmailTemplateController@emailConfigure')->name('email-controls.update');
        Route::get('/email-template', 'Admin\EmailTemplateController@show')->name('email-template.show');
        Route::get('/email-template/edit/{id}', 'Admin\EmailTemplateController@edit')->name('email-template.edit');
        Route::post('/email-template/update/{id}', 'Admin\EmailTemplateController@update')->name('email-template.update');


        /*========Sms control ========*/
        Route::match(['get', 'post'], '/sms-controls', 'Admin\SmsTemplateController@smsConfig')->name('sms.config');
        Route::get('/sms-template', 'Admin\SmsTemplateController@show')->name('sms-template');
        Route::get('/sms-template/edit/{id}', 'Admin\SmsTemplateController@edit')->name('sms-template.edit');
        Route::post('/sms-template/update/{id}', 'Admin\SmsTemplateController@update')->name('sms-template.update');


        Route::get('/notify-config', 'Admin\NotifyController@notifyConfig')->name('notify-config');
        Route::post('/notify-config', 'Admin\NotifyController@notifyConfigUpdate')->name('notify-config.update');
        Route::get('/notify-template', 'Admin\NotifyController@show')->name('notify-template.show');
        Route::get('/notify-template/edit/{id}', 'Admin\NotifyController@edit')->name('notify-template.edit');
        Route::post('/notify-template/update/{id}', 'Admin\NotifyController@update')->name('notify-template.update');


        /* ===== ADMIN Language SETTINGS ===== */
        Route::get('language', 'Admin\LanguageController@index')->name('language.index');
        Route::get('language/create', 'Admin\LanguageController@create')->name('language.create');
        Route::post('language/create', 'Admin\LanguageController@store')->name('language.store');
        Route::get('language/{language}', 'Admin\LanguageController@edit')->name('language.edit');
        Route::put('language/{language}', 'Admin\LanguageController@update')->name('language.update');
        Route::delete('language/{language}', 'Admin\LanguageController@delete')->name('language.delete');
        Route::get('/language/keyword/{id}', 'Admin\LanguageController@keywordEdit')->name('language.keywordEdit');
        Route::put('/language/keyword/{id}', 'Admin\LanguageController@keywordUpdate')->name('language.keywordUpdate');
        Route::post('/language/importJson', 'Admin\LanguageController@importJson')->name('language.importJson');
        Route::post('store-key/{id}', 'Admin\LanguageController@storeKey')->name('language.storeKey');
        Route::put('update-key/{id}', 'Admin\LanguageController@updateKey')->name('language.updateKey');
        Route::delete('delete-key/{id}', 'Admin\LanguageController@deleteKey')->name('language.deleteKey');






        /* ======== THEME SETTINGS ========== */
        Route::get('/logo-seo', 'Admin\BasicController@logoSeo')->name('logo-seo');
        Route::put('/logoUpdate', 'Admin\BasicController@logoUpdate')->name('logoUpdate');
        Route::put('/seoUpdate', 'Admin\BasicController@seoUpdate')->name('seoUpdate');
        Route::get('/breadcrumb', 'Admin\BasicController@breadcrumb')->name('breadcrumb');
        Route::put('/breadcrumb', 'Admin\BasicController@breadcrumbUpdate')->name('breadcrumbUpdate');


        /* ===== ADMIN TEMPLATE SETTINGS ===== */
        Route::get('template/{section}', 'Admin\TemplateController@show')->name('template.show');
        Route::put('template/{section}/{language}', 'Admin\TemplateController@update')->name('template.update');
        Route::get('contents/{content}', 'Admin\ContentController@index')->name('content.index');
        Route::get('content-create/{content}', 'Admin\ContentController@create')->name('content.create');
        Route::put('content-create/{content}/{language?}', 'Admin\ContentController@store')->name('content.store');
        Route::get('content-show/{content}/{name?}', 'Admin\ContentController@show')->name('content.show');
        Route::put('content-update/{content}/{language?}', 'Admin\ContentController@update')->name('content.update');
        Route::delete('contents/{id}', 'Admin\ContentController@contentDelete')->name('content.delete');

    });

});


Route::match(['get', 'post'], 'success', 'PaymentController@success')->name('success');
Route::match(['get', 'post'], 'failed', 'PaymentController@failed')->name('failed');
Route::match(['get', 'post'], 'payment/{code}/{trx?}/{type?}', 'PaymentController@gatewayIpn')->name('ipn');

Route::get('/to/{country:slug}', 'FrontendController@toCountry')->name('toCountry');
Route::post('/ajaxCountryService', 'FrontendController@ajaxCountryService')->name('ajaxCountryService');
Route::post('/ajaxMoneyCalculation', 'FrontendController@ajaxMoneyCalculation')->name('ajaxMoneyCalculation');

Route::get('/language/{code?}', 'FrontendController@language')->name('language');

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/how-it-work', 'FrontendController@howItWork')->name('how-it-work');
Route::get('/help', 'FrontendController@help')->name('help');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/faq', 'FrontendController@faq')->name('faq');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::post('/contact', 'FrontendController@contactSend')->name('contact.send');
Route::get('/blog-details/{slug}/{id}', 'FrontendController@blogDetails')->name('blogDetails');
Route::get('/blog', 'FrontendController@blog')->name('blog');

Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');
Route::get('/currencyList', 'FrontendController@currencyList')->name('currencyList');
Route::get('/{getLink}/{content_id}', 'FrontendController@getLink')->name('getLink');





