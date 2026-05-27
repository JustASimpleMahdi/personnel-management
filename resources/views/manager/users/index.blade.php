<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران - تراز چپ نام</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{asset('fonts/BYekan+ Bold.ttf')}}') format('truetype');
        }

        * {
            box-sizing: border-baox;
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
            top: 25px;
            left: 25px;
            cursor: pointer;
        }

        .header-title {
            font-size: 32px;
            color: #444;
            margin: 0;
        }

        .header-line {
            width: 70%;
            height: 1.5px;
            background-color: #444;
            margin: 10px auto 25px;
        }


        .add-user-row {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #444;
            cursor: pointer;
        }

        .add-user-text {
            font-size: 16px;
            text-decoration: underline;
            font-weight: bold;
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
            padding: 15px 0 15px 20px;
            border-bottom: 1.5px solid #ed82bd;
        }

        .user-item:last-child {
            border-bottom: none;
        }


        .user-name {
            font-size: 20px;
            color: #ed82bd;
            font-weight: bold;
            text-align: right;
            padding-right: 15px;
            flex: 1;
        }


        .user-actions {
            display: flex;
            gap: 12px;
            padding-right: 15px;
        }

        .icon-btn {
            width: 24px;
            height: 24px;
            cursor: pointer;
            color: #444;
        }


        .pagination {
            width: 90%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 15px;
            gap: 5px;
            color: #ed82bd;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="screen">
    <div class="header">

        <a href="{{ route('manager.index') }}" class="back-button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">

                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </a>
        <h1 class="header-title">کاربران</h1>
        <div class="header-line"></div>
    </div>

    <a href="{{ route('manager.users.create') }}" class="add-user-row">
        <svg class="icon-btn" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
        </svg>
        <span class="add-user-text">افزودن کاربر جدید</span>
    </a>

    <div class="user-list-container">
        @foreach($users as $user)
            <div class="user-item">
                <div class="user-name">{{ $user->fullname }}</div>

                <div class="user-actions">
                    <a href="{{ route('manager.users.edit',['user' => $user]) }}">
                        <svg class="icon-btn" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('manager.users.delete',['user' => $user]) }}">
                        <svg class="icon-btn" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $users->links() }}


</div>

</body>
</html>


