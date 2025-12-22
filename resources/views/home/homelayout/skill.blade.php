  
  @php
    $skill = \App\Models\Skill::latest()->first();
  @endphp

  @php
  $data = \App\Models\Data_Skill::all();
@endphp
  
  <section class="skills section" id="skills">
                <h2 class="section-title">Skills</h2>

                <div class="skills__container bd-grid">          
                    <div>
                        <h2 class="skills__subtitle">{{$skill->title ?? "developer"}}</h2>
                        <p class="skills__text">{{$skill->description ?? "demo"}}</p>

                        @foreach($data as  $item)
                             <div class="skills__data">
                            <div class="skills__names">
                                <i class='{{$item->icon}}'></i>
                                <span class="skills__name">{{$item->title}}</span>
                            </div>
                            <div class="skills__bar skills__html {{$item->value}}">

                            </div>
                            <div>
                                <span class="skills__percentage">{{$item->value}}%</span>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    
                    <div>              
                        <img src="{{asset($skill->photo)}}" alt="" class="skills__img">
                    </div>
                </div>
            </section>
