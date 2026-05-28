<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>پنل مدیریت</title>

    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --pink: hsl(326, 100%, 65%);
            --btn: #ed82bd;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'BYekan', Tahoma, sans-serif;
            background: #d1d1d1;
        }

        .screen {
            min-height: 100svh;
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(180deg, var(--pink) 0%, #fff 100%);
            position: relative;
            overflow: hidden;

            display: grid;
            place-items: center;
            padding: 24px 16px;
        }

        @media (min-width: 520px) {
            .screen {
                max-width: 420px;
                margin: 24px auto;
                border-radius: 40px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }
        }

        .bg-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
            pointer-events: none;
            user-select: none;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: #fff;

            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 28px;
        }

        .title {
            margin: 0;
            font-size: clamp(26px, 7vw, 34px);
            line-height: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 700;
        }

        .btn {
            background: var(--btn);
            color: #fff;
            border: 0;
            border-radius: 14px;
            padding: 14px 64px;
            font-size: 22px;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<main class="screen">
    <img class="bg-image" src="{{ asset('images/5690.jpg') }}" alt="" />

    <section class="content">
        <h1 class="title">به پنل مدیریتی<br />فروشگاه بهاری<br />خوش آمدید</h1>
        <a href="{{ route('login') }}" class="btn" type="button">ورود</a>
    </section>
</main>
</body>
</html>
