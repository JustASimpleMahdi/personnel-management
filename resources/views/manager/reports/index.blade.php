<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارشات</title>
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
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 60%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
        }


        .header {
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 25px;
            left: 20px;
            cursor: pointer;
        }

        .page-title {
            font-size: 24px;
            color: #333;
            margin: 0;
            display: inline-block;
            border-bottom: 2px solid #555;
            width: 60%;
            padding-bottom: 5px;
        }


        .reports-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
            margin: 35px 0 10px 0;
        }

        .reports-label {
            font-size: 18px;
            color: #333;
            margin-right: 10px;
        }

        .filter-icon {
            display: flex;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .f-dot {
            width: 5px;
            height: 5px;
            border: 1.5px solid #333;
            border-radius: 50%;
        }

        .f-line {
            width: 14px;
            height: 2px;
            background-color: #333;
            border-radius: 2px;
        }


        .report-list-container {
            background: #ffffff;
            margin: 0 15px;
            border-radius: 15px;
            box-shadow: 0 10px 25px #f09ac9 !important;

            border: 2px solid #ed82bd !important;
            overflow: hidden;
        }

        .report-item {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            align-items: center;
            padding: 15px;

            border-bottom: 1px solid rgba(237, 130, 189, 0.4);
        }

        .report-item:last-child {
            border-bottom: none;
        }

        .col-info {
            text-align: right;
        }

        .role-text {
            font-size: 10px;
            color: #999;
            margin-bottom: 2px;
        }

        .name-text {
            font-size: 13px;
            color: #000;
        }

        .col-date {
            text-align: center;
            font-size: 11px;
            color: #666;
        }

        .col-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
        }

        .view-link {
            font-size: 13px;
            color: #000;
            text-decoration: underline;
            cursor: pointer;
        }

        .trash-btn {
            cursor: pointer;
            color: #444;
            display: flex;
        }


        .pagination {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 20px 25px;
            color: #ed82bd;
            gap: 8px;
        }

        .page-text {
            font-size: 15px;
            text-decoration: underline;
            cursor: pointer;
        }

        .arrow-icon {
            transform: rotate(180deg);
            display: flex;
            align-items: center;
            cursor: pointer;
        }

    </style>
</head>
<body>

<div class="screen">
    <div class="header">
        <a href="{{ route('manager.index') }}" class="back-button">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="3"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </a>
        <h1 class="page-title">گزارشات</h1>
    </div>

    <div class="reports-bar">
        <span class="reports-label">گزارشات امروز:</span>
        <div class="filter-icon">
            <div class="filter-row">
                <div class="f-dot"></div>
                <div class="f-line"></div>
            </div>
            <div class="filter-row">
                <div class="f-line"></div>
                <div class="f-dot"></div>
            </div>
        </div>
    </div>

    <div class="report-list-container">

        @foreach($reports as $report)
            <div class="report-item">
                <div class="col-info">
                    <div class="role-text">{{ $report->user->role->name }}</div>
                    <div class="name-text">{{ $report->user->fullname }}</div>
                </div>
                <div class="col-date">{{ $report->updated_at->format('Y/m/d') }}</div>
                <div class="col-actions">
                    <a href="{{ route('manager.reports.edit',['report' => $report]) }}" class="view-link">مشاهده</a>
                    <a href="{{ route('manager.reports.delete',['report' => $report]) }}" class="trash-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path
                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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







