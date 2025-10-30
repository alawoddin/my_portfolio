@extends('home.user_master')
@section('home')



@php
    $homes = App\Models\Home::orderByDesc('id')->first();
@endphp
 
 <main class="l-main">
            <!--===== HOME =====-->
            <section class="home bd-grid" id="home">
                <div class="home__data">
                    <h1 class="home__title">Hi,<br>I'am <span class="home__title-color">{{$homes->title ?? 'N/A'}}</span><br> Web Designer</h1>

                    <a href="https://alawoddin.khedmat.website/" class="button">{{$homes->button}}</a>
                </div>

                <div class="home__social">
                    <a href="https://www.linkedin.com/in/info-khedmat-a58b58343/" class="home__social-icon"><i class='bx bxl-linkedin'></i></a>
                    <a href="https://www.fiverr.com/alawoddin/buying?source=avatar_menu_profile" class="home__social-icon"><i class='bx bxl-behance' ></i></a>
                    <a href="https://github.com/alawoddin" class="home__social-icon"><i class='bx bxl-github' ></i></a>
                </div>

                <div class="home__img">
                    <img src="{{asset($homes->photo)}}" alt="">
                    {{-- <svg class="home__blob" viewBox="0 0 479 467" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <mask id="mask0" mask-type="alpha">
                            <path d="M9.19024 145.964C34.0253 76.5814 114.865 54.7299 184.111 29.4823C245.804 6.98884 311.86 -14.9503 370.735 14.143C431.207 44.026 467.948 107.508 477.191 174.311C485.897 237.229 454.931 294.377 416.506 344.954C373.74 401.245 326.068 462.801 255.442 466.189C179.416 469.835 111.552 422.137 65.1576 361.805C17.4835 299.81 -17.1617 219.583 9.19024 145.964Z"/>
                        </mask>
                        <g mask="url(#mask0)">
                            <path d="M9.19024 145.964C34.0253 76.5814 114.865 54.7299 184.111 29.4823C245.804 6.98884 311.86 -14.9503 370.735 14.143C431.207 44.026 467.948 107.508 477.191 174.311C485.897 237.229 454.931 294.377 416.506 344.954C373.74 401.245 326.068 462.801 255.442 466.189C179.416 469.835 111.552 422.137 65.1576 361.805C17.4835 299.81 -17.1617 219.583 9.19024 145.964Z"/>
                            <image class="home__blob-img" x="50" y="60" href="{{asset('frontend/assets/img/perfil.png')}}"/>
                        </g>
                    </svg> --}}
                </div>
            </section>

            <!--===== ABOUT =====-->
            @include('home.homelayout.about')

         
            <!--===== SKILLS =====-->

            @include('home.homelayout.skill')
          
            <!--===== WORK =====-->
            @include('home.homelayout.work')

            <!--===== CONTACT =====-->
            @include('home.homelayout.contact')
          
        </main>
@endsection