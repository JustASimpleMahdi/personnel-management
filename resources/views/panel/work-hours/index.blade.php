@php use App\WorkHourShiftEnum;use Morilog\Jalali\Jalalian; @endphp
    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>ثبت ساعات کاری</title>
    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --main-pink: #ed82bd;
            --box-shadow: 0 10px 25px rgba(237, 130, 189, 0.5);
            --light-pink: #fbe4f2;
            --border-color: #ed82bd;
            --text-color: #333;
            --white: #fff;
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

        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .screen {
            width: 100%;
            max-width: 375px;
            min-height: 100svh;
            background: linear-gradient(180deg, var(--main-pink) 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .profile-card {
            background: #fff;
            width: 100%;
            border-radius: 35px;
            padding: 30px 18px 22px;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid var(--main-pink);
        }

        .title {
            width: 100%;
            text-align: center;
            font-size: 20px;
            color: var(--text-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* استایل تاریخ */
        .date-box {
            background: var(--light-pink);
            color: #333;
            padding: 6px 15px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
            border: 1px solid var(--main-pink);
        }

        .section-title {
            width: 100%;
            text-align: right;
            font-size: 16px;
            color: var(--main-pink);
            font-weight: 700;
            margin: 0 0 12px;
        }

        .form-box {
            width: 100%;
        }

        .input-group {
            width: 100%;
            margin-bottom: 14px;
        }

        .input-label {
            display: block;
            font-size: 13px;
            color: #444;
            margin-bottom: 6px;
            text-align: right;
        }

        .input-field {
            width: 100%;
            height: 44px;
            border: 2px solid var(--border-color);
            border-radius: 14px;
            padding: 0 14px;
            font-family: 'BYekan', sans-serif;
            font-size: 14px;
            outline: none;
            background: #fff;
        }

        .btn-save {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 15px;
            background: var(--main-pink);
            color: #fff;
            font-family: 'BYekan', sans-serif;
            font-size: 16px;
            font-weight: 700;
            box-shadow: var(--box-shadow);
            margin-top: 6px;
        }

        .day-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            width: 100%;
            margin-bottom: 15px;
        }

        .shift-group {
            width: 100%;
            border: 1px solid rgba(237, 130, 189, 0.25);
            border-radius: 18px;
            padding: 12px 10px;
            background: linear-gradient(180deg, rgba(251, 228, 242, 0.35), rgba(255, 255, 255, 0.95));
        }

        .shift-title {
            font-size: 14px;
            font-weight: 700;
            color: #555;
            margin-bottom: 8px;
            text-align: right;
        }

        .small-input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        /* جدول */
        .table-section {
            width: 100%;
            margin-top: 18px;
        }

        .table-title {
            width: 100%;
            text-align: right;
            font-size: 16px;
            color: var(--text-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .table-wrap {
            width: 100%;
            border-radius: 18px;
            border: 2px solid var(--main-pink);
            background: #fff;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead th {
            background: var(--light-pink);
            padding: 10px;
            border-bottom: 1px solid #f2b6d7;
        }

        tbody td {
            padding: 10px;
            border-bottom: 1px solid #f4f4f4;
            text-align: center;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
<main class="screen">
    <div class="profile-card">
        <div class="title">ثبت ساعات کاری</div>
        <div class="date-box" id="currentDate">تاریخ امروز: {{ Jalalian::now()->format('Y/m/d') }}</div>

        <form action="{{ route('work-hours.store') }}" method="post" class="form-box">
            @csrf
            <div class="section-title">ورود اطلاعات شیفت‌ها</div>

            <div class="day-row">
                <div class="shift-group">
                    <div class="shift-title">شیفت صبح</div>
                    <div class="small-input-row">
                        <div class="input-group">
                            <label class="input-label">ورود</label>
                            <input name="{{ WorkHourShiftEnum::MORNING }}[start]"
                                   value="{{ $todayWorkHours?->morning?->start }}" type="text"
                                   class="input-field"/>
                        </div>
                        <div class="input-group">
                            <label class="input-label">خروج</label>
                            <input name="{{ WorkHourShiftEnum::MORNING }}[end]"
                                   value="{{ $todayWorkHours?->morning?->end }}" type="text" class="input-field"/>
                        </div>
                    </div>
                </div>

                <div class="shift-group">
                    <div class="shift-title">شیفت بعدازظهر</div>
                    <div class="small-input-row">
                        <div class="input-group">
                            <label class="input-label">ورود</label>
                            <input name="{{ WorkHourShiftEnum::AFTERNOON }}[start]"
                                   value="{{ $todayWorkHours?->afternoon?->start }}" type="text"
                                   class="input-field"/>
                        </div>
                        <div class="input-group">
                            <label class="input-label">خروج</label>
                            <input name="{{ WorkHourShiftEnum::AFTERNOON }}[end]"
                                   value="{{ $todayWorkHours?->afternoon?->end }}" type="text" class="input-field"/>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn-save">ثبت</button>
        </form>

        <div class="table-section">
            <div class="table-title">ساعات ثبت شده</div>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>تاریخ</th>
                        <th>صبح</th>
                        <th>عصر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workHours as $dayWorkHours)
                        <tr>
                            <td>{{ $dayWorkHours->date->format('Y/m/d') }}</td>
                            <td>
                                @if($dayWorkHours->morning)
                                    {{ $dayWorkHours->morning->start }}
                                    - {{ $dayWorkHours->morning->end }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($dayWorkHours->afternoon)
                                    {{ $dayWorkHours->afternoon->start }}
                                    - {{ $dayWorkHours->afternoon->end }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
</html>



