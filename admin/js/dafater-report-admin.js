jQuery(document).ready(function () {
  var $ = jQuery;
  $("#example").DataTable({
    scrollY: 500,
    scrollX: true,
    scrollCollapse: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fa.json",
    },
    // paging: false,
    // fixedColumns: {
    //   left: 1,
    //   right: 1,
    // },
  });
});
