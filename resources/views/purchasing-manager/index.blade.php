<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>پنل مسئول خرید</title>

    <style>
        @font-face{
            font-family:'BYekan';
            src:url('{{ asset('fonts/BYekan+ Bold.ttf') }}') format('truetype');
            font-weight:700;
        }

        :root{
            --main-pink:#ed82bd;
            --box-shadow: 0 10px 25px rgba(237,130,189,0.5);
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

        .header-container{
            width: 100%;
            max-width: 330px;
            margin: 0 auto 25px auto;
        }


        .header-top{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-icon{
            width: 35px;
            height: auto;
        }


        .hr-line{
            width: 60%;
            height: 2px;
            background: #444;
            margin: 0 auto;
            border-radius: 2px;
        }


        .card, .announcement-box {
            box-shadow: 0 10px 15px rgba(237, 130, 189, 0.4) !important;
            border: 2px solid #ed82bd !important;
            background: #fff !important;
        }
        .screen{
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }


        .announcement-section{width:100%; max-width:330px; margin-bottom:30px;}
        .announcement-box{
            background:#fff; border-radius:20px; padding:20px;
            box-shadow:var(--box-shadow); border:2px solid var(--main-pink);
            text-align:right;
        }

        .grid-container{
            display:grid; grid-template-columns:1fr 1fr; gap:20px;
            width:100%; max-width:330px;
        }

        .card{
            background:#fff; border-radius:20px; padding:20px;
            display:flex; flex-direction:column; align-items:center;
            box-shadow:var(--box-shadow); border:1px solid #eee;
            text-align:center;
        }

        .card img{width:50px; height:50px; margin-bottom:10px;}
        .card span{font-size:16px; color:#555;}

        .home-icon{margin-top:auto; padding-top:40px; padding-bottom:20px;}
        .home-icon img{width:60px; height:60px;}

        @media (min-width:520px){
            .screen{max-width:420px; margin:24px auto; border-radius:40px; box-shadow:0 15px 35px rgba(0,0,0,.25);}
        }
    </style>
</head>

<body>
<main class="screen">

    <div class="header-container">
        <div class="header-top">
            <div style="font-size: 22px; color:#333; font-weight:600;  text-align:center; width:100%; margin-right: 40px;">پنل مسئول خرید</div>
            <img src="{{ asset('images/Profile.png') }}" class="profile-icon" alt="پروفایل" >
        </div>
        <div class="hr-line"></div>
    </div>



    <div class="announcement-section">
        <div style="text-align:right; margin-bottom:10px; color:#333;">اعلان ها:</div>
        <div class="announcement-box">
            <div style="font-weight:bold; margin-bottom:10px;">فردا نیستیم</div>
            <div style="font-size:14px; color:#666;">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است...</div>
        </div>
    </div>

    <div class="grid-container">
        <a href="{{ route('reports.index') }}" class="card"><img src="{{ asset('images/Show.png') }}" alt="ایجاد"><span>وضعیت گزارشات</span></a>
        <a href="{{ route('reports.create') }}" class="card"><img src="{{ asset('images/Document.png') }}" alt="گزارش"><span>گزارش جدید</span></a>
        <div class="card"><img src="{{ asset('images/Time Square.png') }}" alt="کاربران"><span>ثبت ساعات کاری </span></div>
        <div class="card"><img src="{{ asset('images/Chat.png') }}" alt="نظرات"><span>نظرات و پیشنهادات</span></div>
    </div>
</main>
</body>
</html>
