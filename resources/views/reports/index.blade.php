@php use App\RoleEnum; @endphp
    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وضعیت گزارشات</title>
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
            padding: 20px;
        }

        /* هدر */
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-top: 10px;
            padding-bottom: 10px;
        }

        .header-title {
            font-size: 24px;
            color: #333;
            border-bottom: 1.5px solid #555;
            padding-bottom: 5px;
            width: 70%;
            text-align: center;
        }

        .back-icon {
            position: absolute;
            left: 0;
            font-size: 35px;
            color: #333;
            cursor: pointer;
            text-decoration: none;
            line-height: 1;
        }

        /* آیکون فیلتر */
        .filter-bar {
            display: flex;
            justify-content: flex-end;
            padding: 15px 5px;
        }

        .filter-icon {
            width: 28px;
            height: 28px;
            cursor: pointer;
        }

        /* کارت لیست گزارشات */
        .report-card {
            background: #fff;
            border: 2px solid #ed82bd;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .report-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #ed82bd;
            min-height: 60px;
        }

        .report-item:last-child {
            border-bottom: none;
        }

        /* بخش متن‌ها (کاملاً سمت راست) */
        .report-info {
            display: flex;
            flex-direction: row; /* متن اول، سپس تاریخ */
            gap: 15px;
            align-items: center;
            justify-content: flex-start;
        }

        .report-text {
            font-size: 15px;
            color: #333;
        }

        .report-date {
            font-size: 14px;
            color: #555;
        }

        /* بخش دکمه‌ها و وضعیت‌ها (کاملاً سمت چپ) */
        .report-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            flex-direction: row-reverse; /* آیکون ویرایش در سمت چپ یا راستِ وضعیت */
        }

        /* برچسب‌های وضعیت */
        .status-badge {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            display: inline-block;
        }

        .status-seen {
            background-color: #ed82bd;
        }

        .status-unseen {
            background-color: #ccc;
            color: #666;
        }

        .edit-icon {
            width: 22px;
            height: 22px;
            cursor: pointer;
        }

        /* پاصفحه */
        .pagination {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 15px;
            color: #ed82bd;
            font-size: 16px;
            gap: 8px;
            padding-right: 10px;
        }

        .pagination-text {
            text-decoration: underline;
            cursor: pointer;
        }

        .arrow-left {
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-right: 10px solid #ed82bd;
        }

    </style>
</head>
<body>

<div class="screen">
    <!-- هدر -->
    <div class="header">
        @php($route = auth()->user()->role->key->value.'.index')
        <a href="{{ route($route) }}" class="back-icon">></a>
        <div class="header-title">وضعیت گزارشات</div>
    </div>

    <!-- آیکون فیلتر -->
    <div class="filter-bar">
        <svg class="filter-icon" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
            <line x1="4" y1="6" x2="20" y2="6" stroke-linecap="round"></line>
            <line x1="8" y1="12" x2="16" y2="12" stroke-linecap="round"></line>
            <circle cx="18" cy="6" r="2" fill="white"></circle>
            <circle cx="6" cy="12" r="2" fill="white"></circle>
            <line x1="4" y1="18" x2="20" y2="18" stroke-linecap="round"></line>
            <circle cx="15" cy="18" r="2" fill="white"></circle>
        </svg>
    </div>

    <!-- لیست گزارشات -->
    <div class="report-card">
        @foreach($reports as $report)

        <div class="report-item">
            <div class="report-info">
                <span class="report-text">گزارش روز</span>
                <span class="report-date">{{ $report->created_at->format('Y/m/d') }}</span>
            </div>
            <div class="report-actions">
                <span class="status-badge status-unseen">مشاهده نشده</span>
                <a href="{{ route('reports.edit',['report' => $report]) }}">
                    <svg class="edit-icon" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach

    </div>

    {{ $reports->links() }}

</div>

</body>
</html>



