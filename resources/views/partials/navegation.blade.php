<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a href="{{url('/')}}" class="navbar-brand">{{env('APP_NAME')}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent"
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse-navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        @include('partials.navigations.'. \App\User::navitagion())
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="">{{__('menu.language')}}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{route('set_language', ['es'])}}" class="dropdown-item">
                                {{__('menu.spain')}}
                            </a>
                            <a href="{{route('set_language', ['en'])}}" class="dropdown-item">
                                {{__('menu.english')}}
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
