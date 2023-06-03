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

  // processing event on button click
  $(document).on("click", "#show-reports", function () {
    const postData = "action=admin_ajax_request&param1=javad&param2=2";
    $.post(ajax_url, postData, function (response) {
      console.log(response);
    });
  });
});
