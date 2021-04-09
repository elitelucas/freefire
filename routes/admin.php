<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get(
        '/login',
        'Auth\AdminLoginController@showLoginForm'
    )->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('pages-login', 'SkoteController@index');


    //List Users
    Route::get('/list-user', 'AdminHomeController@listUser')->name('admin.list-user');
    Route::post('/list-user/editUser', 'AdminHomeController@editUser');
    Route::post('/list-user/changeBlock', 'AdminHomeController@changeBlock');
    Route::get('/list-user/getUserFood', 'AdminHomeController@getUserFood');

    //slider
    Route::get('/slider', 'SliderController@index')->name('admin.slider');
    Route::get('/slider/{id}', 'SliderController@edit');
    Route::post('/slider/editImage', 'SliderController@editImage');
    Route::post('/slider/delete', 'SliderController@delete');

    //daily gift
    Route::get('/daily-gift', 'DailyGiftController@index')->name('admin.daily-gift');
    Route::get('/daily-gift/edit', 'DailyGiftController@edit');
    Route::post('/daily-gift/confirmEdit', 'DailyGiftController@confirmEdit');

    //foods
    Route::get('/food', 'FoodController@index')->name('admin.food');
    Route::get('/food/{id}', 'FoodController@edit');
    Route::post('/food/confirmEdit', 'FoodController@confirmEdit');
    Route::post('/food/delete', 'FoodController@delete');


    //attack limit
    Route::get('/attack-limit', 'AttackLimitController@index')->name('admin.attack-limit');
    Route::get('/attack-limit/edit', 'AttackLimitController@edit');
    Route::post('/attack-limit/confirmEdit', 'AttackLimitController@confirmEdit');

    //worker
    Route::get('/worker', 'WorkerController@index')->name('admin.worker');
    Route::get('/worker/{id}', 'WorkerController@edit');
    Route::post('/worker/confirmEdit', 'WorkerController@confirmEdit');

    //player
    Route::get('/player', 'PlayerController@index')->name('admin.player');
    Route::get('/player/add', function () {
        return view('admin.player-add');
    });
    Route::post('/player/confirmAdd', 'PlayerController@confirmAdd');
    Route::get('/player/{id}', 'PlayerController@edit');
    Route::post('/player/confirmEdit', 'PlayerController@confirmEdit');

    //advertise
    Route::get('/advertise', 'AdvertiseController@index')->name('admin.advertise');
    Route::get('/advertise/add', function () {
        return view('admin.advertise-add');
    });
    Route::post('/advertise/confirmAdd', 'AdvertiseController@confirmAdd');
    Route::get('/advertise/{id}', 'AdvertiseController@edit');
    Route::post('/advertise/confirmEdit', 'AdvertiseController@confirmEdit');

    //daily message
    Route::get('/daily-message', 'DailyMessageController@index');
    Route::post('/daily-message/searchUser', 'DailyMessageController@searchUser');
    Route::post('/daily-message/add', 'DailyMessageController@add');
    Route::post('/daily-message/edit', 'DailyMessageController@edit');
    Route::post('/daily-message/delete', 'DailyMessageController@delete');

    //diamond-withdraw
    Route::get('/diamond-withdraw', 'DiamondWithdrawController@index');
    Route::get('/diamond-withdraw/{id}', 'DiamondWithdrawController@view');
    Route::post('/diamond-withdraw/accept', 'DiamondWithdrawController@accept');
    Route::post('/diamond-withdraw/reject', 'DiamondWithdrawController@reject');

    //inr-withdraw
    Route::get('/inr-withdraw', 'InrWithdrawController@index');
    Route::get('/inr-withdraw/{id}', 'InrWithdrawController@view');
    Route::post('/inr-withdraw/accept', 'InrWithdrawController@accept');
    Route::post('/inr-withdraw/reject', 'InrWithdrawController@reject');

    //withdraw limit
    Route::get('/withdraw-limit', 'WithdrawLimitController@index')->name('admin.withdraw-limit');
    Route::post('/withdraw-limit/edit', 'WithdrawLimitController@edit');
    Route::post('/withdraw-limit/confirmEdit', 'WithdrawLimitController@confirmEdit');

    //top-up
    Route::get('/top-up', 'TopUpController@index')->name('admin.top-up');
    Route::get('/top-up/add', function () {
        return view('admin.top-up-add');
    });
    Route::post('/top-up/confirmAdd', 'TopUpController@confirmAdd');

    Route::get('/top-up/{id}', 'TopUpController@edit');
    Route::post('/top-up/confirmEdit', 'TopUpController@confirmEdit');
    Route::post('/top-up/stock', 'TopUpController@stock');
    Route::post('/top-up/delete', 'TopUpController@delete');

    //top-up-order
    Route::get('/top-up-order', 'TopUpOrderController@index');
    Route::post('/top-up-order/accept', 'TopUpOrderController@accept');
    Route::post('/top-up-order/reject', 'TopUpOrderController@reject');

    //gem-diamond-ratio
    Route::get('/gem-diamond-ratio', 'GemDiamondRatioController@index')->name('admin.gem-diamond-ratio');
    Route::post('/gem-diamond-ratio/update', 'GemDiamondRatioController@update');

    Route::get('/dashboard', 'AdminHomeController@root')->name('admin.new-dashboard');
    Route::post('/dashboard/chat', 'AdminHomeController@chat');
    Route::post('/dashboard/site', 'AdminHomeController@site');
    Route::get('/dashboard/active-users', 'AdminHomeController@activeUser');
    Route::get('/dashboard/online-users', 'AdminHomeController@onlineUser');
    Route::get('/dashboard/free-membership-player', 'AdminHomeController@freeMembershipPlayer');
    Route::get('/dashboard/medium-membership-player', 'AdminHomeController@mediumMembershipPlayer');
    Route::get('/dashboard/upgrade-membership-player', 'AdminHomeController@upgradeMembershipPlayer');
    Route::get('/dashboard/recent-registered-users', 'AdminHomeController@recentRegisteredUser');
    Route::get('/dashboard/blocked-users', 'AdminHomeController@blockedUser');

    //buy diamonds limit
    Route::get('/buy-diamonds-limit', 'BuyDiamondsLimitController@index')->name('admin.buy-diamonds-limit');
    Route::get('/buy-diamonds-limit/add', 'BuyDiamondsLimitController@add');
    Route::post('/buy-diamonds-limit/edit', 'BuyDiamondsLimitController@edit');

    //buy diamonds orders
    Route::get('/buy-diamonds-orders', 'BuyDiamondsOrdersController@index')->name('admin.buy-diamonds-orders');


    //inr deposit limit
    Route::get('/inr-deposit-limit', 'InrDepositLimitController@index')->name('admin.inr-deposit-limit');
    Route::get('/inr-deposit-limit/edit', 'InrDepositLimitController@edit');
    Route::post('/inr-deposit-limit/confirmEdit', 'InrDepositLimitController@confirmEdit');

    //tournament
    Route::get('/tournament', 'TournamentController@index')->name('admin.tournament');
    Route::get('/tournament/add', 'TournamentController@add');
    Route::post('/tournament/confirmAdd', 'TournamentController@confirmAdd');
    Route::get('/tournament/{id}', 'TournamentController@edit');
    Route::post('/tournament/confirmEdit', 'TournamentController@confirmEdit');
    Route::post('/tournament/delete', 'TournamentController@deleteId');
    
      Route::get('/tournament/room-info/{id}', 'TournamentController@roomInfo');
    Route::post('/tournament/set-room-info', 'TournamentController@setRoomInfo');

    //tournament-register
    Route::get('/tournament-register', 'TournamentRegisterController@index')->name('admin.tournament-register');
    Route::get('/tournament-register/edit/{id}', 'TournamentRegisterController@edit');
    Route::get('/tournament-register/pay/{id}', 'TournamentRegisterController@pay');
    
    Route::post('/tournament-register/confirmPay', 'TournamentRegisterController@confirmPay');
    
    //tournament-corners
    Route::get('/tournament-corners', 'TournamentCornersController@index')->name('admin.tournament-corners');
    Route::get('/tournament-corners/{id}', 'TournamentCornersController@edit');
    Route::post('/tournament-corners/confirmEdit', 'TournamentCornersController@confirmEdit');
    Route::post('/tournament-corners/delete', 'TournamentCornersController@delete');
    
    //inr deposit orders
    Route::get('/inr-deposit-orders', 'InrDepositOrdersController@index')->name('admin.inr-deposit-orders');
    Route::post('/inr-deposit-orders/delete', 'InrDepositOrdersController@delete');
    Route::post('/inr-deposit-orders/approve', 'InrDepositOrdersController@approve');



    //Add routes before this line only
    // Route::get('/{any}', 'HomeController@index');    

    Route::get('/index', 'AdminHomeController@index')->name('admin.dashboard');
    Route::get('/', 'AdminHomeController@root')->name('admin.dashboard');
});
