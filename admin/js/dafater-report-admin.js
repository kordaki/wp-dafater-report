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
      // create td elements for display_name, pdate, amount and pcreated_at inside of a tr for each item of response
      const data = JSON.parse(response).data;
      if (!!data && Array.isArray(data.reports)) {
        const reports = data.reports;

        $("#report_table_body").innerHTML = "";
        reports.forEach((report) => {
          const row = document.createElement("tr");
          const displayName = document.createElement("td");
          displayName.innerHTML = report.display_name;
          const pdate = document.createElement("td");
          pdate.innerHTML = report.pdate;
          const amount = document.createElement("td");
          amount.innerHTML = report.amount;
          const pcreated_at = document.createElement("td");
          pcreated_at.innerHTML = report.pcreated_at;
          row.appendChild(displayName);
          row.appendChild(pdate);
          row.appendChild(amount);
          row.appendChild(pcreated_at);
          console.log(row);
          //   $("#report_table_body").appendChild(row);
        });
      }
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
