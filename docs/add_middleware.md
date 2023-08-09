php artisan make:middleware CheckDirtyWord
這個設定是 class 名稱
檔案會在 middleware 的資料夾下面

寫好之後加到
kernal.php
protected $routeMiddleware = 下面
例如
    'check.dirty' => \Illuminate\Http\Middleware\CheckDirtyWord::class,
然後在 route/web.php
```
Route::group(['middleware' => 'check.dirty'], function() {
    Route::resource ...    
})
```
