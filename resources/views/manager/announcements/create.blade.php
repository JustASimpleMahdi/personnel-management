<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اعلانیه جدید</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
        }

        * {
            box-sizing: border-box;
            font-family: 'BYekanBold', 'Tahoma', sans-serif;
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            min-height: 100vh;
        }

        .screen {
            width: 375px;
            height: 750px;
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 40%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 0;
        }

        /* کارت سفید مرکزی */
        .main-card {
            width: 90%;
            height: 85%;
            background: #fff;
            border: 2px solid #ed82bd;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(237, 130, 189, 0.25);
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            position: relative;
        }

        .input-group {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        label {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* استایل فیلدها مطابق کدهای قبلی */
        /* استایل اصلاح شده برای فیلدها با سایه غلیظ ولی ظریف */
        .input-field {
            width: 100%;
            border: 1.75px solid #ed82bd;
            border-radius: 12px;
            padding: 10px;
            font-size: 16px;
            outline: none;
            color: #444;
            background-color: #fff;

            /* ایجاد سایه چند لایه برای ظرافت و غلظت همزمان */
            box-shadow: 0 10px 15px rgba(237, 130, 189, 0.15), /* لبه ظریف نزدیک */ 0 8px 15px rgba(237, 130, 189, 0.1); /* پخش شدن نرم در فاصله دورتر */

            transition: all 0.3s ease; /* برای نرم شدن تغییرات در هنگام کلیک */
        }

        /* افکت هنگام کلیک روی باکس (Focus) */
        .input-field:focus {
            box-shadow: 0 4px 8px rgba(237, 130, 189, 0.25),
            0 12px 20px rgba(237, 130, 189, 0.15);
            border-color: #d66ba3; /* کمی تیره‌تر شدن مرز هنگام تایپ */
        }


        /* برای شرح اعلانیه که بزرگتر است */
        textarea.input-field {
            height: 150px;
            resize: none;
        }

        /* دکمه ثبت و خروج در پایین کارت */
        .submit-btn {
            background: #ed82bd;
            color: white;
            border: none;
            padding: 8px 25px;
            border-radius: 15px;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 10px rgba(237, 130, 189, 0.4);
            transition: all 0.2s;
            font-family: 'BYekanBold';
        }

        .submit-btn:active {
            transform: translateX(-50%) scale(0.95);
            background: #d66ba3;
        }
    </style>
</head>
<body>

<div class="screen">
    <form action="{{ route('manager.announcements.store') }}" method="post" class="main-card">
        @csrf

        <!-- فیلد عنوان -->
        <div class="input-group">
            <label>عنوان:</label>
            <input name="title" value="{{ old('title') }}" type="text" class="input-field">
        </div>

        <!-- فیلد شرح اعلانیه -->
        <div class="input-group">
            <label>شرح اعلانیه:</label>
            <textarea name="text" class="input-field">{{ old('text') }}</textarea>
        </div>

        <!-- دکمه ثبت -->
        <button class="submit-btn">ثبت و خروج</button>

    </form>
</div>

</body>
</html>
