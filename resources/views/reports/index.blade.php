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
                    @if($report->is_seen)
                        <span class="status-badge status-seen">مشاهده شده</span>
                        <a href="{{ route('reports.show',['report' => $report]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24" height="24" viewBox="0 0 24 24">
                                <image id="Show" width="24" height="24" opacity="0.7"
                                       xlink:href="data:image/png;base64,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"/>
                            </svg>
                        </a>
                    @else
                        <span class="status-badge status-unseen">مشاهده نشده</span>
                        <a href="{{ route('reports.edit',['report' => $report]) }}">
                            <svg class="edit-icon" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

    {{ $reports->links() }}

</div>

</body>
</html>



