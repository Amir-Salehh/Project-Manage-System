@if(!session('LoggedUser'))
@php
header("Location: /");
exit();
@endphp
@endif
