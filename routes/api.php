<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\LicenseController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\SpecialityController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PrivacyManagementController;

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('verify-email', [RegisterController::class, 'verify_email']);
Route::post('forgot-password', [UserController::class, 'forgot_password_email']);
Route::post('create-new-password', [UserController::class, 'create_new_password']);
Route::post('all-users', [UserController::class, 'all_users']);
Route::post('user-fetch', [UserController::class, 'fetch']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('notification-test', [LoginController::class, 'notification_test']);

    Route::prefix('privacy')->group(function () {
        Route::post('fetch', [PrivacyManagementController::class, 'fetch']);
        Route::post('update', [PrivacyManagementController::class, 'update_privacy']);
        Route::post('check', [PrivacyManagementController::class, 'check_privacy_of_user']);
    });

    Route::prefix('post')->group(function () {
        Route::post('create', [PostController::class, 'store']);
        Route::post('show', [PostController::class, 'show']);
        Route::post('user', [PostController::class, 'user_post']);
        Route::post('assets', [PostController::class, 'assets']);
        Route::post('delete', [PostController::class, 'destroy']);
        Route::post('fetch/post', [PostController::class, 'fetch_post']);
        Route::post('fetch/all', [PostController::class, 'fetch_all']);
        Route::post('fetch/friends', [PostController::class, 'fetch_friends']);
        Route::post('fetch/like', [PostController::class, 'fetch_like']);
        Route::post('fetch/comment', [PostController::class, 'fetch_comment']);
        Route::post('fetch/all/show-more', [PostController::class, 'Show_two_more']);
        Route::post('fetch/my-posts/show-more', [PostController::class, 'my_posts']);
        Route::post('report/store', [PostController::class, 'create_report']);
    });
    Route::prefix('comment')->group(function () {
        Route::post('store', [CommentController::class, 'store']);
        Route::post('fetch/reply', [CommentController::class, 'fetch_reply']);
        Route::post('show', [CommentController::class, 'show']);
        Route::post('update', [CommentController::class, 'update']);
        Route::post('delete', [CommentController::class, 'delete']);
    });

    Route::prefix('like')->group(function () {
        Route::post('store', [LikeController::class, 'Like']);
        Route::post('fetch', [LikeController::class, 'fetch']);
    });
    Route::prefix('license')->group(function () {
        Route::post('store', [LicenseController::class, 'store']);
        Route::post('update', [LicenseController::class, 'update']);
        Route::post('fetch', [LicenseController::class, 'fetch']);
        Route::post('delete', [LicenseController::class, 'delete']);
    });
    Route::prefix('product')->group(function () {
        Route::post('categories', [ProductController::class, 'categories']);
        Route::post('store', [ProductController::class, 'store']);
        Route::post('fetch-all', [ProductController::class, 'fetch_all']);
        Route::post('fetch', [ProductController::class, 'fetch']);
        Route::post('delete', [ProductController::class, 'delete']);
    });

    Route::post('unlike', [LikeController::class, 'Unlike']);
    Route::prefix('gallery')->group(function () {
        Route::post('all', [GalleryController::class, 'AllMedia']);
        Route::post('image', [GalleryController::class, 'AllImages']);
        Route::post('video', [GalleryController::class, 'AllVideo']);
        Route::post('audio', [GalleryController::class, 'AllAudio']);
    });
    Route::prefix('speciality')->group(function () {
        Route::post('fetch', [SpecialityController::class, 'fetch']);
        Route::post('update', [SpecialityController::class, 'update']);
        Route::post('store', [SpecialityController::class, 'store']);
    });

    Route::prefix('friend')->group(function () {
        Route::post('fetch', [FriendController::class, 'friend']);
        Route::post('marketplace', [FriendController::class, 'marketplace']);
        Route::post('all-requests', [FriendController::class, 'friend_request']);
        Route::post('send-request', [FriendController::class, 'send_request']);
        Route::post('cancel-request', [FriendController::class, 'cancel_request']);
        Route::post('remove', [FriendController::class, 'remove_friend']);
        Route::post('accept-reject', [FriendController::class, 'accept_reject']);
        Route::post('status', [FriendController::class, 'status']);
        Route::post('pending-requests', [FriendController::class, 'pendingRequests']);
    });
    Route::prefix('block')->group(function () {
        Route::post('store', [BlockController::class, 'block']);
        Route::post('fetch', [BlockController::class, 'fetch']);
        Route::post('remove', [BlockController::class, 'remove']);
    });
    Route::prefix('other-user')->group(function () {
        Route::post('fetch/long-lat', [UserController::class, 'fetch_long_lat']);

    });
    Route::prefix('user')->group(function () {
        Route::post('fetch', [UserController::class, 'fetch']);
        Route::post('store_device ', [UserController::class, 'store_device']);
        Route::post('remove_device ', [UserController::class, 'remove_device']);
        Route::post('update/password', [UserController::class, 'update_password']);
        Route::post('detail', [UserController::class, 'details']);
        Route::post('search', [UserController::class, 'search']);
        Route::post('update-profile', [UserController::class, 'Update_profile']);
        Route::post('chat', [UserController::class, 'Chats']);
        Route::post('store/chat', [UserController::class, 'Store_Chat']);
        Route::post('update-profile-photo', [UserController::class, 'change_profile_photo']);
        Route::post('update-cover-photo', [UserController::class, 'change_cover_photo']);
        Route::post('update', [UserController::class, 'Update_user']);
        Route::post('read-all-messages', [UserController::class, 'Read_at']);
        Route::post('notifications', [NotificationController::class, 'Notification']);
        Route::post('pending-notifications', [NotificationController::class, 'pending']);
        Route::post('notification/mark-as-read', [NotificationController::class, 'markAsRead']);
        Route::post('all-notifications/mark-as-read', [NotificationController::class, 'allMarkAsRead']);
        Route::post('delete-account', [UserController::class, 'delete_account']);
        Route::post('report', [UserController::class, 'report_user']);
        Route::post('update-location',[UserController::class ,"update_location"]);
    });
});

