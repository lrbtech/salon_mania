<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/otp-check', 'ApiController@getApiOtpCheck');
//customer
Route::post('/create-customer', 'ApiController@createCustomer');
Route::post('/verify-customer', 'ApiController@verifyCustomer');
Route::post('/login', 'ApiController@customerLogin');
Route::post('/update-customer', 'ApiController@updateCustomer');
Route::get('/edit-customer/{id}', 'ApiController@editCustomer');

Route::post('/otp-resend', 'ApiController@getApiOtpResend');

Route::post('/forget-password', 'ApiController@forgetPassword');
Route::post('/reset-password', 'ApiController@resetPassword');

Route::get('/get-slider', 'ApiController@getApiSlider');
Route::get('/get-category', 'ApiController@getApiCategory');
Route::get('/get-service', 'ApiController@getApiServices');
Route::get('/get-city', 'ApiController@getApiCity');

Route::get('/get-terms/{id}', 'ApiController@getApiTerms');
Route::get('/get-privacy/{id}', 'ApiController@getApiPrivacy');
Route::get('/get-about/{id}', 'ApiController@getApiAbout');

//homepage
Route::get('/get-salon-details/{id}/{lat}/{lng}', 'ApiController@getApiSalonDetails');
Route::get('/get-spa-details/{id}/{lat}/{lng}', 'ApiController@getApiSpaDetails');
Route::get('/get-makeup-details/{id}/{lat}/{lng}', 'ApiController@getApiMakeupDetails');
Route::get('/get-beauty-details/{id}/{lat}/{lng}', 'ApiController@getApiBeautyDetails');
Route::get('/get-dermatologist-details/{id}/{lat}/{lng}', 'ApiController@getApiDermatologistDetails');
Route::get('/get-home-details/{id}/{lat}/{lng}', 'ApiController@getApiHomeDetails');

Route::get('/get-salon-product/{id}', 'ApiController@getSalonProduct');
Route::get('/exclusive-product', 'ApiController@exclusiveSalonProduct');

//homepage others
Route::get('/get-other-services/{city}/{lat}/{lng}', 'ApiController@getApiOtherServices');
Route::get('/get-other-all-services/{city}/{lat}/{lng}', 'ApiController@getApiAllOtherServices');

Route::get('/get-service-details/{id}/{city}/{lat}/{lng}', 'ApiController@getApiServiceDetails');

Route::get('/get-shop-name/{name}/{lat}/{lng}', 'ApiController@getApiShopName');

Route::get('/get-all-shop/{id}/{lat}/{lng}', 'ApiController@getApiAllShop');
//check if agend id is home services
Route::get('/get-shop-status/{id}', 'ApiController@getApiShopStatus');

Route::post('/profile-update', 'ApiController@profileUpdate');
Route::post('/change-password', 'ApiController@changePassword');
//app profile image upload to server
Route::post('/profile-image-update', 'ApiController@profileImageUpdate');

Route::post('/save-address', 'ApiController@saveAddress');
Route::post('/update-address', 'ApiController@updateAddress');
Route::post('/delete-address', 'ApiController@deleteAddress');
Route::get('/get-address/{id}', 'ApiController@getAddress');


Route::get('/get-shop-details/{id}', 'ApiController@getShopDetails');
Route::get('/get-shop-workers/{id}', 'ApiController@getShopWorkers');
Route::get('/get-shop-gallery/{id}', 'ApiController@getShopGallery');
Route::get('/get-shop-review/{id}', 'ApiController@getShopReview');
Route::get('/get-shop-hours/{id}', 'ApiController@getShopHours');
Route::get('/get-shop-services/{id}', 'ApiController@getShopServices');

Route::get('/get-shop-weeks/{id}', 'ApiController@getShopWeeks');
Route::get('/get-shop-booking/{id}/{id1}', 'ApiController@getShopBooking');
Route::post('/get-shop-near', 'ApiController@getShopNear');

Route::post('/save-booking', 'ApiController@saveBooking');
Route::post('/save-booking-item', 'ApiController@saveBookingItem');
Route::post('/save-booking-package', 'ApiController@saveBookingPackage');
Route::post('/save-booking-product', 'ApiController@saveBookingProduct');
//appoinment done
Route::get('/get-booking/{id}', 'ApiController@getBooking');
//manage address get from 
Route::get('/get-manage-address/{id}', 'ApiController@getManageAddress');
//booking process
Route::get('/get-booking-item/{id}', 'ApiController@getBookingItem');
Route::get('/get-booking-package/{id}', 'ApiController@getBookingPackage');
Route::get('/get-booking-product/{id}', 'ApiController@getBookingProduct');
Route::get('/get-booking-transaction/{id}', 'ApiController@getBookingTransaction');

Route::get('/get-package/{id}', 'ApiController@getShopPackage');
Route::get('/get-package-services/{id}', 'ApiController@getPackageServices');

Route::get('/get-all-package/{city}', 'ApiController@getAllPackage');
Route::get('/get-coupon-code/{customer_id}', 'ApiController@getCouponCode');
Route::get('/get-all-nation', 'ApiController@getAllNation');

Route::get('/coupon-code-apply/{customer_id}/{code}/{value}/{salon_id}', 'ApiController@couponModule');

Route::get('/get-push-notification/{id}', 'ApiController@getPushNotification');

Route::get('/get-push-notification-shop/{id}', 'SalonApiController@getPushNotification');


Route::POST('/get-access-token', 'PaymentController@getAccessToken');
Route::POST('/create-payment-order', 'PaymentController@createPaymentOrder');
Route::POST('/payment-pay', 'PaymentController@paymentPay');
Route::get('/get-retrive-payment/{id}', 'ApiController@getRetrivePayment');
//chat
Route::get('/get-chat-booking/{id}', 'ApiController@getChatBooking');
Route::post('/save-chat-booking', 'ApiController@saveChatBooking');
Route::get('/chat-read-count/{id}', 'ApiController@chatReadCount');


//review
Route::POST('/save-review', 'ApiController@saveReview');
Route::get('/get-review/{order_id}', 'ApiController@getReview');


//split address
Route::post('/split-address', 'ApiController@splitAddress');



//salon
Route::post('/salon-login', 'SalonApiController@salonLogin');
// Route::post('/update-salon', 'SalonApiController@updateCustomer');
// Route::get('/edit-salon/{id}', 'SalonApiController@editCustomer');

Route::post('/salon-otp-resend', 'SalonApiController@getApiOtpResend');

Route::post('/salon-forget-password', 'SalonApiController@forgetPassword');
Route::post('/salon-reset-password', 'SalonApiController@resetPassword');

Route::post('/salon-change-password', 'SalonApiController@changePassword');

Route::get('/get-salon-dashboard/{id}', 'SalonApiController@getDashboard');
Route::get('/get-salon-booking/{id}', 'SalonApiController@getBooking');
Route::POST('/booking-otp-verified', 'SalonApiController@BookingOtpVerified');

//booking process
Route::get('/get-salon-booking-item/{id}', 'SalonApiController@getBookingItem');
Route::get('/get-salon-booking-package/{id}', 'SalonApiController@getBookingPackage');
Route::get('/get-salon-booking-transaction/{id}', 'SalonApiController@getBookingTransaction');

Route::post('/update-booking-status', 'SalonApiController@uodateBookingStatus');

//chat
Route::get('/get-chat-salon/{id}', 'SalonApiController@getChatSalon');
Route::post('/save-chat-salon', 'SalonApiController@saveChatSalon');

//chat
Route::get('/get-salon-service/{id}', 'SalonApiController@getSalonService');
Route::post('/update-salon-service', 'SalonApiController@updateSalonService');

        