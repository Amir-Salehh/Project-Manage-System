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
    <title>ساخت پروژه جدید</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard/create.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard_page') }}">پنل مدیریت پروژه</a>
        <a href="{{ route('dashboard_page') }}" class="btn btn-outline-light">صفحه اصلی</a>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="form-section">
        <h3 class="section-title">فرم ساخت پروژه جدید</h3>

        <form action="{{ route('project_post') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="projectName" class="form-label">نام پروژه</label>
                <input type="text" class="form-control" name="projectName" id="projectName" placeholder="نام پروژه را وارد کنید" required>
                @error('projectName')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="projectDesc" class="form-label">توضیحات پروژه</label>
                <textarea class="form-control" name="projectDesc" id="projectDesc" rows="4" placeholder="توضیحات پروژه را وارد کنید" required></textarea>
                @error('projectDesc')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="projectDeadline" class="form-label">تاریخ مهلت</label>
                <input type="date" class="form-control" name="projectDeadline" id="projectDeadline" required>
                @error('projectDeadline')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="projectStatus" class="form-label">وضعیت پروژه</label>
                <select class="form-control" name="projectStatus" id="projectStatus">
                    <option value="active">فعال</option>
                    <option value="completed">تمام شده</option>
                </select>
                @error('projectStatus')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('dashboard_page') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> بازگشت به صفحه اصلی</a>
                <button type="submit" class="btn btn-custom">ثبت پروژه</button>
            </div>
        </form>
    </div>
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
