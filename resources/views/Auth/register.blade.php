<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام در سیستم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
</head>
<body>
<div class="form-container">
    <h2 class="form-title">ثبت ‌نام در سیستم</h2>
    <form action="{{ route('register_post') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">نام کاربری</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="نام کاربری خود را وارد کنید" >
            @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">ایمیل</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید" >
            @error('email')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">رمز عبور</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد کنید" >
            @error('password')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">تکرار رمز عبور</label>
            <input type="password" class="form-control" name="password_confirmation" id="confirm-password" placeholder="تکرار رمز عبور" >
            @error('password_confirmation')
            <p class="alert alert-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ثبت‌ نام</button>
    </form>
    <div class="link">
        <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="{{ route('login_page') }}">ورود به سیستم</a></p>
        <a href="{{ route('home') }}">صفحه اصلی</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
