<?php
    use App\Http\Controllers\ProductController;
    $total=0;

    if (\Illuminate\Support\Facades\Auth::user()){
        $total = ProductController::cartItem();
    }

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="{{'/'}}" style="font-family: 'New Tegomin', serif;"><b><span style="color: rgba(31,180,26,0.65)">Fresh</span><span style="color: orange"> Food</span></b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item">
{{--                    <a href="{{route('cartIndex')}}" class="nav-link"><i class="fas fa-shopping-basket"></i>-<span class="cart-qty text-danger font-weight-bold">{{ \Cart::session(\Illuminate\Support\Facades\Auth::user()->id)->getTotalQuantity() }}</span></a>--}}
{{--                    <a href="{{route('cartIndex')}}" class="nav-link"><i class="fas fa-shopping-basket"></i>-<span class="cart-qty text-danger font-weight-bold">{{ \App\Http\Controllers\ProductController::cartItem() }}</span></a> или так можно--}}
                    <a href="{{route('cartList')}}" class="nav-link"><i class="fas fa-shopping-basket"></i>-<span class="cart-qty text-danger font-weight-bold">{{ $total }}</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adv')}}" class="nav-link">Разместить объявление</a>
                </li>
{{--            @else--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">Разместить объявление</a>--}}
{{--                </li>--}}
            @endauth
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">{{ __('Войти') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#registerModal">{{ __('Регистрация') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(\Illuminate\Support\Facades\Auth::user()->name=='admin')
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Admin page</a>
                        @else
                            <a class="dropdown-item" href="{{ route('profile') }}">Личный кабинет</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

