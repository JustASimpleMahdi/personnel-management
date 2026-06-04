<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ثبت و خروج</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
        }

        * {
            box-sizing: border-box;
            font-family: 'BYekanBold', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background: #f0f0f0;
            padding-top: 10px;
        }

        .screen {
            width: 375px;
            height: 750px;
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 80%);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 10px 20px 20px;
            position: relative;
        }

        .main-card {
            width: 100%;
            height: 80%;
            background: #fff;
            border-radius: 15px;
            border: 1.5px solid #ed82bd;
            box-shadow: 0 5px 15px rgba(237, 130, 189, .2);
            position: relative;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 35px;
        }

        .row {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            color: #555;
            font-weight: bold;
        }

        /* تاریخ مثل قبل */
        .date-row {
            justify-content: flex-end;
        }

        .date-display {
            direction: ltr;
            letter-spacing: 5px;
            margin-right: auto;
            font-size: 20px;
        }

        /* فقط عنوان و شرح برن سمت چپ */
        .left-row {
            justify-content: flex-start;
            text-align: left;
        }

        .btn-container {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .submit-btn {
            background: #ed82bd;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 5px 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .1);
        }
    </style>
</head>
<body>
<div class="screen">
    <form action="{{ route('suggestions.store') }}" method="post" class="main-card">
        @csrf

        <div class="row left-row">
            <span>عنوان:</span>
            <input name="title" value="{{ old('title') }}" type="text">
        </div>
        @error('title')
        {{ $message }}
        @enderror

        <div class="row left-row" style="margin-bottom: -20px">
            <span>شرح:</span>
        </div>
        <textarea name="text">{{ old('title') }}</textarea>
        @error('text')
        {{ $message }}
        @enderror
        <div class="btn-container">
            <button class="submit-btn">ثبت و خروج</button>
        </div>

    </form>
</div>
</body>
</html>



