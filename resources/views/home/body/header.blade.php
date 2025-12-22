 <header class="l-header">

    @php
        $homes = App\Models\Home::orderByDesc('id')->first();
    @endphp
            <nav class="nav bd-grid">
                <div>
                    <a href="#" class="nav__logo">{{$homes->title ?? 'N/A'}}</a>
                </div>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="#skills" class="nav__link">Skills</a></li>
                        <li class="nav__item"><a href="#work" class="nav__link">Work</a></li>
                        <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>

                        {{-- @auth
                           <li class="nav__item"><a href="{{route('dashboard')}}" class="nav__link">Dashboard</a></li> 
                        @else
                            <li class="nav__item"><a href="{{route('login')}}" class="nav__link">Login</a></li>
                        @endauth --}}

                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>