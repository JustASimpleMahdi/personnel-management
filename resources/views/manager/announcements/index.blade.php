<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد اعلانیه</title>
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
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 70%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }

        .header {
            width: 100%;
            padding: 0 20px;
            position: relative;
            text-align: center;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 25px;
            cursor: pointer;
        }

        .header-title {
            font-size: 28px;
            color: #444;
            margin: 0;
        }

        .header-line {
            width: 70%;
            height: 1.5px;
            background-color: #444;
            margin: 10px auto 20px;
        }

        .add-user-row {
            width: 100%;
            display: flex;
            flex-direction: row; /* آیکون اول، متن بعد */
            justify-content: flex-start;
            align-items: center;
            gap: 0px;
            margin-bottom: 10px;
            color: #444;
            cursor: pointer;
            padding-left: 10%;
        }

        .add-user-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            transform: translateX(-20px);
        }


        .add-user-text {
            font-size: 16px;
            text-decoration: underline;
            font-weight: bold;
            padding-right: 20px;
        }


        .user-list-container {
            width: 90%;
            background: #fff;
            border: 2px solid #ed82bd;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(237, 130, 189, 0.2);
        }

        .user-item {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1.5px solid #ed82bd;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-name {
            font-size: 18px;
            color: #444;
            font-weight: bold;
        }

        .user-actions {
            display: flex;
            gap: 10px;
        }

        .icon-btn {
            width: 22px;
            height: 22px;
            cursor: pointer;
            color: #444;
        }

        .pagination {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 15px;
            gap: 10px;
            color: #ed82bd;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="screen">
    <div class="header">
        <a href="{{ auth()->user()->redirectRoute() }}" class="back-button">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </a>
        <h1 class="header-title">ایجاد اعلانیه</h1>
        <div class="header-line"></div>
    </div>


    <a href="{{ route('manager.announcements.create') }}" class="add-user-row">
        <svg class="add-user-icon" width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="add-user-text">افزودن اعلانیه جدید</span>
    </a>


    <div class="user-list-container">
        @foreach($announcements as $announcement)
            <div class="user-item">
                <div class="user-name">{{ $announcement->title }}</div>
                <div class="user-actions">
                    <a href="{{ route('manager.announcements.delete',compact('announcement')) }}">
                        <svg class="icon-btn" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </a>
                    <a href="{{ route('manager.announcements.edit',compact('announcement')) }}">
                        <svg class="icon-btn" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $announcements->links() }}
</div>

</body>
</html>


