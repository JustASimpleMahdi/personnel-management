<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ویرایش پروفایل</title>
    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --main-pink: #ed82bd;
            --light-pink: #f9d8e7;
            --border-color: #ed82bd;
            --shadow: 0 4px 10px rgba(237, 130, 189, 0.3);
            --error-color: #ec0c04;
        }

        * {
            box-sizing: border-box;
            font-family: 'BYekan', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #d1d1d1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* ابعاد دقیق مطابق فایل قبلی */
        .screen {
            width: 100%;
            max-width: 375px; /* ابعاد موبایلی */
            min-height: 100vh;
            background: linear-gradient(180deg, var(--main-pink) 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        @media (min-width: 520px) {
            .screen {
                max-width: 420px;
                margin: 24px auto;
                border-radius: 40px;
                min-height: 800px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            }
        }

        /* کارت سفید اصلی */
        .profile-card {
            background: #fff;
            width: 100%;
            border-radius: 30px;
            padding: 30px 20px;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .profile-card > .update-form {
            align-self: stretch;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* دکمه بازگشت */
        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
            cursor: pointer;
        }

        /* دایره پروفایل */
        .avatar-container {
            width: 130px;
            height: 130px;
            border: 2px solid var(--main-pink);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            padding: 5px;
        }

        .avatar-container img {
            width: 65%;
            height: auto;
            opacity: 0.6;
        }

        /* استایل ورودی‌ها (Inputs) */
        .input-group {
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        .input-group label {
            position: absolute;
            top: -12px;
            right: 20px;
            background: #fff;
            padding: 0 10px;
            font-size: 14px;
            color: #333;
            font-weight: bold;
            z-index: 1;
        }

        .input-group input, .input-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--main-pink);
            border-radius: 15px;
            outline: none;
            font-size: 14px;
            color: #666;
            text-align: right;
            box-shadow: 0 4px 8px rgba(237, 130, 189, 0.4);
        }

        .input-group textarea {
            resize: none;
            height: 100px;
        }

        /* دکمه ذخیره */
        .save-btn {
            background-color: var(--main-pink);
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(237, 130, 189, 0.4);
            transition: 0.3s;
        }

        .save-btn:active {
            transform: scale(0.95);
        }

        /* دکمه خروج */
        .logout-container {
            margin-top: 30px;

        }

        .logout-container button {
            all: unset;
            color: #c81a42;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-container svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
        }

        .error-message {
            color: var(--error-color);
            font-size: 13px;
            text-align: right;
            padding-right: 5px;
        }

        .update-success {
            background-color: limegreen;
            color: white;
            padding: 10px 20px;
            align-self: stretch;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<main class="screen">

    <div class="profile-card">
        <!-- آیکون بازگشت -->
        <div onclick="history.back()" class="back-button">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </div>

        <!-- عکس پروفایل -->
        <div class="avatar-container">
            <img src="{{ asset('images/Screenshot 2026-05-11 184314.png') }}" alt="User">
        </div>

        @php($user = auth()->user())
        @session('update-success')
        <div class="update-success">اطلاعات با موفقیت بروزرسانی شد.</div>
        @endsession
        <!-- فرم ورودی ها -->
        <form action="{{ route('auth.profile.update') }}" method="post" class="update-form">
            @csrf
            @method('PUT')
            <div class="input-group">
                <label>نام</label>
                <input name="firstname" value="{{ old('firstname',$user->firstname) }}" type="text" placeholder="نام">
                @error('firstname')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label>نام خانوادگی</label>
                <input name="lastname" value="{{ old('lastname',$user->lastname) }}" type="text"
                       placeholder="نام خانوادگی">
                @error('lastname')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label>شماره تماس</label>
                <input name="phone" value="{{ old('phone',$user->phone) }}" type="text" placeholder="شماره تماس">
                @error('phone')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label>کدملی</label>
                <input name="national_code" value="{{ old('national_code',$user->national_code) }}" type="text"
                       placeholder="کدملی">
                @error('national_code')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label>آدرس</label>
                <textarea name="address" placeholder="آدرس">{{ old('address',$user->address) }}</textarea>
                @error('address')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- دکمه ذخیره -->
            <button class="save-btn">ذخیره تغییرات</button>
        </form>

        <!-- خروج از حساب -->
        <form action="{{ route('logout') }}" method="post" class="logout-container">
            @csrf
            @method('DELETE')
            <button>
                <span>خروج از حساب کاربری</span>
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </button>
        </form>
    </div>

</main>

</body>
</html>
