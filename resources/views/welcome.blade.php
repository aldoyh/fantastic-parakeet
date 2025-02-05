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
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                position: relative;
                overflow-x: hidden;
                color: #636b6f;
                font-family: 'Tajawal', sans-serif;
                font-weight: normal;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                position: relative;
                z-index: 2;
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
                position: relative;
                z-index: 1;
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #2d3748;
                padding: 0.7rem 1.5rem;
                font-size: 1em;
                font-weight: bold;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border-radius: 8px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                margin: 0.5rem;
                background: rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(12px) saturate(180%);
                -webkit-backdrop-filter: blur(12px) saturate(180%);
                box-shadow: 
                    0 4px 16px rgba(31, 38, 135, 0.07),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border: 2px solid transparent;
                background: 
                    linear-gradient(to right, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.12) 100%) padding-box,
                    linear-gradient(120deg, #ff2d20 0%, rgba(255,255,255,0.5) 50%, #ff2d20 100%) border-box;
                box-shadow: 
                    0 4px 16px rgba(31, 38, 135, 0.07),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.12),
                    0 0 0 2px rgba(255, 45, 32, 0.1);
            }

            .links > a:hover {
                transform: translateY(-2px);
                background: rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(12px) saturate(180%) brightness(105%);
                -webkit-backdrop-filter: blur(12px) saturate(180%) brightness(105%);
                border-color: rgba(255, 255, 255, 0.15);
                box-shadow: 
                    0 8px 24px rgba(31, 38, 135, 0.08),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.15);
                border: 2px solid transparent;
                background: 
                    linear-gradient(to right, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.18) 100%) padding-box,
                    linear-gradient(120deg, #ff2d20 0%, rgba(255,255,255,0.8) 50%, #ff2d20 100%) border-box;
                box-shadow: 
                    0 8px 24px rgba(31, 38, 135, 0.08),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.15),
                    0 0 0 2px rgba(255, 45, 32, 0.2);
            }

            .links > a::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(
                    120deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.1) 10%,
                    rgba(255, 255, 255, 0.2) 50%,
                    rgba(255, 255, 255, 0.1) 90%,
                    transparent 100%
                );
                transform: translateX(-100%) skewX(-15deg);
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .links > a:hover::before {
                transform: translateX(100%) skewX(-15deg);
            }

            .links > a::after {
                content: '';
                position: absolute;
                inset: -4px;
                border-radius: 12px;
                background: linear-gradient(120deg, #ff2d20 0%, transparent 50%, #ff2d20 100%);
                opacity: 0;
                z-index: -1;
                transition: opacity 0.3s ease;
            }

            .links > a:hover::after {
                opacity: 0.15;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .scene {
                position: fixed;
                top: 0;
                width: 100vw;
                height: 100vh;
                z-index: 0;
                background: radial-gradient(
                    circle at center,
                    rgba(255,255,255,0.3) 0%,
                    rgba(255,255,255,0.1) 45%,
                    transparent 70%
                );
                backdrop-filter: blur(30px) saturate(120%);
                -webkit-backdrop-filter: blur(30px) saturate(120%);
            }

            .plane {
                opacity: 0.6;
                mix-blend-mode: overlay;
                position: absolute;
                width: 80vw;
                height: 80vh;
                transform-style: preserve-3d;
                background: linear-gradient(45deg, rgba(255,45,32,0.1), rgba(255,255,255,0.3));
                border-radius: 15px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.1);
                backdrop-filter: blur(10px);
            }

            /* Specific styling for each plane, e.g., */
            .plane1 {
                transform: rotateX(30deg) rotateY(15deg) translateZ(100px);
            }

            .plane2 {
                transform: rotateX(60deg) rotateY(45deg) translateZ(100px);
            }

            .plane3 {
                transform: rotateX(90deg) rotateY(75deg) translateZ(100px);
            }

            .aurora-effect {
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 0;
                overflow: hidden;
            }

            .aurora-effect .color {
                position: absolute;
                filter: blur(150px);
                opacity: 0.5;
            }

            .aurora-effect .color:nth-child(1) {
                background: #ff2d20;
                width: 600px;
                height: 600px;
                top: -50%;
                left: 25%;
                animation: aurora-move 15s infinite;
            }

            .aurora-effect .color:nth-child(2) {
                background: #00ff88;
                width: 500px;
                height: 500px;
                bottom: -10%;
                right: 25%;
                animation: aurora-move 20s infinite reverse;
            }

            .aurora-effect .color:nth-child(3) {
                background: #2d3748;
                width: 300px;
                height: 300px;
                bottom: 50%;
                left: 50%;
                animation: aurora-move 25s infinite;
            }

            @keyframes aurora-move {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                }
                50% {
                    transform: translate(-15%, 15%) rotate(180deg);
                }
                100% {
                    transform: translate(0, 0) rotate(360deg);
                }
            }

            .scene {
                background: none;
            }
        </style>
    </head>
    <body>
        <div class="aurora-effect">
            <div class="color"></div>
            <div class="color"></div>
            <div class="color"></div>
        </div>
        <div class="scene">
            <div class="plane plane1"></div>
            <div class="plane plane2"></div>
            <div class="plane plane3"></div>
        </div>
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
                    <svg width="176" height="51" viewBox="0 0 176 51" xmlns="http://www.w3.org/2000/svg"><title>logo</title><path d="M67.057 11.723V34.67h8.362v3.958H62.605V11.723h4.452zm24.078 11.415v-2.42h4.219v17.91h-4.22v-2.422c-.567.897-1.374 1.602-2.42 2.114-1.044.512-2.096.768-3.154.768-1.368 0-2.62-.25-3.755-.749a8.782 8.782 0 0 1-2.923-2.056 9.549 9.549 0 0 1-1.896-2.998 9.613 9.613 0 0 1-.678-3.613c0-1.255.226-2.453.678-3.594a9.508 9.508 0 0 1 1.896-3.016 8.79 8.79 0 0 1 2.923-2.057c1.135-.5 2.387-.75 3.755-.75 1.058 0 2.11.257 3.155.77 1.045.512 1.852 1.217 2.42 2.113zm-.388 8.725a6.226 6.226 0 0 0 .388-2.19c0-.77-.13-1.5-.388-2.192a5.548 5.548 0 0 0-1.083-1.806 5.245 5.245 0 0 0-1.684-1.23c-.659-.307-1.388-.461-2.188-.461-.8 0-1.523.154-2.168.461-.645.308-1.2.718-1.664 1.23a5.276 5.276 0 0 0-1.064 1.806 6.489 6.489 0 0 0-.368 2.191c0 .769.122 1.5.368 2.19a5.27 5.27 0 0 0 1.064 1.807 5.29 5.29 0 0 0 1.664 1.23c.645.308 1.368.461 2.168.461s1.53-.153 2.188-.46a5.234 5.234 0 0 0 1.684-1.23 5.543 5.543 0 0 0 1.083-1.807zm7.936 6.764v-17.91h11.459v4.122h-7.24v13.788h-4.219zm26.75-15.489v-2.42h4.219v17.91h-4.22v-2.422c-.568.897-1.374 1.602-2.42 2.114-1.044.512-2.096.768-3.154.768-1.369 0-2.62-.25-3.755-.749a8.782 8.782 0 0 1-2.923-2.056 9.549 9.549 0 0 1-1.896-2.998 9.613 9.613 0 0 1-.678-3.613c0-1.255.225-2.453.678-3.594a9.508 9.508 0 0 1 1.896-3.016 8.79 8.79 0 0 1 2.923-2.057c1.135-.5 2.386-.75 3.755-.75 1.058 0 2.11.257 3.155.77 1.045.512 1.851 1.217 2.42 2.113zm-.388 8.725a6.226 6.226 0 0 0 .387-2.19c0-.77-.13-1.5-.387-2.192a5.548 5.548 0 0 0-1.084-1.806 5.245 5.245 0 0 0-1.684-1.23c-.658-.307-1.387-.461-2.187-.461-.8 0-1.523.154-2.168.461-.645.308-1.2.718-1.664 1.23a5.276 5.276 0 0 0-1.065 1.806 6.489 6.489 0 0 0-.368 2.191c0 .769.122 1.5.368 2.19a5.27 5.27 0 0 0 1.065 1.807 5.29 5.29 0 0 0 1.664 1.23c.645.308 1.368.461 2.168.461s1.53-.153 2.187-.46a5.234 5.234 0 0 0 1.684-1.23 5.543 5.543 0 0 0 1.084-1.807zm21.523-11.146h4.274l-6.926 17.91h-5.302l-6.926-17.91h4.274l5.303 13.715 5.303-13.715zm13.476-.46c5.746 0 9.664 5.055 8.928 10.972h-13.998c0 1.545 1.571 4.532 5.302 4.532 3.21 0 5.36-2.803 5.362-2.805l2.85 2.19c-2.548 2.702-4.635 3.943-7.903 3.943-5.84 0-9.797-3.668-9.797-9.416 0-5.2 4.09-9.416 9.256-9.416zm-5.059 7.859h10.112c-.031-.345-.579-4.532-5.086-4.532-4.507 0-4.993 4.187-5.026 4.532zm16.735 10.511V11.723h4.22v26.904h-4.22zM49.764 11.513a.8.8 0 0 1 .028.208v10.924a.796.796 0 0 1-.403.691l-9.234 5.279v10.463a.796.796 0 0 1-.403.69L20.478 50.787c-.044.026-.093.041-.14.058-.019.006-.036.017-.054.022a.812.812 0 0 1-.412 0c-.022-.006-.042-.018-.063-.026-.045-.015-.09-.03-.132-.054L.402 39.77A.796.796 0 0 1 0 39.078V6.306a.8.8 0 0 1 .028-.208c.006-.024.02-.045.028-.067.016-.042.03-.085.052-.124.015-.026.037-.047.054-.07.024-.032.044-.066.072-.094.023-.023.053-.04.079-.06.029-.022.055-.048.088-.067l.001-.001L10.04.106a.81.81 0 0 1 .8 0l9.638 5.509h.002c.032.02.058.046.088.068.026.02.055.037.078.06.028.028.048.062.072.093.018.024.04.045.055.071.022.039.036.082.052.124.008.022.021.043.028.067a.8.8 0 0 1 .027.208v20.469l8.032-4.591V11.721a.8.8 0 0 1 .027-.208c.007-.024.02-.044.029-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.07.024-.032.044-.066.072-.093.023-.023.052-.04.078-.06.03-.023.056-.05.089-.068v-.001l9.638-5.509a.808.808 0 0 1 .801 0l9.637 5.509h.001c.034.02.06.046.09.068.025.02.055.038.078.06.028.028.048.062.071.093.018.024.04.045.055.071.023.039.036.082.052.124.009.023.022.043.028.067zm-1.578 10.671V13.1l-3.373 1.928-4.658 2.663v9.084l8.03-4.591zm-9.637 16.433v-9.09l-4.584 2.598L20.88 39.54v9.175l17.669-10.1zM1.606 7.685v30.932l17.668 10.1v-9.174l-9.23-5.186-.002-.003-.004-.001c-.032-.018-.057-.044-.086-.066-.026-.02-.054-.036-.077-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.026-.044-.049-.06-.077l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.029-.03-.057-.038-.089v-.001c-.011-.038-.012-.078-.017-.117-.003-.03-.012-.059-.012-.09V12.275L4.98 9.613 1.606 7.685zm8.834-5.968l-8.027 4.59 8.027 4.588 8.028-4.589-8.028-4.589zm4.176 28.638l4.658-2.662V7.685l-3.372 1.928-4.659 2.663v20.007l3.373-1.928zM39.352 7.133l-8.028 4.588 8.028 4.589 8.027-4.589-8.027-4.588zm-.803 10.558l-4.659-2.663-3.372-1.928v9.084l4.658 2.663 3.373 1.928V17.69zm-18.473 20.47l11.775-6.674 5.886-3.336-8.022-4.586-9.237 5.28-8.418 4.812 8.016 4.504z" fill="#FF2D20" fill-rule="evenodd"/></svg>
                </div>
                <div class="title m-b-md text-red-600">
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/TextPlugin.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/CSSRulePlugin.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/BlurPlugin.min.js"></script>
            <script>
                // gsap.registerPlugin(BlurPlugin);
                gsap.to('.plane', {
                    duration: 5,
                    blur: 10,
                    repeat: -1,
                    yoyo: false,
                    ease: 'power1.in'
                });

                // aurora effect
                const planes = document.querySelectorAll('.plane');
                gsap.to(planes, {
                    yoyo: true,
                    duration: 10,
                    rotationY: 360,
                    rotationX: 360,
                    repeat: -1,
                    ease: 'none'
                });

                // logo animation
                const logo = document.querySelector('.title');
                gsap.from(logo, {
                    duration: 2.5,
                    opacity: 0,
                    y: -50,
                    ease: 'power4.out'
                });

                // links animation
                const links = document.querySelectorAll('.links > a');
                gsap.from(links, {
                    duration: 2.5,
                    opacity: 0,
                    y: 50,
                    ease: 'power4.out',
                    stagger: 0.1
                });

                // scene animation
                const scene = document.querySelector('.scene');
                gsap.from(scene, {
                    duration: 2.5,
                    opacity: 0,
                    ease: 'power4.out'
                });                

                // Add aurora animation
                const colors = document.querySelectorAll('.aurora-effect .color');
                colors.forEach((color, index) => {
                    gsap.to(color, {
                        duration: 15 + index * 5,
                        rotate: 360,
                        scale: 1.2,
                        x: "random(-25%, 25%)",
                        y: "random(-25%, 25%)",
                        repeat: -1,
                        ease: "none",
                        yoyo: true
                    });
                });

            </script>

    </body>
</html>
