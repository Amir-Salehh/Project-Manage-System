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
    <title>ویرایش پروژه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard/edit.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>
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
        <h3 class="section-title">ویرایش پروژه</h3>
        <form action="{{ route('project_edit_post', ['id' => $_GET['id']]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="projectName" class="form-label">نام پروژه</label>
                <input type="text" class="form-control" name="name" id="projectName" placeholder="نام پروژه را وارد کنید" value="{{ $projects->name }}" required>
            </div>

            <div class="mb-4">
                <label for="projectDesc" class="form-label">توضیحات پروژه</label>
                <textarea class="form-control" id="projectDesc" name="description" rows="4" placeholder="توضیحات پروژه را وارد کنید" required>{{ $projects->description }}</textarea>
            </div>
            @php
                $deadline = $projects->deadline ;
                @endphp
            <div class="mb-4">
                <label for="projectDeadline" class="form-label">تاریخ مهلت</label>
                <input type="text" class="form-control" id="projectDeadline" name="projectDeadline" value="{{ $deadline }}" required>
            </div>

            <div class="mb-4">
                <label for="projectStatus" class="form-label">وضعیت پروژه</label>
                <select class="form-control" id="projectStatus" name="status">
                    @if($projects->status)
                        <option value="1" selected>تمام شده</option>
                        <option value="0" >فعال</option>
                    @else
                        <option value="1" >تمام شده</option>
                        <option value="0" selected>فعال</option>
                    @endif
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('dashboard_page') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> بازگشت به صفحه اصلی</a>
                <button type="submit" class="btn btn-custom">ثبت تغییرات</button>
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

<script>
    $(document).ready(function (deadline) {
        $("#projectDeadline").persianDatepicker({
            format: 'YYYY/MM/DD',
            altFormat: 'YYYY-MM-DD',
            selectedDate: deadline,
            calendar: {
                persian: {
                    locale: 'en',
                },
            },

        });
    });
</script>
</body>
</html>
