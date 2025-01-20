<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>لارافيل</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Tajawal:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Tajawal', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">الرئيسية</a>
                    @else
                        <a href="{{ route('login') }}">تسجيل الدخول</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">تسجيل جديد</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    لارافيل
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">التوثيق</a>
                    <a href="https://laracasts.com">دروس مرئية</a>
                    <a href="https://laravel-news.com">الأخبار</a>
                    <a href="https://blog.laravel.com">المدونة</a>
                    <a href="https://nova.laravel.com">نوفا</a>
                    <a href="https://forge.laravel.com">فورج</a>
                    <a href="https://github.com/laravel/laravel">جيت هب</a>
                </div>
            </div>
        </div>
    </body>
</html>
