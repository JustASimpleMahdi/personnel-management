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
            --main-pink: #ed82bd;
            --light-pink: #fbe4f2;
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
            background: #ed82bd;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            position: relative; /* ✅ اضافه شد تا back-button نسبت به این قرار بگیره */
        }

        /* بخش تقویم */
        .calendar-section {
            width: 100%;
            padding: 40px 20px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .calendar-title {
            font-size: 22px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .calendar-control {
            background: #fff;
            width: 100%;
            max-width: 330px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .arrow-btn {
            width: 40px;
            height: 40px;
            border: 2px solid var(--main-pink);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--main-pink);
            font-size: 24px;
            cursor: pointer;
            text-decoration: none;
        }

        .month-name {
            font-size: 22px;
            color: #555;
            font-weight: bold;
        }

        /* بخش لیست پایین (سفید) */
        .salary-list-container {
            flex-grow: 1;
            width: 100%;
            background: #fff;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
            padding: 30px 15px;
        }

        .salary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .salary-table thead th {
            color: var(--main-pink);
            font-size: 14px;
            padding-bottom: 15px;
            text-align: center;
            font-weight: normal;
        }

        .salary-table tbody td {
            padding: 15px 5px;
            text-align: center;
            font-size: 14px;
            color: #333;
            border-bottom: 2px solid #f2b6d7;
        }

        .salary-table tbody tr td:first-child {
            font-weight: bold;
            text-align: right;
        }

        /* ✅ بک باتن بالا-راست */
        .back-button {
            position: absolute;
            top: 25px;
            left: 25px; /* ✅ به راست منتقل شد */
            right: auto; /* ✅ برای جلوگیری از تداخل */
            cursor: pointer;
            z-index: 20; /* ✅ روی همه چیز قرار بگیره */
        }

        @media (min-width: 520px) {
            .screen {
                max-width: 420px;
                margin: 24px auto;
                border-radius: 40px;
            }
        }
    </style>
</head>

<body>
<main class="screen">

    <a href="{{ auth()->user()->redirectRoute() }}" class="back-button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="#333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </a>

    <!-- بخش تقویم بالا -->
    <div class="calendar-section">
        <div class="calendar-title">تقویم:</div>
        <div class="calendar-control">
            <a href="{{ request()->fullUrlWithQuery(['month' => $date->subMonths()->format('n'),'year' => $date->subMonths()->format('Y')]) }}"
               class="arrow-btn">‹</a>
            <div class="month-name">{{ $date->format('F Y') }}</div>
            <a href="{{  request()->fullUrlWithQuery(['month' => $date->addMonths()->format('n'),'year' => $date->addMonths()->format('Y')])  }}"
               class="arrow-btn">›</a>
        </div>
    </div>

    <!-- بخش لیست حقوق پایین -->
    <div class="salary-list-container">
        <table class="salary-table">
            <thead>
            <tr>
                <th style="text-align:right;">نام</th>
                <th>حقوق پایه</th>
                <th>اضافه کاری/کسری</th>
                <th>محاسبه</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                @php($salary = $isCurrentMonth ? $employee->currentMonthSalary : $employee->month_salary)
                @if($salary)
                    <tr>
                        <td>{{ $employee->fullname }}</td>
                        <td>{{ toman($employee->currentMonthSalary->base_salary) }}</td>
                        <td>{{ toman($employee->currentMonthSalary->total_penalty) }}</td>
                        <td>{{ toman($employee->currentMonthSalary->total) }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

</main>
</body>
</html>

