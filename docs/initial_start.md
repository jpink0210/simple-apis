## 進入點

public/index.php
是程式的啟動點
$app = require_once __DIR__.'/../bootstrap/app.php';
$app 就是這個應用程式，然後被 kernal 啟動
app/Http/Kernel.php
會啟動各個環境黨、config 資料夾、registerProvider(Provider 各種強大功能)、middleware、
設定路由app/Providers/RouteServiceProvider.php
最後會得到一個 response

## 可以操作的項目

app/Http/Kernel.php
HandleCors
ValidatePostSize
VerifyCsrfToken

protected $routeMiddleware = [

