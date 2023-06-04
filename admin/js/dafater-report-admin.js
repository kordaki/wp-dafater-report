jQuery(document).ready(function () {
  var $ = jQuery;
  const ajax_url = dr_public.ajax_url;

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

  $("#search-reports-form").on("submit", function (e) {
    e.preventDefault();
    const formData = $("#search-reports-form").serialize();
    const postData =
      "action=admin_ajax_request&target=da_get_reports&" + formData;
    $.post(ajax_url, postData, function (response) {
      console.log(response);
    });
  });

  // processing event on button click
  //   $(document).on("click", "#show-reports", function () {
  //     const postData =
  //       "action=admin_ajax_request&target=da_get_reports&year=2&month=11";
  //     $.post(ajax_url, postData, function (response) {
  //       console.log(response);
  //     });
  //   });
});
