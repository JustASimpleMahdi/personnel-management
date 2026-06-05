<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>حقوق و دستمزد</title>

    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --pink: #ef7fc1;
            --pink-shadow: rgba(239, 127, 193, 0.45);
            --pink-border: rgba(239, 127, 193, 0.55);
            --text: #555;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'BYekan', sans-serif;
            background: #d9d9d9;
        }

        /* قاب گوشی */
        .screen {
            width: 100%;
            max-width: 420px;
            min-height: 100svh;
            margin: 0 auto;
            background: linear-gradient(180deg, #f07fbc 0%, #ffffff 100%);
            position: relative;
            padding: 24px 14px;
            display: flex; /* ✅ برای وسط‌چین شدن کادر */
            align-items: center; /* ✅ وسط عمودی */
            justify-content: center; /* ✅ وسط افقی */
        }

        /* ✅ فقط یک کادر سفید */
        .card {
            width: 100%;
            max-width: 360px;
            min-height: 78svh;
            background: #fff;
            border-radius: 18px;
            border: 1.5px solid var(--pink-border);
            box-shadow: 0 12px 28px var(--pink-shadow);
            padding: 48px 22px 24px; /* قبلاً 28px 22px 24px بود */
            position: relative;
        }


        /* بک‌باتن (اگر خواستی) */
        .back-button {
            position: absolute;
            top: 18px;
            left: 18px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
        }

        .top-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 16px;
            margin-bottom: 58px;
            color: #555;
            font-size: 18px;
            font-weight: 700;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            color: #666;
            margin-bottom: 16px;
            font-weight: 700;
        }

        .amount {
            color: #222;
        }

        .section-title {
            text-align: right;
            color: #555;
            font-size: 18px;
            font-weight: 700;
            margin: 42px 0 22px;
        }

        .entry {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0 12px;
            font-size: 18px;
            font-weight: 700;
        }

        .entry .date {
            color: #555;
        }

        .entry .plus {
            color: #5c9839;
        }

        .entry .minus {
            color: #8b2d2d;
        }

        .separator {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--pink) 12%, var(--pink) 88%, transparent 100%);
            margin: 0 0 2px;
        }

        /* فضای خالی پایین مثل عکس */
        .spacer {
            height: 420px;
        }
    </style>
</head>

<body>
<main class="screen">

    <section class="card">

        <a href="{{ route('accountant.salaries.index') }}" class="back-button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="#333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </a>

        <div class="top-row">
            <div>{{ $salary->user->fullname }}</div>
            <div>{{ $salary->user->role->name }}</div>
        </div>

        <div class="row">
            <div>حقوق پایه :</div>
            <div class="amount">{{ toman($salary->base_salary) }}</div>
        </div>
        <div class="row">
            <div>جمع جریمه/اضافه کاری:</div>
            <div class="amount">{{ toman($salary->total_penalty) }}</div>
        </div>
        <div class="row">
            <div>حقوق:</div>
            <div class="amount">{{ toman($salary->total) }}</div>
        </div>

        <div class="section-title">اضافه کاری</div>


        @foreach($salary->every_day_of_month_worked_hours as $day)
            <div class="entry">
                <div class="date">{{ $day->date->format('Y/m/d') }}</div>
                @if($day->penalty >= 0)
                    <div class="plus">{{ toman($day->penalty) }}</div>
                @else
                    <div class="minus">{{ toman($day->penalty) }}</div>
                @endif
            </div>
            <div class="separator"></div>
        @endforeach
    </section>

</main>
</body>
</html>

