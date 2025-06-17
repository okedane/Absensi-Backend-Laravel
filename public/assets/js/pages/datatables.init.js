$(document).ready(function () {
  // Inisialisasi DataTable untuk elemen dengan id 'datatable'
  $("#datatable").DataTable();

  // Inisialisasi DataTable dengan opsi untuk elemen dengan id 'datatable-buttons'
  $("#datatable-buttons").DataTable({
    scrollX: true,
    lengthChange: false,
    buttons: [
      {
        extend: "copy",
        text: "Copy",
        exportOptions: {
          columns: ":not(.no-export)"
        }
      },
      {
        extend: "excel",
        text: "Export Excel",
        exportOptions: {
          columns: ":not(.no-export)"
        }
      },
      {
        extend: "pdf",
        text: "Export PDF",
        orientation: "landscape", // Ubah ke landscape agar lebih luas
        pageSize: "A4", // Sesuaikan ukuran kertas
        exportOptions: {
          columns: ":not(.no-export)"
        }
      },
      "colvis"
    ]
  }).buttons().container()
    .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

  // Menambahkan kelas pada elemen select dalam DataTables
  $(".dataTables_length select").addClass("form-select form-select-sm");
});
