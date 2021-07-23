<?php

use Illuminate\Support\Facades\Route;

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


//Clear route cache:
 Route::get('/route-cache', function() {
     $exitCode = Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

// Clear application cache:
 Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

 // Clear view cache:
 Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return 'View cache cleared';
 });

 Route::get('/payment-success', function() {
	return view('pages.success_page');
});

Route::get('/', 'PageController@SalonRegister');
Route::get('/send-sms/{id}/{id1}', 'PageController@send_sms');
Route::get('/salon-register', 'PageController@SalonRegister');
Route::POST('/save-salon-register', 'PageController@saveSalonRegister');
Route::POST('/salon-basic-validate', 'PageController@SalonBasicValidate');
Route::POST('/salon-contact-validate', 'PageController@SalonContactValidate');
Route::get('/salon-create-password/{id}', 'PageController@salonCreatePassword');
Route::POST('/salon-update-password', 'PageController@salonUpdatePassword');
Route::POST('/update-login', 'PageController@updateLogin');
Route::get('/get-area/{id}', 'PageController@getArea');

//Route::get('/contractSendMail/{id}', 'PageController@contractSendMail');

Route::get('/customer-create-password/{id}', 'PageController@customerCreatePassword');
Route::POST('/customer-update-password', 'PageController@customerUpdatePassword');


//cron-job-url
Route::get('/expired-salon', 'CronController@expiredSalon');
Route::get('/cash-report', 'CronController@cashReport');
Route::get('/card-report', 'CronController@cardReport');
Route::get('/check-payment-status', 'CronController@checkPaymentStatus');

Route::group(['prefix' => 'admin'],function(){

	Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout');
	  // Password reset routes
    Route::post('/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	Route::get('/revenue-report', 'ReportController@revenueReport');
	Route::post('/get-booking/{date1}/{date2}', 'ReportController@getBooking');
	
	Route::get('/payments-in-report', 'ReportController@paymentsInReport');
	Route::post('/get-payments-in-report/{date1}/{date2}', 'ReportController@getPaymentsInReport');

	Route::get('/payments-out-report', 'ReportController@paymentsOutReport');
	Route::post('/get-payments-out-report/{date1}/{date2}', 'ReportController@getPaymentsOutReport');

	Route::post('/excel-revenue-report', 'ReportController@excelRevenueReport');
	Route::post('/date-payments-in-report', 'ReportController@datePaymentsInReport');
	Route::post('/date-payments-out-report', 'ReportController@datePaymentsOutReport');

	Route::get('/change-status-paymentsout/{id}/{status}', 'ReportController@changeStatusPaymentsout');

	Route::get('/app-terms', 'AdminController@appTerms');
	Route::POST('/update-app-terms', 'AdminController@updateAppTerms');

	Route::get('/app-privacy', 'AdminController@appPrivacy');
	Route::POST('/update-app-privacy', 'AdminController@updateAppPrivacy');

	Route::get('/app-about', 'AdminController@appAbout');
	Route::POST('/update-app-about', 'AdminController@updateAppAbout');

	//salon
	Route::POST('/save-salon', 'SalonController@saveSalon');
	Route::POST('/update-salon', 'SalonController@updateSalon');
	Route::get('/salon/{id}', 'SalonController@editSalon');
	Route::get('/salon', 'SalonController@Salon');
	Route::POST('/get-salon/{id}', 'SalonController@getSalon');
	Route::get('/salon-delete/{id}', 'SalonController@deleteSalon');

	Route::get('/ChangeStatus/{id}/{id1}', 'SalonController@ChangeStatus');

	Route::get('/view-salon/{id}', 'SalonController@viewSalon');
	Route::get('/salon-login/{id}', 'Vendor\HomeController@SalonLogin');
	
	Route::get('/get-package-plan/{id}', 'SalonController@getPackagePlan');
	Route::POST('/update-plan', 'SalonController@updatePlan');

	//addservice
	Route::POST('/save-addservice', 'SalonController@saveAddService');
	Route::POST('/update-addservice', 'SalonController@updateAddService');
	Route::get('/addservice/{id}', 'SalonController@editAddService');
	Route::get('/addservice-delete/{id}', 'SalonController@deleteAddService');
	
	Route::get('/salon-notification', 'SalonController@salonNotification');
	Route::get('/update-salon-notification/{id}/{id1}', 'SalonController@updateSalonNotification');

	Route::POST('/update-time', 'SalonController@updateTime');
	Route::POST('/update-location', 'SalonController@updateLocation');

	Route::POST('/salon-send-email', 'SalonController@salonSendEmail');
	Route::POST('/salon-add-password', 'SalonController@salonAddPassword');


	//category
	Route::POST('/save-category', 'CategoryController@saveCategory');
	Route::POST('/update-category', 'CategoryController@updateCategory');
	Route::get('/category/{id}', 'CategoryController@editCategory');
	Route::get('/category', 'CategoryController@Category');
	Route::get('/category-delete/{id}', 'CategoryController@deleteCategory');

	//sub category
	Route::POST('/save-sub-category', 'CategoryController@saveSubCategory');
	Route::POST('/update-sub-category', 'CategoryController@updateSubCategory');
	Route::get('/edit-sub-category/{id}', 'CategoryController@editSubCategory');
	Route::get('/sub-category/{id}','CategoryController@SubCategory');
	Route::get('/sub-category-delete/{id}', 'CategoryController@deleteSubCategory');

	//package
	Route::POST('/save-salon-package', 'PackageController@saveSalonPackage');
	Route::POST('/update-salon-package', 'PackageController@updateSalonPackage');
	Route::get('/salon-package/{id}', 'PackageController@editSalonPackage');
	Route::get('/salon-package', 'PackageController@SalonPackage');
	Route::get('/salon-package-delete/{id}', 'PackageController@deleteSalonPackage');
	
	Route::get('/get-salon-package-item/{id}', 'PackageController@getSalonPackageItem');


	//service
	Route::POST('/save-service', 'ServiceController@saveService');
	Route::POST('/update-service', 'ServiceController@updateService');
	Route::get('/service/{id}', 'ServiceController@editService');
	Route::get('/service', 'ServiceController@Service');
	Route::get('/service-delete/{id}', 'ServiceController@deleteService');
	Route::get('/new-service', 'ServiceController@newService');
	Route::get('/update-new-service/{id}/{id1}', 'ServiceController@updateNewService');

	Route::post('/update-service-request', 'ServiceController@updateServiceRequest');

	Route::get('/product-request', 'ServiceController@productRequest');
	Route::get('/update-product-request/{id}/{id1}', 'ServiceController@updateProductRequest');

	//city
	Route::POST('/save-city', 'AreaController@saveCity');
	Route::POST('/update-city', 'AreaController@updateCity');
	Route::get('/city/{id}', 'AreaController@editCity');
	Route::get('/city', 'AreaController@City');
	Route::get('/city-delete/{id}', 'AreaController@deleteCity');

	//country
	Route::POST('/save-country', 'AreaController@saveCountry');
	Route::POST('/update-country', 'AreaController@updateCountry');
	Route::get('/country/{id}', 'AreaController@editCountry');
	Route::get('/country', 'AreaController@Country');
	Route::get('/country-delete/{id}', 'AreaController@deleteCountry');


	//app-salon
	Route::get('/get-app-salon/{id}', 'AppController@getAppSalon');
	Route::POST('/save-app-salon', 'AppController@saveAppSalon');
	Route::POST('/update-app-salon', 'AppController@updateAppSalon');
	Route::get('/app-salon', 'AppController@AppSalon');
	Route::get('/app-salon-delete/{id}', 'AppController@deleteAppSalon');

	//app-spa
	Route::get('/get-app-spa/{id}', 'AppController@getAppSpa');
	Route::POST('/save-app-spa', 'AppController@saveAppSpa');
	Route::POST('/update-app-spa', 'AppController@updateAppSpa');
	Route::get('/app-spa', 'AppController@AppSpa');
	Route::get('/app-spa-delete/{id}', 'AppController@deleteAppSpa');

	//app-beauty
	Route::get('/get-app-beauty/{id}', 'AppController@getAppBeauty');
	Route::POST('/save-app-beauty', 'AppController@saveAppBeauty');
	Route::POST('/update-app-beauty', 'AppController@updateAppBeauty');
	Route::get('/app-beauty', 'AppController@AppBeauty');
	Route::get('/app-beauty-delete/{id}', 'AppController@deleteAppBeauty');

	//app-makeup
	Route::get('/get-app-makeup/{id}', 'AppController@getAppMakeup');
	Route::POST('/save-app-makeup', 'AppController@saveAppMakeup');
	Route::POST('/update-app-makeup', 'AppController@updateAppMakeup');
	Route::get('/app-makeup', 'AppController@AppMakeup');
	Route::get('/app-makeup-delete/{id}', 'AppController@deleteAppMakeup');

	//app-home
	Route::get('/get-app-home/{id}', 'AppController@getAppHome');
	Route::POST('/save-app-home', 'AppController@saveAppHome');
	Route::POST('/update-app-home', 'AppController@updateAppHome');
	Route::get('/app-home', 'AppController@AppHome');
	Route::get('/app-home-delete/{id}', 'AppController@deleteAppHome');

	//user
	Route::POST('/save-user', 'AdminController@saveUser');
	Route::POST('/update-user', 'AdminController@updateUser');
	Route::get('/user/{id}', 'AdminController@editUser');
	Route::get('/user', 'AdminController@User');
	Route::get('/user-delete/{id}', 'AdminController@deleteUser');

	Route::get('/customer', 'CustomerController@Customer');
	Route::get('/view-customer/{id}', 'CustomerController@viewCustomerDetails');

	Route::POST('/save-customer', 'CustomerController@saveCustomer');
	Route::POST('/update-customer', 'CustomerController@updateCustomer');
	Route::get('/customer/{id}', 'CustomerController@editCustomer');
	Route::get('/customer-delete/{id}', 'CustomerController@deleteCustomer');

	Route::POST('/customer-password-send', 'CustomerController@customerPasswordSend');
	Route::POST('/customer-update-password', 'CustomerController@customerUpdatePassword');

	Route::get('/review', 'ReviewController@Review');
	Route::get('/review-status/{id}/{id1}', 'ReviewController@reviewStatus');

	//notification
	Route::POST('/save-notification', 'NotificationController@saveNotification');
	Route::POST('/save-send-notification', 'NotificationController@saveSendNotification');
	Route::POST('/update-notification', 'NotificationController@updateNotification');
	Route::POST('/update-send-notification', 'NotificationController@updateSendNotification');
	Route::get('/notification/{id}', 'NotificationController@editNotification');
	Route::get('/push-notification', 'NotificationController@Notification');
	Route::get('/notification-delete/{id}', 'NotificationController@deleteNotification');
	Route::get('/notification-send/{id}', 'NotificationController@sendNotification');

	Route::get('/notification-read-status/{id}', 'NotificationController@notificationReadStatus');

	Route::POST('/update-notification-request', 'SalonController@updateNotificationRequest');

	Route::get('/get-notification-salon/{id}', 'NotificationController@getNotificationSalon');
	Route::get('/get-notification-customer/{id}', 'NotificationController@getNotificationCustomer');

	Route::post('change-password', 'AdminController@changePassword');
	Route::get('view-user/{id}', 'AdminController@viewUser');

	Route::post('settlement-period', 'AdminController@updateSettlementPeriod');
	Route::get('settlement-period', 'AdminController@getSettlementPeriod');

	// coupon Management
	Route::get('/coupon','CouponController@index');
	Route::get('/addCoupon','CouponController@addCoupon');
	Route::get('/viewCoupon/{id}','CouponController@viewCoupon');
	Route::post('/CouponSave','CouponController@CouponSave');
	Route::post('/CouponUpdate','CouponController@CouponUpdate');
	Route::get('/CouponEdit/{id}','CouponController@CouponEdit');
	Route::get('/CouponDelete/{id}','CouponController@CouponDelete');
	Route::get('/get_coupon_service/{id}','CouponController@get_coupon_service');
	Route::get('/get_coupon_user/{id}','CouponController@get_coupon_user');

	Route::get('/new-coupon', 'CouponController@newCoupon');
	Route::get('/update-new-coupon/{id}/{id1}', 'CouponController@updateNewCoupon');

	Route::post('/update-coupon-request', 'CouponController@updateCouponRequest');


	//slider
	Route::POST('/save-slider', 'SettingsController@saveSlider');
	Route::POST('/update-slider', 'SettingsController@updateSlider');
	Route::get('/slider/{id}', 'SettingsController@editSlider');
	Route::get('/slider', 'SettingsController@Slider');
	Route::get('/slider-delete/{id}', 'SettingsController@deleteSlider');

	//promotion banner
	Route::POST('/save-banner', 'SettingsController@saveBanner');
	Route::POST('/update-banner', 'SettingsController@updateBanner');
	Route::get('/banner/{id}', 'SettingsController@editBanner');
	Route::get('/banner', 'SettingsController@Banner');
	Route::get('/banner-delete/{id}', 'SettingsController@deleteBanner');

	//application settings
	Route::get('/application-settings', 'SettingsController@applicationSettings');
	Route::POST('/update-application-settings', 'SettingsController@updateApplicationSettings');

	//application settings
	Route::get('/terms-and-condition', 'SettingsController@termsAndCondition');
	Route::POST('/update-terms-and-condition', 'SettingsController@updateTermsAndCondition');



	Route::get('/chat-to-customer', 'ChatController@chatToCustomer');
	Route::get('/get-customer-chat/{id}', 'ChatController@getCustomerChat');

	Route::get('/chat-to-salon', 'ChatController@chatToSalon');

	Route::get('/get-salon-chat/{id}', 'ChatController@getSalonChat');

	Route::POST('/save-salon-chat', 'ChatController@saveSalonChat');


	Route::get('/booking', 'AdminController@getBooking');
	Route::get('/print-invoice/{id}', 'AdminController@printInvoice');

	//roles
	Route::POST('/save-role', 'RoleController@saveRole');
	Route::POST('/update-role', 'RoleController@updateRole');
	Route::get('/role/{id}', 'RoleController@editRole');
	Route::get('/role', 'RoleController@Role');
	Route::get('/role-delete/{id}', 'RoleController@deleteRole');

	Route::POST('/save-service-package', 'SalonController@saveServicePackage');
	Route::POST('/update-service-package', 'SalonController@updateServicePackage');
	Route::get('/service-package/{id}', 'SalonController@editServicePackage');
	Route::get('/service-package-delete/{id}', 'SalonController@deleteServicePackage');
	Route::get('/get_package_services/{id}', 'SalonController@getPackageServices');

	
	Route::get('/coupon-read-status/{id}', 'CouponController@couponReadStatus');
	Route::get('/service-read-status/{id}', 'ServiceController@serviceReadStatus');
	Route::get('/booking-read-status/{id}', 'AdminController@bookingReadStatus');
	
});


Route::group(['prefix' => 'vendor'],function(){
	Route::get('/dashboard', 'Vendor\ServiceController@dashboard');

	//notification
	Route::POST('/save-notification', 'Vendor\NotificationController@saveNotification');
	Route::POST('/update-notification', 'Vendor\NotificationController@updateNotification');
	Route::get('/notification/{id}', 'Vendor\NotificationController@editNotification');
	Route::get('/push-notification', 'Vendor\NotificationController@Notification');
	Route::get('/notification-delete/{id}', 'Vendor\NotificationController@deleteNotification');
	Route::get('/get_notification_customer/{id}', 'Vendor\NotificationController@getNotificationCustomer');

	//service
	Route::POST('/save-service', 'Vendor\ServiceController@saveService');
	Route::POST('/update-service', 'Vendor\ServiceController@updateService');
	Route::get('/service/{id}', 'Vendor\ServiceController@editService');
	Route::get('/new-service', 'Vendor\ServiceController@Service');
	Route::get('/service-delete/{id}', 'Vendor\ServiceController@deleteService');

	//service payment
	Route::POST('/save-service-payment', 'Vendor\ServiceController@saveServicePayment');
	Route::POST('/update-service-payment', 'Vendor\ServiceController@updateServicePayment');
	Route::get('/service-payment/{id}', 'Vendor\ServiceController@editServicePayment');
	Route::get('/service-payment', 'Vendor\ServiceController@ServicePayment');
	Route::get('/service-payment-delete/{id}', 'Vendor\ServiceController@deleteServicePayment');

	//service package
	Route::POST('/save-service-package', 'Vendor\ServiceController@saveServicePackage');
	Route::POST('/update-service-package', 'Vendor\ServiceController@updateServicePackage');
	Route::get('/service-package/{id}', 'Vendor\ServiceController@editServicePackage');
	Route::get('/service-package', 'Vendor\ServiceController@ServicePackage');
	Route::get('/service-package-delete/{id}', 'Vendor\ServiceController@deleteServicePackage');
	Route::get('/get_package_services/{id}', 'Vendor\ServiceController@getPackageServices');

	//product
	Route::POST('/save-product', 'Vendor\ProductController@saveProduct');
	Route::POST('/update-product', 'Vendor\ProductController@updateProduct');
	Route::get('/product/{id}', 'Vendor\ProductController@editProduct');
	Route::get('/product', 'Vendor\ProductController@Product');
	Route::get('/product-delete/{id}', 'Vendor\ProductController@deleteProduct');
	Route::get('/product-exclusive/{id}/{status}', 'Vendor\ProductController@deleteExclusive');


	// coupon Management
	Route::get('/coupon','Vendor\CouponController@index');
	Route::get('/addCoupon','Vendor\CouponController@addCoupon');
	Route::get('/viewCoupon/{id}','Vendor\CouponController@viewCoupon');
	Route::post('/CouponSave','Vendor\CouponController@CouponSave');
	Route::post('/CouponUpdate','Vendor\CouponController@CouponUpdate');
	Route::get('/CouponEdit/{id}','Vendor\CouponController@CouponEdit');
	Route::get('/CouponDelete/{id}','Vendor\CouponController@CouponDelete');
	Route::get('/get_coupon_service/{id}','Vendor\CouponController@get_coupon_service');
	Route::get('/get_coupon_user/{id}','Vendor\CouponController@get_coupon_user');


	Route::POST('/save-workers', 'Vendor\WorkersController@saveWorkers');
	Route::POST('/update-workers', 'Vendor\WorkersController@updateWorkers');
	Route::get('/workers/{id}', 'Vendor\WorkersController@editWorkers');
	Route::get('/workers', 'Vendor\WorkersController@Workers');
	Route::get('/workers-delete/{id}', 'Vendor\WorkersController@deleteWorkers');
	Route::get('/get_workers_services/{id}', 'Vendor\WorkersController@getWorkersServices');

	Route::get('/edit-profile', 'Vendor\WorkersController@editProfile');
	Route::POST('/update-profile', 'Vendor\WorkersController@updateProfile');

	Route::POST('/save-gallery', 'Vendor\WorkersController@saveGallery');
	Route::get('/gallery-delete/{id}', 'Vendor\WorkersController@deleteGallery');
	Route::get('/gallery', 'Vendor\WorkersController@Gallery');

	Route::get('/review', 'Vendor\ReviewController@Review');
	Route::get('/report', 'Vendor\ReportController@Report');

	Route::get('/payments-in-report', 'Vendor\ReportController@PaymentsInReport');
	Route::get('/payments-out-report', 'Vendor\ReportController@PaymentsOutReport');

	Route::get('/change-status-paymentsout/{id}/{status}', 'Vendor\ReportController@changeStatusPaymentsout');

	//roles
	Route::POST('/save-role', 'Vendor\RoleController@saveRole');
	Route::POST('/update-role', 'Vendor\RoleController@updateRole');
	Route::get('/role/{id}', 'Vendor\RoleController@editRole');
	Route::get('/role', 'Vendor\RoleController@Role');
	Route::get('/role-delete/{id}', 'Vendor\RoleController@deleteRole');

	Route::get('/calendar', function () {
    	return view('vendor.calendar');
	});

	Route::get('/get-booking', 'Vendor\ChatController@getBooking');
	Route::post('/verified-otp', 'Vendor\ChatController@verifiedOtp');
	Route::get('/update-payment-status/{id}', 'Vendor\ChatController@updatePaymentStatus');

	Route::get('/view-address/{id}', 'Vendor\ChatController@viewAddress');

	Route::get('/bank-details', 'Vendor\ReviewController@bankDetails');
	Route::POSt('/update-bank-details', 'Vendor\ReviewController@updateBankDetails');

	Route::get('/store-time', 'Vendor\ReviewController@storeTime');
	Route::POSt('/update-store-time', 'Vendor\ReviewController@updateStoreTime');

	Route::get('/chat-to-customer/{id}', 'Vendor\ChatController@chatToCustomer');
	Route::get('/get-customer-chat/{id}', 'Vendor\ChatController@getCustomerChat');
	Route::POST('/save-customer-chat', 'Vendor\ChatController@saveCustomerChat');

	Route::get('/get-admin-chat/{id}', 'Vendor\ChatController@getAdminChat');
	Route::POST('/save-admin-chat', 'Vendor\ChatController@saveAdminChat');

	Route::get('/print-invoice/{id}', 'Vendor\ChatController@printInvoice');

	Route::get('/booking-read-status', 'Vendor\ChatController@bookingReadStatus');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
