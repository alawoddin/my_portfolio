@php
  $about = \App\Models\About::latest('id')->first();
@endphp

@if($about)
<section class="about section" id="about">
  <h2 class="section-title">About</h2>
  <div class="about__container bd-grid">
    <div class="about__img">
      <img src="{{ $about->photo_url }}" alt="{{ $about->title ?? 'Profile' }}">
    </div>
    <div>
      <h2 class="about__subtitle">{{ $about->title ?? "I'm Alawoddin" }}</h2>
      <p class="about__text">{{ $about->information ?? '' }}</p>
    </div>
  </div>
</section>
@endif
