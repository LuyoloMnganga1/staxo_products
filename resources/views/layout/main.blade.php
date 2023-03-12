@include('layout.header')
<div class="container-fluid">
    <div class="row  pt-3" style="background-color:#8935c9;">
        <div class="{{ Auth::user() ? "col-md-10" : "col-md-11" }} text-center">
            <span style="color:#fff; font-size:14px; font-weight:bold; text-transform:uppercase;">
                <h1 class="text-center">Staxo Products</h1>
            </span>
        </div>
        <div class="{{ Auth::user() ? "col-md-2" : "col-md-1" }}" style="background-color:#8935c9;">        
            @if (Auth::user())
           <h5 style="color:#fff"> <span class="label">{{Auth::user()->name}}  <a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');"><i class="fa fa-sign-out" style="color:#241fff987" aria-hidden="true"></i></a></h5>
            @else
                    @if(request()->is('login'))
                        <h5 style="color:#fff"><a href="{{ url('/') }}"><i class="fa fa-arrow-left" style="color:#fff" aria-hidden="true">Back</i></a></h5>
                    @else
                    <h5 style="color:#fff">  <a class="label"  style="color:#fff" href="{{ route('login') }}">login <i class="fa fa-sign-in"  aria-hidden="true"></i></a></h5>
                    @endif
            @endif
        </div>
    </div>
</div>
@yield('content')
@include('layout.footer')