<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش گزارش</title>
    <style>
        @font-face {
            font-family: 'BYekanBold';
            src: url('{{ asset('fonts/BYekan+ Bold.ttf') }}') format('truetype');
        }

        * { box-sizing: border-box; font-family: 'BYekanBold', 'Tahoma', sans-serif; }

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
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .detail-card {
            width: 100%;
            height: 450px;
            background: #fff;
            border-radius: 20px;
            border: 2px solid #ed82bd;
            box-shadow:0 8px 10px rgba(255, 184, 223, 0.933);
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 10px;
        }


        .info-row-left {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            width: 100%;
        }


        .info-row-right {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .info-label {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        .info-value {
            font-size: 17px;
            color: #444;
            letter-spacing: 2px;
        }

        .attachment-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            margin-top: 15px;
            padding-left: 10px;
        }

        .attachment-btn {
            background: #fff;
            border: 1.5px solid #bbb;
            border-radius: 25px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #888;
            font-size: 13px;
            cursor: pointer;
            width: fit-content;
        }

        .attachment-btn svg {
            width: 18px;
            height: 18px;
            stroke: #aaa;
        }

        .footer-btn-container {
            position: absolute;
            bottom: 30px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .submit-btn {
            background-color: #ed82bd;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 40px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(237, 130, 189, 0.3);
            font-weight: bold;
        }


        .error-message {
            color: #ec0c04;
            font-size: 13px;
            text-align: right;
            padding-right: 5px;
        }
        .date-text {
            text-align: left; font-size: 15px; color: #333;
            margin-bottom: 5px; display: block;
        }
    </style>
</head>
<body>

<form action="{{ route('reports.update',['report' => $report]) }}" method="post" enctype="multipart/form-data" class="screen">
    @csrf
    @method('PUT')
    <div class="detail-card">
        <div class="date-text">تاریخ: {{$report->created_at->format('Y/m/d')}}</div>
        <div class="info-row-right">
            <span class="info-label">عنوان:</span>
            <input name="title" value="{{ old('title',$report->title) }}" type="text">
        </div>
        @error('title')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="info-row-right">
            <span class="info-label" style="font-size: 22px;">شرح گزارش:</span>
        </div>
            <textarea name="description">{{ old('title',$report->description) }}</textarea>
        @error('description')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="attachment-container">
        @foreach($report->files as $file)
        <div class="attachment-btn">
            <input name="delete_files[]" value="{{ $file->id }}" type="checkbox">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
            <a href="{{ route('file.report',['file' => $file]) }}" download="{{ $file->filename }}">{{ $file->filename }}</a>
        </div>
        @endforeach
        <label class="attachment-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
            <input name="files[]" type="file">
        </label>
        @error('files[]')
        <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="footer-btn-container">
        <button class="submit-btn">ثبت و خروج</button>
    </div>

</form>

</body>
</html>



