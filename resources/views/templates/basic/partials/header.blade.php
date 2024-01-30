<header class="header-section">
    <div class="header-top bg--section">
        <div class="container">
            <ul class="header-top-area">
                <li class="me-auto">
                    @if($general->multi_language)
                    <div class="select-bar">
                        <select class="langSel">
                            @foreach($language as $item)
                            <option value="{{$item->code}}" @selected(session('lang')==$item->code)>{{ __($item->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </li>
                @guest
                <li class="links">
                    <a href="{{route('user.login')}}">@lang('Sign in')</a>
                </li>
                <li class="links b-left">
                    <a href="{{route('user.register')}}">@lang('Sign Up')</a>
                </li>
                @else
                <li class="links">
                    <a href="{{route('user.home')}}">@lang('Dashboard')</a>
                </li>
                <li class="links">
                    <a href="{{route('user.logout')}}">@lang('Logout')</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="@lang('image')">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a class="{{ menuActive('home') }}" href="{{route('home')}}">@lang('Home')</a>
                    </li>
                    @foreach($pages as $k => $data)
                    <li><a class="{{ menuActive('pages',null,$data->slug) }}" href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                    @endforeach
                    <li>
                        <a href="{{route('blog')}}" class="{{ menuActive('blog') }}">@lang('Blog')</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}" class="{{ menuActive('contact') }}">@lang('Contact')</a>
                    </li>
                </ul>
                <div class="header-bar m-0">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>


