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

Route::get('/auth-login', function () {
   return view('auth-login');
})->name('auth-login');
Route::get('/auth-register', function () {
   $smart_captcha = rand(1001, 9999);
   return view('auth-register', ['smart_captcha' => $smart_captcha]);
})->name('auth-register');
Route::post('/auth-register', 'Auth\RegisterController@create');
Route::post('/auth-register/send-number','Auth\RegisterController@sendNumber');
Route::post('/auth-register/verify-number','Auth\RegisterController@verifyNumber');
Route::post('/auth-register/resend-number','Auth\RegisterController@resendNumber');


Route::post('/auth-login', 'Auth\LoginController@login');

Route::post('/reset-password', 'PasswordResetController@passwordReset');
Route::get('/reset-password', function(){
    return view('auth-recoverpw');
});

Route::get('/players-before', 'PlayersBeforeController@index')->name('players-before');

Route::get('/about-us', function(){
   return view('about-us');
})->name('about-us');

Route::get('/faq', function(){
   return view('faq');
})->name('faq');

Route::get('/how-to-play', function(){
   return view('how-to-play');
})->name('how-to-play');

Route::get('/privacy-policy', function(){
   return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms', function(){
   return view('terms');
})->name('terms');


Auth::routes();

Route::get('pages-login', 'SkoteController@index');
Route::get('pages-login-2', 'SkoteController@index');
Route::get('pages-register', 'SkoteController@index');
Route::get('pages-register-2', 'SkoteController@index');
Route::get('pages-recoverpw', 'SkoteController@index');
Route::get('pages-recoverpw-2', 'SkoteController@index');
Route::get('pages-lock-screen', 'SkoteController@index');
Route::get('pages-lock-screen-2', 'SkoteController@index');
Route::get('pages-404', 'SkoteController@index');
Route::get('pages-500', 'SkoteController@index');
Route::get('pages-maintenance', 'SkoteController@index');
Route::get('pages-comingsoon', 'SkoteController@index');

Route::post('keep-live', 'SkoteController@live');

Route::get('index/{locale}', 'LocaleController@lang');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::post('/contacts-profile', 'UserController@updateProfile');

//List Users
Route::get('/list-user', 'HomeController@listUser')->name('list-user');
Route::post('/list-user/editUser', 'HomeController@editUser');
Route::post('/list-user/changeBlock', 'HomeController@changeBlock');

//account

Route::get('/account', 'AccountController@index')->name('account');
Route::get('/account/daily-gift', 'AccountController@dailyGift')->name('account.daily-gift');
Route::post('/account/daily-gift/random', 'AccountController@dailyGiftRandom');
Route::get('/account/explorer', 'AccountController@explorer')->name('account.explorer');
Route::post('/account/explorer/get-star', 'AccountController@getStar');
Route::get('/account/foods', 'AccountController@foods')->name('account.foods');
Route::post('/account/daily-message/changeStatus', 'AccountController@dailyMessageChangeStatus');


//validation worker captcha
Route::post('/worker/validation-captcha', 'AccountController@validationCaptcha');
Route::post('/worker/start-server-count', 'AccountController@startServerCount');
//refresh catcha
Route::get('/worker/refresh-captcha', 'AccountController@refreshCaptcha');
//increase diamond amount every minute.
Route::get('/worker/worker-increase', 'AccountController@workerIncrease');
Route::post('/worker/send-time', 'AccountController@workerTime');
//change worker-diamond status;
Route::post('/worker/start-timer', 'AccountController@startTimer');
Route::post('/worker/end-timer', 'AccountController@endTimer');
//collect
//start collect timer
Route::post('/collect/start-timer', 'AccountController@startCollectTimer');

//conversion
Route::get('/conversion', 'ConversionController@index')->name('conversion');
Route::post('/conversion/confirm', 'ConversionController@confirm');
Route::post('/conversion/convert', 'ConversionController@convert');

//collect page
Route::get('/account/collect', 'AccountController@collect');
Route::post('/account/collect/collectCaptcha', 'AccountController@collectCaptcha');

//food-store page
Route::get('/account/food-store', 'AccountController@foodStore')->name('food-store');
Route::post('/account/food-store/decrease-food-amount', 'AccountController@decreaseFoodAmount');
Route::post('/account/food-store/attack-gems', 'AccountController@attackGems');

//top-up page
Route::get('/account/top-up', 'AccountController@topUp');
//purchase page
Route::post('/account/purchase', 'AccountController@purchase');
Route::post('/account/addToCart', 'AccountController@addToCart');
Route::get('/account/top-up-cart', 'AccountController@topUpCart')->name('top-up-cart');
Route::get('/account/top-up-cart/delete', 'AccountController@topUpCartDelete');
Route::get('/account/top-up-cart/update', 'AccountController@topUpCartUpdate');
Route::get('/account/top-up-cart/checkout', 'AccountController@topUpCartCheckout');

//edit-profile
Route::get('/edit-profile', 'EditProfileController@index')->name('edit-profile');
Route::post('/edit-profile/captcha-validation', 'EditProfileController@captchaValidation');
Route::post('/edit-profile/edit', 'EditProfileController@edit');

//players
Route::get('/players', 'PlayerController@index');
Route::post('/players/buy-player', 'PlayerController@buyPlayer');

//bank
Route::get('/bank', 'BankController@index')->name('bank');
Route::post('/bank/buy-diamond', 'BankController@buyDiamond');

//my wallet
Route::get('/wallet', 'WalletController@index')->name('wallet');
Route::post('/wallet/checkout', 'WalletController@checkout');
Route::post('/wallet/checkout/request', 'WalletController@checkoutRequest');
Route::post('/wallet/checkout/success', 'WalletController@checkoutSuccess');

Route::post('/wallet/payment', 'WalletController@payment')->name('payment');
Route::get('/wallet/transaction', 'WalletController@transaction')->name('transaction');

//paypal
Route::post('/paypal/create', 'PaypalController@create');
Route::post('/paypal/capture', 'PaypalController@capture');
Route::get('/paypal/return', 'PaypalController@return');


//withdraw
Route::get('/withdraw', 'WithdrawController@index')->name('withdraw');
Route::post('/withdraw/save-amount', 'WithdrawController@saveAmount');

//withdraw-history
Route::get('/withdraw-history', 'WithdrawController@history');


//chat
Route::get('/chat', 'ChatController@index')->name('chat');
Route::post('/chat/addChat', 'ChatController@addChat');
Route::get('/chat/getChat', 'ChatController@getChat');
Route::get('/chat/history', 'ChatController@chatHistory');

//referral
Route::get('/referral', 'ReferralController@index')->name('referral');
Route::get('/referral/collect', 'ReferralController@collect');
Route::get('/referral/view', 'ReferralController@view');

//tournament
Route::get('/tournament', 'TournamentController@index')->name('tournament');
Route::get('/tournament/{id}', 'TournamentController@register');
Route::post('/tournament/checkout', 'TournamentController@checkout');
Route::get('/tournament/confirm-checkout/{id}', 'TournamentController@confirmCheckout')->name('tournament.confirm-checkout');
Route::post('/tournament/place-order', 'TournamentController@placeOrder');

//tournament before
Route::get('/tournament-before', 'TournamentBeforeController@index');

//online players
Route::get('/online-players', 'OnlinePlayersController@index')->name('online-players');
//latest payments
Route::get('/latest-payments', 'LatestPaymentsController@index')->name('latest-payments');

//top-up-history
Route::get('/top-up-history', 'TopUpHistoryController@index')->name('top-up-history');

//tournamnet-history
Route::get('/tournament-history', 'TournamentHistoryController@index')->name('tournament-history');

//Add routes before this line only
// Route::get('/{any}', 'HomeController@index');    


Route::get('/index', function () {
   if (Auth::user()) {
      return redirect()->route('account');
   } else {
      return redirect()->route('index');
   }
});

Route::get('/', function () {
   if (Auth::user()) {
      return redirect()->route('account');
   } else {
      $all_sliders = App\Models\Slider::all();
      $all_top_ups = array();
      $top_ups = App\Models\TopUp::all();
      foreach ($top_ups as $key => $top_up) {
         if ($key % 5 == 0) {
            $all_top_ups[intval($key / 5)] = array();
         }
         array_push($all_top_ups[intval($key / 5)], $top_up);
      }
      $send_corner = array();
      $all_tournament_corners = App\Models\TournamentCorner::all();
      foreach ($all_tournament_corners as $key=> $item) {
         if ($key % 4 == 0) {
            $send_corner[$key / 4] = array();
         }
         array_push($send_corner[floor($key / 4)], $item);
      }
      return view('home', [
         'all_sliders' => $all_sliders,
         'all_top_ups' => $all_top_ups,
         'send_corner' => $send_corner,
      ]);
   }
})->name('index');
