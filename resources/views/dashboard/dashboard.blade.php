@if(!session('LoggedUser'))
@php
    header("Location: /");
    exit();
@endphp
@endif
    <!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت پروژه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard_page') }}">پنل مدیریت پروژه</a>
        <div class="navbar-nav ms-auto">
            <a href="{{ route('logout') }}" class="btn btn-danger">خروج</a>
        </div>
    </div>
</nav>

<!-- Create Project Section -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">لیست پروژه‌ها</h3>
        <a href="{{ route('create_project') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="fas fa-plus"></i> ایجاد پروژه جدید
        </a>
    </div>
    <hr>
</div>

<div class="container">
    @if($projects->isEmpty())
        <div class="alert alert-warning text-center">
            <h4 class="alert-heading">هنوز پروژه ای ایجاد نشده</h4>
            <p>لطفا ابتدا یک پروژه جدید ایجاد کنید.</p>
        </div>
    @endif

    <!-- Projects List -->
    @foreach($projects as $project)
        <div class="card mb-3">
            <div class="card-header">
                {{ $project->name }}
            </div>
            <div class="card-body">
                <p>{{ $project->description }}</p>
                <div class="d-flex gap-2">
                    @if(!$project->status)
                        <a href="{{ route('project_done', ['id' => $project->id]) }}" class="btn btn-danger">در حال انجام</a>
                    @else
                        <button class="btn btn-custom">انجام شد</button>
                    @endif
                    <form action="{{ route('delete_project', ['id' => $project->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                    <a href="{{ route('project_edit', ['id' => $project->id]) }}" class="btn btn-warning">ویرایش</a>
                </div>
            </div>
            @php
                $deadline = $project->deadline;
                $deadline = jdate($deadline)->format('Y/m/d');
            @endphp
            <div class="card-footer">
                <p>تاریخ تحویل: {{ $deadline }}</p>
            </div>
        </div>
    @endforeach
</div>

<!-- Footer -->
<div class="footer">
    <p>
        طراحی شده با عشق ❤️ |
        <a href="https://www.linkedin.com/in/amirsalehh" target="_blank">لینکدین</a> |
        <a href="https://github.com/Amir-Salehh" target="_blank">گیت‌هاب</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
