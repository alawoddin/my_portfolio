<section class="contact section" id="contact">
    <h2 class="section-title">Contact</h2>

    <div class="contact__container bd-grid" style="grid-template-columns: repeat(2, 1fr); gap: 2rem;">

        {{-- SECTION 1: USER INPUT FORM --}}
        <div class="contact__form-wrapper">
            <h3>Send a Message</h3>

            <form method="POST" action="{{ route('store.message') }}" class="contact__form">
                @csrf

                <input type="text"
                       name="name"
                       placeholder="Your Name"
                       class="contact__input"
                       required>

                <input type="email"
                       name="email"
                       placeholder="Your Email"
                       class="contact__input"
                       required>

                <textarea name="message"
                          rows="6"
                          class="contact__input"
                          placeholder="Your Message"
                          required></textarea>

                <button type="submit" class="contact__button button">
                    Submit
                </button>
            </form>
        </div>

        @php
    $contacts = \App\Models\Contact::orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
@endphp

        {{-- SECTION 2: SHOW USER MESSAGES --}}
        <div class="contact__messages-wrapper">
            <h3>Messages</h3>

            @foreach($contacts as $item)
                <div class="message-card" style="border: 1px solid #000000;">
                    <strong>{{ $item->name }}</strong>
                    <p class="email">{{ $item->email }}</p>
                    <p>{{ $item->message }}</p>
                    <small>{{ $item->created_at->diffForHumans() }}</small>
                </div>
            @endforeach

        
        </div>

    </div>
</section>
