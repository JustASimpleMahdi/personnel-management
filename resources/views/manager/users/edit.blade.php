@php use App\UserShiftEnum; @endphp
    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ویرایش پروفایل</title>
    <style>
        @font-face {
            font-family: 'BYekan';
            src: url('{{ asset('fonts/BYekan+ Bold.ttf') }}') format('truetype');
            font-weight: 700;
        }

        :root {
            --main-pink: #ed82bd;
            --light-pink: #f9d8e7;
            --border-color: #ed82bd;
            --shadow: 0 4px 12px rgba(237, 130, 189, 0.25);
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

        .screen {
            width: 100%;
            max-width: 375px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--main-pink) 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            position: relative;
        }


        .profile-card {
            background: #fff;
            width: 100%;
            border-radius: 35px;
            padding: 40px 20px 30px;
            margin-top: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            border: 2px solid var(--main-pink);
        }


        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
            cursor: pointer;
        }


        .avatar-container {
            width: 110px;
            height: 110px;
            border: 2px solid var(--main-pink);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            padding: 3px;
            overflow: hidden;
            background-color: #fff;
        }

        .avatar-container img {
            width: 65%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }


        .input-group {
            width: 100%;
            position: relative;
            margin-bottom: 22px;
        }

        .input-group label {
            position: absolute;
            top: -12px;
            right: 25px;
            background: #fff;
            padding: 0 8px;
            font-size: 14px;
            color: #000;
            font-weight: bold;
            z-index: 1;
        }

        .input-group input, .input-group select,.input-group textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--border-color);
            border-radius: 18px;
            font-size: 16px;
            color: #777;
            background: #fff;
            outline: none;
            text-align: right;
            box-shadow: var(--shadow);
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;

        }


        .input-group .dropdown-arrow {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--main-pink);
            pointer-events: none;
            font-size: 12px;
        }


        .edit-btn {
            background-color: var(--main-pink);
            color: #fff;
            border: none;
            padding: 12px 60px;
            border-radius: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(237, 130, 189, 0.4);
            margin-top: 10px;
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

    <form action="{{ route('manager.users.update',['user'=>$user]) }}" method="post" class="profile-card">
        @csrf
        @method('PUT')
        <a href="{{ route('manager.users.index') }}" class="back-button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">

                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </a>


        <div class="avatar-container">

            <img src="{{ asset('images/Screenshot 2026-05-11 184314.png') }}" alt="پروفایل"
                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM4ODgiIHN0cm9rZS13aWR0aD0iMS41Ij48cGF0aCBkPSJNMjAgMjF2LTJhNCA0IDAgMCAwLTQtNEg4YTQgNCAwIDAgMC00IDR2MiI+PC9wYXRoPjxjaXJjbGUgY3g9IjEyIiBjeT0iNyIgcj0iNCI+PC9jaXJjbGU+PC9zdmc+'">
        </div>


        @session('update-success')
        <div class="update-success">اطلاعات با موفقیت بروزرسانی شد.</div>
        @endsession

        <div class="input-group">
            <label>نام</label>
            <input name="firstname" value="{{ old('firstname',$user->firstname) }}" type="text" placeholder="نام">
            @error('firstname')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>نام خانوادگی</label>
            <input name="lastname" value="{{ old('lastname',$user->lastname) }}" type="text" placeholder="نام خانوادگی">
            @error('lastname')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>شماره همراه</label>
            <input name="phone" value="{{ old('phone',$user->phone) }}" type="text" placeholder="شماره همراه">
            @error('phone')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>کدملی</label>
            <input name="national_code" value="{{ old('national_code',$user->national_code) }}" type="text" placeholder="کدملی">
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

        <div class="input-group">
            <label>نوع همکاری</label>
            <select name="role">
                @foreach($roles as $role)
                    <option @selected(old('role',$user->role->key) == $role->key) value="{{ $role->key }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <div class="dropdown-arrow">▼</div>
            @error('role')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>نام کاربری</label>
            <input name="username" value="{{ old('username',$user->username) }}" type="text" placeholder="نام کاربری">
            @error('username')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>رمزعبور</label>
            <input name="password" type="password" placeholder="رمزعبور">
            @error('password')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>حقوق پایه</label>
            <input name="salary" value="{{ old('salary',$user->salary) }}" type="text" placeholder="حقوق پایه">
            @error('salary')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label>شیفت فعلی</label>
            <select name="shift">
                <option @selected(old('shift',$user->shift) == UserShiftEnum::MORNING) value="{{ UserShiftEnum::MORNING }}">صبح
                </option>
                <option @selected(old('shift',$user->shift) == UserShiftEnum::AFTERNOON) value="{{ UserShiftEnum::AFTERNOON }}">بعد
                    از ظهر
                </option>
                <option @selected(old('shift',$user->shift) == UserShiftEnum::TWO_SHIFTS) value="{{ UserShiftEnum::TWO_SHIFTS }}">
                    دوشیفت
                </option>
            </select>
            <div class="dropdown-arrow">▼</div>
            @error('shift')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>


        <button class="edit-btn">ویرایش</button>

    </form>

</main>

</body>
</html>

