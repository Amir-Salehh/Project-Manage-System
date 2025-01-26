@php
    $title = "ویرایش پروژه"
@endphp

@extends('dashboard.layout.master')

@section('content')

    <div class="container">
        <div class="form-section">
            <h3 class="section-title">ویرایش پروژه</h3>
            <form action="{{ route('project_edit_post', ['id' => $_GET['id']]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="projectName" class="form-label">نام پروژه</label>
                    <input type="text" class="form-control" name="name" id="projectName"
                           placeholder="نام پروژه را وارد کنید" value="{{ $projects->name }}" required>
                </div>

                <div class="mb-4">
                    <label for="projectDesc" class="form-label">توضیحات پروژه</label>
                    <textarea class="form-control" id="projectDesc" name="description" rows="4"
                              placeholder="توضیحات پروژه را وارد کنید" required>{{ $projects->description }}</textarea>
                </div>
                @php
                    $deadline = $projects->deadline ;
                @endphp
                <div class="mb-4">
                    <label for="projectDeadline" class="form-label">تاریخ مهلت</label>
                    <input type="text" class="form-control" id="projectDeadline" name="projectDeadline"
                           value="{{ $deadline }}" required>
                    @if(session('timePass'))
                        <p class="alert alert-danger">{{ session('timePass') }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="projectStatus" class="form-label">وضعیت پروژه</label>
                    <select class="form-control" id="projectStatus" name="status">
                        @if($projects->status)
                            <option value="1" selected>تمام شده</option>
                            <option value="0">فعال</option>
                        @else
                            <option value="1">تمام شده</option>
                            <option value="0" selected>فعال</option>
                        @endif
                    </select>
                </div>

                <div class="mb-4">
                    <label for="projectMembers" class="form-label">اعضای گروه</label>
                    <textarea class="form-control" name="projectMembers" id="projectMembers" rows="3"
                              placeholder="نام اعضای گروه را وارد کنید. هر نام را با کاما (,) جدا کنید."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard_page') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> بازگشت به
                        صفحه اصلی</a>
                    <button type="submit" class="btn btn-custom">ثبت تغییرات</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/persianDatepicker.js') }}"></script>

@endsection
