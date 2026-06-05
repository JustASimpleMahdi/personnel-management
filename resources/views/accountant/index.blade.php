<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>پنل مسئول خرید</title>

    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --main-pink: #ed82bd;
            --box-shadow: 0 10px 25px rgba(237, 130, 189, 0.5);
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'BYekan', sans-serif;
            background: #d1d1d1;
        }

        .screen {
            min-height: 100svh;
            width: 100%;
            background: linear-gradient(180deg, var(--main-pink) 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .header-container {
            width: 100%;
            max-width: 330px;
            margin: 0 auto 25px auto;
        }


        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-icon {
            width: 35px;
            height: auto;
        }


        .hr-line {
            width: 60%;
            height: 2px;
            background: #444;
            margin: 0 auto;
            border-radius: 2px;
        }


        .card, .announcement-box, .wide-card {
            box-shadow: 0 10px 15px rgba(237, 130, 189, 0.4) !important;
            border: 2px solid #ed82bd !important;
            background: #fff !important;
        }

        .wide-card {
            margin-top: 20px;
            width: 100%;
            max-width: 330px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            flex-direction: flex-start;
            align-items: center;
            padding: 0 20px;
            cursor: pointer;
        }

        .wide-card img {
            width: 45px;
            height: 45px;
            margin-left: 15px;
        }

        .wide-card span {
            font-size: 18px;
            color: #333;
            font-weight: 700;
            flex-grow: 1;
            text-align: center;
            margin-left: 45px;
        }

        .screen {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }


        .announcement-section {
            width: 100%;
            max-width: 330px;
            margin-bottom: 30px;
        }

        .announcement-box {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--box-shadow);
            border: 2px solid var(--main-pink);
            text-align: right;
        }

        .grid-container {
            display: grid;
            grid-template-columns:1fr 1fr;
            gap: 20px;
            width: 100%;
            max-width: 330px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: var(--box-shadow);
            border: 1px solid #eee;
            text-align: center;
        }

        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .card span {
            font-size: 16px;
            color: #555;
        }

        .home-icon {
            margin-top: auto;
            padding-top: 40px;
            padding-bottom: 20px;
        }

        .home-icon img {
            width: 60px;
            height: 60px;
        }

        @media (min-width: 520px) {
            .screen {
                max-width: 420px;
                margin: 24px auto;
                border-radius: 40px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, .25);
            }
        }
    </style>
    <style>
        /* بخش اسلایدر اصلی - عرض ثابت و ریسپانسیو */
        .announcement-section {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
            position: relative;
            user-select: none;
            direction: rtl;
            margin-bottom: 40px;
        }

        /* عنوان بخش (اعلان ها) */
        .section-title {
            text-align: right;
            margin-bottom: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            color: #2c2c2c;
            letter-spacing: -0.2px;
            padding-right: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title span {
            background: #fff0f3;
            padding: 4px 14px;
            border-radius: 40px;
            font-size: 0.75rem;
            color: var(--main-pink);
            font-weight: 500;
        }

        /* ظرف اسلایدر (viewport) */
        .slider-container {
            position: relative;
            width: 100%;

            border-radius: 28px;
            touch-action: pan-y pinch-zoom;
        }

        .slider-container > div {
            overflow: hidden;
        }

        /* ترک اصلی اسلایدر */
        .slider-track {
            display: flex;
            flex-direction: row;
            transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            will-change: transform;
            cursor: grab;
        }

        .slider-track:active {
            cursor: grabbing;
        }

        /* هر اسلاید */
        .announcement-box {
            flex: 0 0 100%;
            background: #fff;
            border-radius: 28px;
            padding: 22px 20px;
            box-shadow: var(--box-shadow);
            border: 2px solid var(--main-pink);
            text-align: right;
            transition: all 0.2s;
            margin: 0;
        }

        /* محتوای داخلی باکس */
        .announcement-title {
            font-weight: 800;
            font-size: 1.35rem;
            margin-bottom: 12px;
            color: #1e1e2f;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .announcement-desc {
            font-size: 0.95rem;
            line-height: 1.55;
            color: #4a4a5a;
            word-break: break-word;
        }

        /* دکمه‌های ناوبری */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            background: white;
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            border: 1px solid rgba(232, 62, 111, 0.3);
            z-index: 12;
            backdrop-filter: blur(2px);
        }

        .slider-nav:hover {
            background: var(--main-pink);
            border-color: var(--main-pink);
        }

        .slider-nav:hover svg {
            stroke: white;
        }

        .slider-nav svg {
            width: 20px;
            height: 20px;
            stroke: var(--main-pink);
            stroke-width: 2.2;
            fill: none;
            transition: 0.2s;
        }

        .nav-prev {
            right: -14px;
        }

        .nav-next {
            left: -14px;
        }

        /* در RTL، آیکون‌ها را برعکس می‌کنیم */
        .announcement-section .nav-prev svg path {
            d: path("M9 18l6-6-6-6");
        }

        .announcement-section .nav-next svg path {
            d: path("M15 18l-6-6 6-6");
        }

        @media (max-width: 500px) {
            .nav-prev {
                right: -8px;
                width: 34px;
                height: 34px;
            }

            .nav-next {
                left: -8px;
                width: 34px;
                height: 34px;
            }
        }

        /* نقطه‌های نشانگر */
        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 22px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #d9b2be;
            border-radius: 10px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .dot.active {
            width: 26px;
            background: var(--main-pink);
            box-shadow: 0 0 0 2px rgba(232, 62, 111, 0.2);
        }

        /* حالت غیرفعال دکمه‌ها */
        .nav-disabled {
            opacity: 0.35;
            pointer-events: none;
            cursor: default;
        }

        /* بهبود نمایش در موبایل */
        @media (max-width: 480px) {
            .announcement-box {
                padding: 18px 16px;
            }

            .announcement-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
<main class="screen">

    <div class="header-container">
        <div class="header-top">
            <div
                style="font-size: 22px; color:#333; font-weight:600;  text-align:center; width:100%; margin-right: 40px;">
                پنل {{ __('role.key.'.auth()->user()->role->key->value) }}</div>
            <a href="{{ route('auth.profile') }}"><img src="{{ asset('images/Profile.png') }}" class="profile-icon"
                                                       alt="پروفایل"></a>
        </div>
        <div class="hr-line"></div>
    </div>


    @include('panel.partials.announcemnts')

    <div class="grid-container">
        <a href="{{ route('reports.index') }}" class="card"><img src="{{ asset('images/Show.png') }}" alt="ایجاد"><span>وضعیت گزارشات</span></a>
        <a href="{{ route('reports.create') }}" class="card"><img src="{{ asset('images/Document.png') }}"
                                                                  alt="گزارش"><span>گزارش جدید</span></a>
        <a href="{{ route('work-hours.index') }}" class="card"><img src="{{ asset('images/Time Square.png') }}"
                                                                    alt="کاربران"><span>ثبت ساعات کاری </span></a>
        <a href="{{ route('suggestions.index') }}" class="card"><img src="{{ asset('images/Chat.png') }}"
                                                                     alt="نظرات"><span>نظرات و پیشنهادات</span></a>
    </div>
    <a href="{{ route('accountant.salaries.index') }}" class="wide-card">
        <img src="{{ asset('images/Wallet.png') }}" alt="حقوق"/>
        <span>حقوق و دستمزد</span>
    </a>

</main>
@stack('scripts')
</body>
</html>
