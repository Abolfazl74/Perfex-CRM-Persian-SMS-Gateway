# Perfex-CRM-Persian-SMS-Gateway
Perfex CRM Persian SMS Gateway | درگاه پیامکی فارسی پرفکس

این ماژول جهت استفاده ی کاربران ایرانی از درگاه پیامکی فارسی در سامانه جامع پرفکس(Perfex CRM) طراحی شده است.

این ماژول به صورت پیش فرض برای وب سرویس پنل پارس گرین(Pars Green) طراحی شده است اما شما به راحتی می توانید با استفاده از مفاهیم زیر برای هر پنل پیامکی ایرانی استفاده نمایید.
در صورت تمایل جهت استفاده و خریداری پنل پیامکی از پارس گرین و همچنین حمایت از توسعه دهنده این ماژول از طریق [این لینک](http://login.parsgreen.com/account/signup?uc=1r6i) اقدام به خرید پنلخ ود نمایید.

# Install/نصب:

جهت نصب ماژول ابتدا فولدر `stuxan_parsgreen` را zip کنید و سپس فایل zip   را از بخش ماژول های سامانه آپلود نمایید و سپس بعد از فعال سازی آن در بخش تنظیمات:

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_2.png)

مطابق تصویر زیر اطلاعات وب سرویس خود را وارد نمایید:

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_1.png)

جهت اطمینان میتوانید از ابزار تست پیامک موجود در پرفکس در بخش تنظیمات استفاده نمایید.
همچنین جهت پیکربندی ارسال پیامک خودکار در قسمت پایین تنظیمات درگاه(بخشی که تنظیمات درگاه پیامکی خود را وارد کردید) تعدادی trigger وجود دارد که مطابق تصویر زیر به دلخواه خود می توانید تنظیم نمایید:

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_3.png)

---

# Custom Gateway/درگاه های دیگر:

پس از نصب و مطالعه ی راهنمای وب سرویس درگاه مورد نظر خود به آدرس زیر در هاست خود مراجعه نمایید:

`/modules/stuxan_parsgreen/libraries/`

در این بخش دو فایل اصلی جهت تغییرات برای درگاه های پرداخت متفاوت وجود دارد. در فایل اول با نام `sms_parsgreen.php` مطابق تصویر یک کلاس با نام `SendSms_Req` وجود دارد که پارامترهای ورودی وب سرویس را مشخص می کند که باید مطابق وب سرویس مئرد نظر خود آن ها را تغییر دهدید.

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_4.png)

همچنین پارامترهای آدرس API که جهت تفکیک و سهولت ارسال درخواست های مختلف استفاده میشود نیز در فایل `sms_parsgreen.php` ینز مشخص است که باید مطابق درگاه مورد نظر خود آن را ویرایش کنید:

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_5.png?)

به عنوان مثال در درگاه پارس گرین آدرس ارسال پیامک تکی(بعد از آدرس اصلی API) `Message/SendSms` است.

تابع `call` موجود در فایل `StuXanApi.php` معمولا به صورت خام توسط درگاه های مختلف به کاربران ارائه می شود که عموما به یک شکل هستند اما در صورت وجود تفاوت در متد ارسال میتوانید پارامتر ها را صورت دلخواه ویرایش نمایید. این تابع نسخه جنریک شده توابع معمولی درگاه های مختلف است و بهتر است به جای جایگزینی کامل تابع فقط پارامتر های متفاوت را ویرایش کنید. نکته مهم در این تابع مقدار ثابت ورژن API است که در تمام درگاه ها وجود ذارد و عموما مشابه نیستند.

![alt text](https://file.stuxan.ir/stuxan_parsgreen_sms_6.jpg)

مقداری که در تصویر مشخص شده است ورژن آخرین نسخه API درگاه پیامکی مورد استفاده ما می باشد که شما نیز باید مطابق با درگاه مورد نظر خود وایرایش نمایید.

`نکته: در صورتی که این پارامتر را به همراه لینک در بخش تنظیمات ماژول وارد کرده اید پارامتر موجود در تصویر بالا باید خالی بماند. به عنوان مثال اگر آدرس لینک API در تنظیمات ماژول را http://sms.parsgreen.ir/Apiv2/ وارد کرده اید این خط کد به صورت زیر ویرایش می شود:
$this->url = $this->url . $urlpath;`

