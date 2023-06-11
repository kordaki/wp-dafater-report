jQuery(document).ready(function () {
  var $ = jQuery;
  const ajax_url = dr_public.ajax_url;

  var reports_dataTable = $("#report_table").DataTable({
    scrollY: 500,
    scrollX: true,
    scrollCollapse: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fa.json",
    },
    columnDefs: [
      {
        searchable: false,
        orderable: false,
        targets: 0,
      },
    ],
    order: [[1, "asc"]],
    columns: [
      { title: "ردیف", data: null },
      { title: "دفترخانه", data: "display_name" },
      { title: "ماه", data: "pdate" },
      { title: "درآمد", data: "income" },
      { title: "تاریخ ایجاد", data: "pcreated_at" },
    ],
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
      // create td elements for display_name, pdate, income and pcreated_at inside of a tr for each item of response
      const data = JSON.parse(response).data;
      if (!!data && Array.isArray(data.reports)) {
        const reports = data.reports;
        reports_dataTable.clear().rows.add(reports).draw();
      }
    });
  });

  // apply auto index to first column
  reports_dataTable
    .on("order.dt search.dt", function () {
      reports_dataTable
        .column(0, {
          search: "applied",
          order: "applied",
        })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw();

  // processing event on button click
  //   $(document).on("click", "#show-reports", function () {
  //     const postData =
  //       "action=admin_ajax_request&target=da_get_reports&year=2&month=11";
  //     $.post(ajax_url, postData, function (response) {
  //       console.log(response);
  //     });
  //   });
});
