<?php
Route::group(['prefix' => 'admin','middleware' => ['role:super-admin|admin']], function () {
});
