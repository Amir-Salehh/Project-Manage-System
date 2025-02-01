@php
    $title = "ساخت پروژه جدید"
@endphp

@extends('dashboard.layout.master')

@section('content')

    <div class="container">
        <div class="form-section">
            <h3 class="section-title">فرم ساخت پروژه جدید</h3>

            <form action="{{ route('project_create_post') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="projectName" class="form-label">نام پروژه</label>
                    <input type="text" class="form-control" name="projectName" id="projectName"
                           placeholder="نام پروژه را وارد کنید" required>
                    @error('projectName')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="projectDesc" class="form-label">توضیحات پروژه</label>
                    <textarea class="form-control" name="projectDesc" id="projectDesc" rows="4"
                              placeholder="توضیحات پروژه را وارد کنید" required></textarea>
                    @error('projectDesc')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="projectDeadline" class="form-label">تاریخ مهلت</label>
                    <input type="text" class="form-control" name="projectDeadline" id="projectDeadline"
                           placeholder="لطفا تاریخ مورد نظر را انتخاب کنید">
                    @if(session('timePass'))
                        <p class="alert alert-danger">{{ session('timePass') }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="projectStatus" class="form-label">وضعیت پروژه</label>
                    <select class="form-control" name="projectStatus" id="projectStatus">
                        <option value="0">فعال</option>
                        <option value="1">تمام شده</option>
                    </select>
                    @error('projectStatus')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="projectMembers" class="form-label">اعضای گروه</label>
                    <div id="membersContainer">
                        <div class="d-flex gap-2 mb-2">
                            <input type="text" name="members[0][name]" class="form-control" placeholder="نام عضو" required>
                            <input type="text" name="members[0][role]" class="form-control" placeholder="مسئولیت عضو" required>
                            <button type="button" class="btn btn-danger remove-member">حذف</button>
                        </div>
                    </div>
                    <button type="button" id="addMemberBtn" class="btn btn-primary mt-2">افزودن عضو جدید</button>
                </div>

                <script src="{{ asset('js/teamMembers.js') }}"></script>


                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard_page') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> بازگشت به
                        صفحه اصلی</a>
                    <button type="submit" class="btn btn-custom">ثبت پروژه</button>
                </div>
            </form>

        </div>
    </div>

    <script src="{{ asset('js/persianDatepicker.js') }}"></script>


@endsection
