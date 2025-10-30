

@once
  {{-- Keep these in your master layout ideally --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
@endonce

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  
$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });

</script>

<style>
  /* Tiny nicety: search icon inside input */
  .dataTables_filter input[type="search"]{
    padding-left: 2rem;
    background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' fill='currentColor' viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85h-.017Zm-5.242.656a5 5 0 1 1 0-10.001 5 5 0 0 1 0 10.001Z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: .5rem center; background-size: 14px 14px;
  }
</style>

<div class="card my-3">
  <div class="card-header d-flex justify-content-between align-items-center gap-2">
    <h5 class="mb-0">{{ $title }}</h5>

    @if($button && $buttonRoute && \Illuminate\Support\Facades\Route::has($buttonRoute))
      <a href="{{ route($buttonRoute) }}" class="btn btn-primary btn-sm">{{ $button }}</a>
    @endif
  </div>

  <div class="card-body">
    <table id="{{ $tableId }}" class="table table-bordered table-striped table-hover align-middle w-100">
      <thead>
        <tr>
          <th style="width:70px">Sl</th>
          @foreach($columns as $column)
            <th>{{ ucfirst(str_replace('_',' ', is_array($column)?($column['label'] ?? $column['key']):$column)) }}</th>
          @endforeach
          @if($showActions)
            <th style="width:160px">Action</th>
          @endif
        </tr>
      </thead>

     <tbody>
  @foreach($data as $i => $row)
    <tr>
      <td>{{ $i + 1 }}</td>

      @foreach($columns as $column)
        @php
          $key   = is_array($column) ? ($column['key'] ?? '') : $column;
          $value = data_get($row, $key);

          // detect if this column should be rendered as an image
          $isImageCol = false;
          $lowerKey = strtolower($key ?? '');
          if (str_contains($lowerKey, 'photo') || str_contains($lowerKey, 'image') || str_contains($lowerKey, 'avatar')) {
              $isImageCol = true;
          }
          // also render as image if the value looks like an image path/url
          if (!$isImageCol && is_string($value ?? '') && preg_match('#\.(png|jpe?g|gif|webp|bmp|svg)$#i', $value)) {
              $isImageCol = true;
          }

          // small helper for placeholder (optional)
          $fallback = url('upload/no_image.jpg');
        @endphp

        @if($isImageCol)
          <td>
            @if(!empty($value))
              <img src="{{ $value }}" alt="image"
                   style="height:48px;width:auto;border-radius:6px;object-fit:cover;">
            @else
              <img src="{{ $fallback }}" alt="no image"
                   style="height:48px;width:auto;border-radius:6px;opacity:.7;">
            @endif
          </td>
        @else
          <td>{{ $value ?? '-' }}</td>
        @endif
      @endforeach

  @if($showActions)
  <td class="text-nowrap">
    @if($routeName && Route::has($routeName.'.edit'))
      <a href="{{ route($routeName.'.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
    @endif

    @if($routeName && Route::has($routeName.'.delete'))
      {{-- Use a link, not a form, because your route is GET --}}
      <a href="{{ route($routeName.'.delete', $row->id) }}"
         class="btn btn-sm btn-danger " id="delete"
         data-url="{{ route($routeName.'.delete', $row->id) }}">
        Delete
      </a>
    @endif
  </td>
@endif
    </tr>
  @endforeach
</tbody>
    </table>
  </div>
</div>

<script>
  (function() {
    const id = '#{{ $tableId }}';

    if (!window.jQuery || !$.fn || !$.fn.DataTable) return;

    if ($.fn.DataTable.isDataTable(id)) $(id).DataTable().destroy();

    $(id).DataTable({
      lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]],
      pageLength: 10,
      ordering: true,
      searching: true,
      dom:
        "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "t" +
        "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries"
      }
    });
  })();
</script>
