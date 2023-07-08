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

  $(document).on("click", ".addRow", function (el) {
    var newRow =
      '<tr class="form-row">' +
      "<td>" +
      ($("#tableBody").find("tr").length + 1) +
      "</td>" +
      "<td>" +
      '<select class="form-control" name="select[]">' +
      '<option value="option1">Option 1</option>' +
      '<option value="option2">Option 2</option>' +
      '<option value="option3">Option 3</option>' +
      "</select>" +
      "</td>" +
      "<td>" +
      '<input type="text" class="form-control" name="input1[]" placeholder="متعامل">' +
      "</td>" +
      "<td>" +
      '<input type="text" class="form-control" name="input2[]" placeholder="شماره سند">' +
      "</td>" +
      "<td>" +
      '<input type="text" class="form-control" name="input3[]" placeholder="مبلغ به ریال">' +
      "</td>" +
      "<td>" +
      '<button type="button" class="btn btn-success addRow">+</button>' +
      "</td>" +
      "</tr>";

    el.currentTarget.classList.add("btn-danger");
    el.currentTarget.classList.add("deleteRow");
    el.currentTarget.classList.remove("btn-success");
    el.currentTarget.classList.remove("addRow");
    el.currentTarget.innerText = "-";

    $("#tableBody").append(newRow);
  });

  $(document).on("click", ".deleteRow", function () {
    $(this).closest(".form-row").remove();
  });

  $('input[name^="input3"]').on("input", function (el) {
    console.log(el.currentTarget.value);
  });
});
