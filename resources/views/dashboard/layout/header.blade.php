<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard_page') }}">پنل مدیریت پروژه</a>
        @if($title == "پنل مدیریت پروژه")
        <div class="navbar-nav ms-auto">
            <a href="{{ route('logout') }}" class="btn btn-danger">خروج</a>
        </div>
        @else
            <a href="{{ route('dashboard_page') }}" class="btn btn-outline-light">صفحه اصلی</a>
        @endif
    </div>
</nav>
