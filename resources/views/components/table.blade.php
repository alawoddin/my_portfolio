         {{-- DataTables (you can move these to master if you prefer) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>



<script>
(function () {
  const tid = '#customerTable';

  if ($.fn.DataTable.isDataTable(tid)) {
    $(tid).DataTable().destroy();
  }

  $(tid).DataTable({
    ordering: true,          // sorting
    searching: true,         // search box
    paging: true,            // pagination
    pageLength: 10,
    lengthMenu: [[10,20,50,100],[10,20,50,100]],
    dom:
      "<'row mb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
      "t" +
      "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      lengthMenu: "Show _MENU_ entries"
    },
    // Disable sort/search on Sl, Image, Action columns
    columnDefs: [
      { targets: 0, orderable: false, searchable: false, className: 'text-center' }, // Sl
      { targets: 3, orderable: false, searchable: false }, // Image
      { targets: 4, orderable: false, searchable: false }  // Action
    ],
    // Optional: default order by Title (asc). Change to [1,'desc'] if you prefer.
    order: [[1, 'asc']]
  });
})();
</script>
