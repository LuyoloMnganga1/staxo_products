@include('layout.header')
<div class="container-fluid">
    <div class="row  pt-3" style="background-color:#bdbb46;">
        <div class="{{ Auth::user() ? "col-md-8" : "col-md-11" }} text-center">
            <span style="color:#4c40ee; font-size:14px; font-weight:bold; text-transform:uppercase;">
                <h1 class="text-center">Staxo Products</h1>
            </span>
        </div>
        <div class="{{ Auth::user() ? "col-md-4" : "col-md-1" }}" style="background-color:#bdbb46;">        
            @if (Auth::user())
           <h5 style="color:#4c40ee"> <span class="label">{{Auth::user()->name}}  <a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');"><i class="fa fa-sign-out" style="color:#2414c40ee987" aria-hidden="true"></i></a></h5>
            @else
                    @if(request()->is('login'))
                        <h5 style="color:#4c40ee"><a href="{{ url('/') }}"><i class="fa fa-arrow-left" style="color:#2414c40ee987" aria-hidden="true">Back</i></a></h5>
                    @else
                    <h5 style="color:#4c40ee">  <a class="label" href="{{ route('login') }}">login <i class="fa fa-sign-in"  aria-hidden="true"></i></a></h5>
                    @endif
            @endif
        </div>
    </div>
</div>
@yield('content')
@include('layout.footer')