<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تایید حذف</title>
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
            background: linear-gradient(180deg, #ed82bd 0%, #ffffff 100%);
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .delete-modal {
            width: 85%;
            background: #fff;
            border: 2px solid #ed82bd;
            border-radius: 25px;
            padding: 35px 20px;
            box-shadow: 0 15px 35px rgba(255, 137, 202, 0.839);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;


            margin-top: 150px;
        }

        .modal-text {
            font-size: 22px;
            color: #444;
            line-height: 1.6;
            margin-bottom: 35px;
            font-weight: bold;
        }


        .modal-actions {
            display: flex;
            justify-content: center;
            width: 100%;
            gap: 40px;
        }


        .btn {
            width: 55px;
            height: 55px;
            border: none;
            border-radius: 12px;
            background-color: #ed82bd;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(237, 130, 189, 0.3);
            transition: transform 0.1s;
        }

        .btn:active {
            transform: scale(0.92);
        }

    </style>
</head>
<body>

<div class="screen">
    <div class="delete-modal">
        <div class="modal-text">
            آیا از حذف این اعلانیه<br>مطمئن هستید ؟
        </div>

        <form action="{{ route('manager.announcements.destroy',compact('announcement')) }}" method="post"
              class="modal-actions">
            @csrf
            @method('DELETE')

            <button class="btn">بله</button>


            <a href="{{ route('manager.announcements.index') }}" class="btn">خیر</a>
        </form>
    </div>
</div>

</body>
</html>
