@if(Auth::user()->is_admin == 1)
    @include('admin')
@else
    @include('user')
@endif
