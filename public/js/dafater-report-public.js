jQuery(document).ready(function () {
  var $ = jQuery;
  const ajax_url = dr_public.ajax_url;

  // on submit new-report-form
  $("#new-report-form").on("submit", function (e) {
    e.preventDefault();
    const formData = $("#new-report-form").serialize();
    const postData = "action=public_ajax_request&" + formData;
    console.log("----- formData:", formData);

    $.post(ajax_url, postData, function (response) {
      const data = JSON.parse(response).data;
      if (!!data && data.report) {
        const report = data.report;
        alert("گزارش عملکرد شما با موفقیت ثبت شد.");
        window.location.reload();
        console.log(report);
      }
    });
  });
});
