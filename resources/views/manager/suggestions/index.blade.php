<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظرات و پیشنهادات</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{asset('fonts/BYekan.ttf')}}') format('truetype');
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
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 45%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 25px;
            cursor: pointer;
        }

        .header-title {
            font-size: 24px;
            color: #333;
            margin-top: 10px;
        }

        .header-line {
            width: 70%;
            height: 1.5px;
            background-color: #444;
            margin-top: 5px;
        }


        .section-bar {
            width: 90%;
            margin: 25px auto 4px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .section-title {
            font-size: 19px;
            color: #333;
        }

        .filter-icon {
            display: flex;
            flex-direction: column;
            gap: 3px;
            cursor: pointer;
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


        .list-card {
            width: 90%;
            background: #fff;
            border-radius: 20px;
            margin: 0 auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 2px solid #ed82bd;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 2px solid #ed82bd;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .item-label {
            font-size: 17px;
            color: #333;
        }

        .view-link {
            font-size: 16px;
            color: #000;
            text-decoration: underline;
            cursor: pointer;
            font-weight: bold;
        }


        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            z-index: 10;
        }

        .filter-modal {
            background: #fff;
            width: 100%;
            border-radius: 30px 30px 0 0;
            padding: 20px;
            box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            box-sizing: border-box;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            justify-content: flex-end;
            z-index: 100;
        }

        .modal-overlay.show {
            display: flex;
        }

        .filter-modal {
            background: #fff;
            border-radius: 25px 25px 0 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-title {
            font-size: 22px;
            margin-bottom: 25px;
            color: #000;
        }

        .filter-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .filter-label-main {
            text-align: right;
            font-size: 16px;
            margin-bottom: 5px;
            width: 100%;
        }

        .date-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 30px;
        }

        .date-box {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .date-label {
            font-size: 14px;
            color: #000;
        }

        .date-slashes {
            font-size: 16px;
            color: #999;
            letter-spacing: 5px;
        }

        .apply-btn {
            background-color: #ed82bd;
            color: white;
            border: none;
            padding: 10px 60px;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            font-family: 'BYekanBold';
            margin-bottom: 10px;
        }

        .date-box-input {
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 4px 12px;
            width: 75px;
            text-align: center;
            color: #ccc;
            font-size: 12px;
        }

    </style>
</head>
<body>

<div class="screen">
    <div class="header">
        <a href="{{ auth()->user()->redirectRoute() }}" class="back-btn">
            <svg width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="3"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </a>
        <div class="header-title">نظرات و پیشنهادات</div>
        <div class="header-line"></div>
    </div>

    <div class="section-bar">
        <div class="section-title">نظرات:</div>
        <div class="filter-wrapper">
            <div class="filter-icon" onclick="openFilter()">
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
    </div>

    <!-- جدول با کادر و خطوط صورتی -->
    <div class="list-card">
        @foreach($suggestions as $suggestion)

            <div class="list-item">
                <div class="item-label">{{ $suggestion->title }}</div>
                <div class="user-actions">
                    <a href="{{ route('manager.suggestions.show',compact('suggestion')) }}" class="view-link">مشاهده</a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $suggestions->links() }}

    <div id="filter-modal" class="modal-overlay">
        <form action="" class="filter-modal">
            <div class="filter-title">فیلتر</div>

            <div class="filter-content">
                <div class="filter-label-main">تاریخ</div>

                <div class="date-container">

                    <div class="date-box">
                        <span class="date-label">از تاریخ: </span>
                        <input name="from" value="{{ request('from') }}" class="date-box-input" placeholder="/ /">

                    </div>


                    <div class="date-box">
                        <span class="date-label">تا تاریخ: </span>
                        <input name="to" value="{{ request('to') }}" class="date-box-input" placeholder="/ /">
                    </div>
                </div>
            </div>

            <button class="apply-btn">اعمال</button>
        </form>
    </div>
</div>


<script>
    const modal = document.querySelector("#filter-modal")

    function openFilter() {
        modal.classList.add('show')
    }

    modal.addEventListener('click', (e) => {
        if (e.target.closest('.filter-modal')) return
        modal.classList.remove('show')
    })
</script>
</body>
</html>



