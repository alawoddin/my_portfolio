@extends('admin.admin_master')
@section('admin')

{{-- DataTables (you can move these to master if you prefer) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<div class="card my-3">
  <div class="card-header d-flex justify-content-between align-items-center gap-2">
    <h5 class="mb-0">Data Table</h5>
    <a href="{{route('add.customer')}}" class="btn btn-primary btn-sm">Add New</a>
  </div>

  <div class="card-body">
    <table id="customerTable" class="table table-bordered table-striped table-hover align-middle w-100">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Name</th>
          <th>Email</th>
          <th>image</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @forelse($customers as $key => $customer)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>
              <img src="{{ asset($customer->image) }}" style="width:70px; height:40px; object-fit:cover" alt="image">
            </td>
            <td class="text-nowrap">
              {{-- <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-success btn-sm">Edit</a>
              <a href="{{ route('customer.destroy',$customer->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a> --}}
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No customers found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  (function () {
    const tid = '#customerTable';

    if ($.fn.DataTable.isDataTable(tid)) {
      $(tid).DataTable().destroy();
    }

    $(tid).DataTable({
      lengthMenu: [[10,20,50,100],[10,20,50,100]],
      pageLength: 10,
      dom:
        "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries"
      },
      ordering: true
    });
  })();
</script>

@endsection
