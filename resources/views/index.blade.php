<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>صفحه اصلی</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    <body>
    <!-- Header -->
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="navbar-brand">سیستم مدیریت پروژه</a>
            <nav>
                <a href="{{ route('login_page') }}" class="btn btn-custom mx-2">ورود</a>
                <a href="{{ route('register_page') }}" class="btn btn-custom mx-2">ثبت‌نام</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>خوش آمدید به سیستم مدیریت پروژه</h1>
        <p>ابزاری برای مدیریت حرفه ‌ای وظایف، تیم‌ها و پروژه‌های شما</p>
        <a href="{{ route('register_page') }}" class="btn btn-light btn-lg mx-2">شروع کنید</a>
        <a href="{{ route('login_page') }}" class="btn btn-outline-light btn-lg mx-2">ورود به سیستم</a>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2>ویژگی ‌های کلیدی</h2>
        <div class="row">
            <div class="col-md-4 feature text-center">
                <h5>مدیریت پروژه‌ها</h5>
                <p>پروژه‌های خود را با ابزارهای پیشرفته مدیریت کنید.</p>
            </div>
            <div class="col-md-4 feature text-center">
                <h5>مدیریت تیم</h5>
                <p>اعضای تیم را به ‌صورت حرفه‌ ای سازماندهی کنید.</p>
            </div>
            <div class="col-md-4 feature text-center">
                <h5>گزارش ‌گیری دقیق</h5>
                <p>پیشرفت پروژه‌ها را با گزارش ‌های جامع مشاهده کنید.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>
            طراحی شده با عشق ❤️ |
            <a href="https://www.linkedin.com/in/amirsalehh" target="_blank">لینکدین</a> |
            <a href="https://github.com/Amir-Salehh" target="_blank">گیت ‌هاب</a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
