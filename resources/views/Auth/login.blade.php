<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ورود به سیستم</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    </head>
    <body>
    <div class="form-container">
        <h2 class="form-title">ورود به سیستم</h2>
        <form action="{{ route('login_post') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید" required>
                @error('email')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور خود را وارد کنید" required>
                @error('password')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">ورود</button>
        </form>
        <div class="link">
            <p>حساب کاربری ندارید؟ <a href="{{ route('register_page') }}">ثبت ‌نام کنید</a></p>
            <a href="{{ route('home') }}">صفحه اصلی</a>
            @if(session('php_errormsg'))
                <div class="alert alert-danger">
                    {{ session('php_errormsg') }}
                </div>
            @endif
            @if(session('create_account'))
                <div class="alert alert-success">
                    {{ session('create_account') }}
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
