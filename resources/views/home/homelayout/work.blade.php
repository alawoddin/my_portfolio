@php
    $works = App\Models\Work::latest()->limit(6)->get();
@endphp

   <section class="work section" id="work">
       <h2 class="section-title">Work</h2>

           <div class="work__container bd-grid">
       @foreach ($works as $work)

               <a href="{{$work->link}}" class="work__img">
                   <img src="{{ asset($work->image) }}" alt="">
               </a>
               {{-- <a href="" class="work__img">
                   <img src="{{ asset('frontend/assets/img/work2.jpg') }}" alt="">
               </a>
               <a href="" class="work__img">
                   <img src="{{ asset('frontend/assets/img/work3.jpg') }}" alt="">
               </a>
               <a href="" class="work__img">
                   <img src="{{ asset('frontend/assets/img/work4.jpg') }}" alt="">
               </a>
               <a href="" class="work__img">
                   <img src="{{ asset('frontend/assets/img/work5.jpg') }}" alt="">
               </a>
               <a href="" class="work__img">
                   <img src="{{ asset('frontend/assets/img/work6.jpg') }}" alt="">
               </a>
                --}}
       @endforeach

           </div>


   </section>
