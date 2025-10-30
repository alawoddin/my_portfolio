<div class="content">
  <div class="container-fluid my-0">

    @if(!empty($title))
      <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
          <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
        </div>

        <div class="text-end">
          <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div>
      </div>
    @endif

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          @if(!empty($title))
            <div class="card-header">
              <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>
          @endif

          <div class="card-body">
            {{-- Validation errors --}}
            @if ($errors->any())
              <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                  @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @php
              $fields = $fields ?? [];
              $hasFile = collect($fields)->contains(fn($f) => ($f['type'] ?? 'text') === 'file');
              $hasPreview = collect($fields)->contains(fn($f) => ($f['type'] ?? 'text') === 'file' && !empty($f['preview']));
            @endphp

            <!-- Dynamic Form -->
            <form action="{{ $action }}" method="POST" class="row g-3" @if($hasFile) enctype="multipart/form-data" @endif>
              @csrf
              @if(!empty($method) && in_array(strtoupper($method), ['PUT','PATCH','DELETE']))
                @method($method)
              @endif

              @foreach ($fields as $field)
                @php
                  $name   = $field['name'];
                  $label  = $field['label'] ?? ucfirst($name);
                  $type   = $field['type'] ?? 'text';
                  $value  = old($name, $field['value'] ?? null);   // old() first so it wins after validation errors
                  $half   = !empty($field['half']);
                  $req    = ($field['required'] ?? true) ? 'required' : '';
                  $id     = 'fld_'.$name;

                  // Textarea detection supports both 'type' and 'as'
                  $isTextarea = ($type === 'textarea') || (($field['as'] ?? null) === 'textarea');
                  $isSelect   = $type === 'select';
                  $isFile     = $type === 'file';

                  // Common UI helpers
                  $placeholder = $field['placeholder'] ?? null;

                  // Textarea options
                  $rows        = $field['rows'] ?? 3;
                  $maxlength   = $field['maxlength'] ?? null;
                  $showCounter = !empty($field['show_counter']);

                  // File options
                  $accept = $field['accept'] ?? null;
                  $preview        = $field['preview'] ?? false;
                  $previewWidth   = $field['preview_width']  ?? 96;
                  $previewHeight  = $field['preview_height'] ?? 96;
                  $previewCircle  = !empty($field['preview_circle']);
                  $placeholderImg = $field['placeholder_image'] ?? asset('upload/no_image.jpg');

                  // Build initial preview src (use existing saved path/value if any)
                  if ($isFile && $preview) {
                    $initialPreview = $value
                      ? (preg_match('/^https?:\/\//', (string)$value) ? $value : asset($value))
                      : $placeholderImg;
                  }
                @endphp

                <div class="{{ $half ? 'col-md-6' : 'col-md-12' }}">
                  <label for="{{ $id }}" class="form-label">{{ ucfirst($label) }}</label>

                  @if($isTextarea)
                    <div class="position-relative">
                      <textarea
                        id="{{ $id }}"
                        name="{{ $name }}"
                        class="form-control @error($name) is-invalid @enderror"
                        rows="{{ $rows }}"
                        @if($maxlength) maxlength="{{ $maxlength }}" @endif
                        @if($placeholder) placeholder="{{ $placeholder }}" @endif
                        {{ $req }}
                      >{{ $value }}</textarea>

                      @if($showCounter || $maxlength)
                        <small class="text-muted d-block mt-1">
                          <span id="{{ $id }}_count">{{ mb_strlen((string)$value ?? '') }}</span>
                          @if($maxlength)/{{ $maxlength }}@endif
                        </small>
                      @endif
                    </div>
                    @error($name)
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                  @elseif($isSelect)
                    <select
                      id="{{ $id }}"
                      name="{{ $name }}"
                      class="form-select @error($name) is-invalid @enderror"
                      @if($placeholder) data-placeholder="{{ $placeholder }}" @endif
                      {{ $req }}
                    >
                      <option value="">{{ $placeholder ?? '-- Select --' }}</option>
                      @foreach ($field['options'] ?? [] as $optValue => $optLabel)
                        <option value="{{ $optValue }}" {{ (string)$optValue === (string)$value ? 'selected' : '' }}>
                          {{ $optLabel }}
                        </option>
                      @endforeach
                    </select>
                    @error($name)
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                  @elseif($isFile)
                    <input
                      id="{{ $id }}"
                      type="file"
                      name="{{ $name }}"
                      class="form-control @error($name) is-invalid @enderror"
                      {{ $req }}
                      @if($accept) accept="{{ $accept }}" @endif
                      @if($preview) data-preview-target="prev-{{ $name }}" @endif
                    >
                    @error($name)
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($preview)
                      <div class="mt-2">
                        <img id="prev-{{ $name }}"
                             src="{{ $initialPreview }}"
                             alt="preview"
                             style="width: {{ $previewWidth }}px; height: {{ $previewHeight }}px; object-fit: cover;"
                             class="{{ $previewCircle ? 'rounded-circle' : 'rounded' }} border">
                      </div>
                    @endif

                  @else
                    <input
                      id="{{ $id }}"
                      type="{{ $type }}"
                      name="{{ $name }}"
                      value="{{ $value }}"
                      class="form-control @error($name) is-invalid @enderror"
                      @if($placeholder) placeholder="{{ $placeholder }}" @endif
                      {{ $req }}
                    >
                    @error($name)
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  @endif
                </div>
              @endforeach

              <div class="col-12 text-start">
                <button class="btn btn-primary" type="submit">
                  {{ $button ?? 'Submit' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Live preview for file inputs (runs only if any preview is requested) --}}
@if($hasPreview)
  <script>
    document.addEventListener('change', function (e) {
      const input = e.target;
      if (!input.matches('input[type="file"][data-preview-target]')) return;
      if (!input.files || !input.files[0]) return;

      const imgId = input.getAttribute('data-preview-target');
      const imgEl = document.getElementById(imgId);
      if (!imgEl) return;

      const file = input.files[0];
      if (!file.type || !file.type.startsWith('image/')) return;

      const reader = new FileReader();
      reader.onload = ev => { imgEl.src = ev.target.result; };
      reader.readAsDataURL(file);
    });
  </script>
@endif

{{-- Textarea live counter (works when show_counter or maxlength is set) --}}
<script>
  document.addEventListener('input', function(e){
    const t = e.target;
    if (!t.matches('textarea')) return;
    const counter = document.getElementById(t.id + '_count');
    if (counter) counter.textContent = (t.value || '').length;
  });
</script>
