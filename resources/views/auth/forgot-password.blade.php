<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>فراموشی رمزعبور</title>

    <style>
        @font-face{
            font-family:'BYekan';
            src:url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight:700;
        }

        :root{
            --main-pink:#ed82bd;
        }

        *{box-sizing:border-box;}
        html,body{height:100%;margin:0;font-family:'BYekan',sans-serif;background:#d1d1d1;}

        .screen{
            min-height:100svh;
            width:100%;
            background:linear-gradient(180deg,var(--main-pink) 0%,#ffffff 100%);
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:20px;
        }

        .box{
            margin-top:120px;
            background:#ffffff;
            width:100%;
            max-width:330px;
            padding:55px 30px;
            border-radius:24px;
            border:2px solid var(--main-pink);
            box-shadow: 0 10px 40px -5px rgba(237,130,189,0.8), 0 0 20px rgba(237,130,189,0.4);
            text-align:center;
        }

        .text{
            color:#444;
            font-size:22px;
            line-height:2.4;
            margin-bottom:35px;
        }

        .btn{
            background:var(--main-pink);
            color:#ffffff;
            border:none;
            border-radius:14px;
            padding:14px 50px;
            font-size:20px;
            font-family:inherit;
            cursor:pointer;
            box-shadow: 0 4px 15px rgba(237,130,189,0.6);
        }

        @media (min-width:520px){
            .screen{
                max-width:420px;
                margin:24px auto;
                border-radius:40px;
                box-shadow:0 15px 35px rgba(0,0,0,.25);
            }
        }
    </style>
</head>

<body>
<main class="screen">
    <div class="box">
        <div class="text">
            در صورت فراموشی رمزعبور<br>
            به مدیریت فروشگاه<br>
            مراجعه کنید
        </div>
        <a href="{{ route('login') }}" class="btn">بستن</a>
    </div>
</main>
</body>
</html>

