<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات گزارش</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
        }

        * { box-sizing: border-box; font-family: 'BYekanBold', 'Tahoma', sans-serif; }

        body {
            margin: 0; display: flex; justify-content: center;
            align-items: center; background-color: #f0f0f0; min-height: 100vh;
        }

        .screen {
            width: 375px; height: 750px;
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 60%);
            position: relative; box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border: 1px solid #ddd; overflow: hidden;
            display: flex; flex-direction: column; align-items: center;
            justify-content: center;
        }

        .main-container {
            width: 92%; background: #fff; border: 2px solid #ed82bd;
            border-radius: 25px; padding: 20px 15px;
            box-shadow: 0 15px 30px rgba(237, 130, 189, 0.25);
            display: flex; flex-direction: column;
            min-height: 680px;
        }

        .report-content-box {
            border: 1.5px solid #ed82bd; border-radius: 15px;
            padding: 15px; min-height: 310px; position: relative;
            box-shadow:0 6px 8px #ed82bd;
        }

        .date-text {
            text-align: left; font-size: 15px; color: #333;
            margin-bottom: 5px; display: block;
        }

        .label-title { display: block; font-size: 18px; color: #000; text-align: right; margin-top: 5px; }
        .label-desc { display: block; font-size: 22px; font-weight: bold; color: #000; margin-top: 10px; text-align: right; }

        .attachment-wrapper {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
            margin-top: 15px;
            gap: 9px;
        }

        .attachment-btn {
            border: 1px solid #444;
            border-radius: 50px;
            padding: 5px 20px;
            display: flex; align-items: center;
            gap: 8px; cursor: pointer; color: #444; font-size: 16px;
            background: #fff; order: 1;
        }


        .back-arrow {
            font-size: 24px; color: #1a1a1a; cursor: pointer;
            display: flex; align-items: center; order: 2;
        }

        /* این بخش به پایین کادر سفید هل داده می‌شود */
        .action-form{
            margin-top: auto;
            display: flex;
            flex-direction: column;
        }
        .action-section {
            margin-top: auto; /* هل دادن به پایین ترین جای ممکن */
            display: flex; flex-direction: column; align-items: flex-end; gap: 5px;
            margin-bottom: 10px; /* فاصله بسیار کم با دکمه ثبت */
        }

        .checkbox-row {
            display: flex; align-items: center; gap: 8px; color: #ed82bd;
            font-size: 14px; cursor: pointer;
            justify-content: flex-start; width: 100%;
            padding-right: 5px;
        }

        .custom-checkbox {
            accent-color: #ed82bd;
            width: 18px; height: 18px; border: 2px solid #ed82bd; border-radius: 4px;
            order: 1;
        }
        .checkbox-row span { order: 1; }

        .response-box {
            width: 100%; border: 1.5px solid #ed82bd; border-radius: 15px;
            padding: 12px; min-height: 100px; color: #aaa; font-size: 14px;
            text-align: right;
            box-shadow:0 6px 8px #ed82bd;
        }

        .submit-btn {
            background-color: #ed82bd; color: #fff; border: none;
            border-radius: 25px; padding: 10px 45px; font-size: 18px;
            cursor: pointer; align-self: center;
            box-shadow: 0 5px 15px rgba(237, 130, 189, 0.4);
            margin-bottom: 10px;
        }

    </style>
</head>
<body>

<div class="screen">
    <div class="main-container">
        <!-- کادر شرح گزارش -->
        <div class="report-content-box">
            <div class="date-text">تاریخ: {{$report->updated_at->format('Y/m/d')}}</div>
            <span class="label-title">عنوان: <span>{{ $report->title }}</span></span>
            <span class="label-desc">شرح گزارش:</span>
            <div>{{ $report->description }}</div>
        </div>

        <!-- ردیف فایل پیوست -->
        <div class="attachment-wrapper">
            @foreach($report->files as $file)
            <a href="{{ route('file.report',['file' => $file]) }}" class="attachment-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                <span>{{ $file->filename }}</span>
            </a>
            @endforeach
        </div>

        <!-- بخش مشاهده شد و پاسخ (منتقل شده به پایین) -->
        <form action="" class="action-form">
            <div class="action-section">
                <div class="checkbox-row">
                    <span>مشاهده شد</span>
                    <input type="checkbox" class="custom-checkbox">
                </div>
                <textarea name="" class="response-box" placeholder="درج پاسخ (اختیاری)"></textarea>
            </div>

            <!-- دکمه ثبت -->
            <button class="submit-btn">ثبت و خروج</button>
        </form>
    </div>
</div>

</body>
</html>









