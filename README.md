<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## 商城範例

此專案以商城服務形式呈現 **後端開發** 功能，猶如：**會員註冊**、**商品選購**、**購物車結帳**、**訂單核送**等等，以一個流程的方式呈現。內容尚不包括金流串接。下面將以功能面來條列實作內容。


#### 部署方式

以 AWS EC2 建立虛擬機，並且設置 RDS 佐以 Subnet Group 連線至 VPC 的 Private Subnets(兩台)。

#### 功能說明 

- MVC: ORM with both Eloquent and Facade\DB, Middlewares, Validators
- APIs: CRUD, Images Upload
- Services: notification, queue, observer
- auth: Laravel passport, Laravel breeze

#### 操作說明

###### 首頁

- 此 Demo 專案, 點擊左上角 **Admin** 可前往**後台**
- 點擊右上角可以進入**會員中心**
- 訂單送出成功會新增通知，點擊通知內的文字訊息使**已讀**
- 點擊商品「加入購物車」購物

![Alt text](/public/images/image.png)

###### 會員中心

含三則頁籤，會員首頁/購物車/訂單
- 購物車頁籤：點選結帳後，請至 **「首頁->後台」** 核送才會**出貨**
- 訂單頁籤：可以檢視出貨狀況

![Alt text](/public/images/image-1.png)

###### Admin 後台管理

含兩則頁籤，產品管理 / 訂單管理
- 產品管理：產品以 **Seeder** 自動初始化，尚未開放 API 新增。上傳圖片為安全顧慮關閉，可以 Local 測試。
- 訂單管理：Demo 的形式，以會員送出訂單之後，Admin 核送之模擬。點擊「核送」之後，可以前往 **「會員中心->我的訂單」** 查看

![Alt text](/public/images/image-2.png)

