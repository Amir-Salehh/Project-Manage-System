@php
    $title = "پنل مدیریت پروژه"
@endphp

@extends('dashboard.layout.master')

@section('content')

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

        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-6 mb-4 ">
                    <div class="card h-100">
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
                            $deadlineMiladi = $project->deadline;
                            $deadline = jdate($deadlineMiladi)->format('Y/m/d');
                            $pass = jdate($deadlineMiladi)->isPast();
                        @endphp
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            @if($pass)
                                <span class="btn btn-outline-danger btn-sm">گذشته</span>
                            @else
                                <span class="btn btn-outline-success btn-sm">در زمان مقرر</span>
                            @endif
                            <p class="mb-0">تاریخ تحویل: {{ $deadline }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if(!$projects->isEmpty())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                @if($projects->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">قبلی</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $projects->previousPageUrl() }}">قبلی</a>
                    </li>
                @endif

                @foreach($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                    <li class="page-item" {{ $page == $projects->currentPage() ? 'active' : '' }}>
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                    @if($projects->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $projects->nextPageUrl() }}">بعدی</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">بعدی</span>
                        </li>
                    @endif
            </ul>
        </nav>
    </div>
    @endif

@endsection
