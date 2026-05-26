<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>صفحه ورود</title>

    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan+ Bold.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --bg-gradient-top: #ed82bd;
            --bg-gradient-bottom: #ffffff;
            --btn-color: #ed82bd;
            --link-color: #de4aa7;
            --error-color: #ec0c04;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'BYekan', sans-serif;
            background: #d1d1d1;
        }

        .screen {
            min-height: 100svh;
            width: 100%;
            background: linear-gradient(
                180deg,
                var(--bg-gradient-top) 0%,
                var(--bg-gradient-bottom) 100%
            );
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .content {
            width: 100%;
            max-width: 320px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .content form{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        h1 {
            color: #333;
            font-size: 22px;
            line-height: 1.6;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ccc;
            text-align: center;
            font-family: 'BYekan', sans-serif;
            font-size: 16px;
            color: #777;
        }

        .error-message {
            color: var(--error-color);
            font-size: 13px;
            text-align: right;
            padding-right: 5px;
            margin-top: -10px;
        }

        .btn {
            background: var(--btn-color);
            color: #fff;
            border: 0;
            border-radius: 12px;
            padding: 15px;
            font-size: 20px;
            font-family: inherit;
            cursor: pointer;
            margin-top: 5px;
        }

        .link {
            color: var(--link-color);
            text-decoration: underline;
            font-size: 14px;
            margin-top: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        @media (min-width: 520px) {
            .screen {
                max-width: 420px;
                margin: 24px auto;
                border-radius: 40px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
</head>

<body>
<main class="screen">
    <section class="content">
        <h1>نام کاربری و رمز عبور خود را وارد کنید</h1>

        <form action="{{ route('login-submit') }}" method="post">
            @csrf
            <input name="username" value="{{ old('username') }}" type="text" placeholder="نام کاربری"/>
            @error('username')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <input name="password" type="password" placeholder="رمز عبور"/>
            @error('password')
            <div class="error-message">{{ $message }}</div>
            @enderror

            @error('login')
            <div class="error-message">{{ $message }}</div>
            @enderror

            <button class="btn">ورود</button>
        </form>

        <a href="{{ route('forgot-password') }}" class="link">فراموشی رمز عبور</a>
    </section>
</main>
</body>
</html>
