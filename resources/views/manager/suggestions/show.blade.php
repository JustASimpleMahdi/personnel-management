<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات نظر</title>
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
            background-color: #e0e0e0;
            min-height: 100vh;
        }

        .screen {
            width: 375px;
            height: 750px;
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 60%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        /* کارت سفید مرکزی */
        .detail-card {
            width: 95%;
            height: 400px;
            background: #fff;
            border-radius: 20px;
            border: 2px solid #ed82bd;
            box-shadow: 0 12px 25px rgba(237, 130, 189, 0.2);
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        /* ردیف تاریخ (بدون تغییر در تراز - راست‌چین) */
        .info-row-date {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        /* ردیف‌های عنوان و شرح (چپ‌چین - هم‌تراز با مشاهده شد) */
        .info-row-left {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
        }

        .info-label {
            font-size: 20px;
            color: #555;
            font-weight: bold;
        }

        .info-value {
            font-size: 18px;
            color: #333;
        }

        /* بخش مشاهده شده */
        .status-section {
            width: 95%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 15px;
            padding-right: 5px;
        }

        .status-label {
            color: #ed82bd;
            font-size: 16px;
            margin-left: 8px;
            font-weight: bold;
        }

        .custom-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #ed82bd;
            border-radius: 3px;
            appearance: none;
            cursor: pointer;
            outline: none;
        }

        .custom-checkbox:checked {
            background-color: #ed82bd;
        }

        /* دکمه خروج پایین صفحه */
        .exit-btn-container {
            position: absolute;
            bottom: 40px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .exit-button {
            background-color: #ed82bd;
            color: white;
            border: 1px solid #c06396;
            border-radius: 20px;
            padding: 10px 45px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="screen">

    <!-- کارت جزئیات -->
    <div class="detail-card">
        <!-- عبارت تاریخ به سمت چپ اسلش‌ها منتقل شد -->
        <div class="info-row-date">
            <span class="info-label">تاریخ:</span>
            <span class="info-value">{{ $suggestion->created_at->format('Y/m/d') }}</span>
        </div>

        <!-- عنوان و شرح منتقل شده به سمت چپ -->
        <div class="info-row-left">
            <span class="info-label">عنوان: </span>
            <span class="info-value">{{ $suggestion->title }}</span>
        </div>

        <div class="info-row-left">
            <span class="info-label">شرح: </span>
        </div>
        <div style="margin-top: -10px">{{$suggestion->text}}</div>
    </div>

    <!-- دکمه خروج -->
    <div class="exit-btn-container">
        <a href="{{ route('manager.suggestions.index') }}" class="exit-button">خروج</a>
    </div>

</div>

</body>
</html>
