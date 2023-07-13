jQuery(document).ready(function () {
  var $ = jQuery;
  const ajax_url = dr_public.ajax_url;
  const moteamel_list = dr_public.moteamel_list;

  // on submit new-report-form
  $("#new-report-form").on("submit", function (e) {
    e.preventDefault();
    const formDataObject = {};
    $("#new-report-form")
      .serializeArray()
      .map(function (x) {
        formDataObject[x.name] = x.value;
      });

    const formData = $("#new-report-form").serialize();
    const postData =
      "action=public_ajax_request&target=da_add_report&" + formData;
    console.log("----- formData:", formData);

    $.post(ajax_url, postData, function (response) {
      const data = JSON.parse(response).data;
      console.log("----- data:", data);
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
      "<td class='table-index'>" +
      ($("#tableBody").find("tr").length + 1) +
      "</td>" +
      "<td>" +
      '<input type="text" class="form-control" name="moamel[]" placeholder="معامل">' +
      "</td>" +
      "<td>" +
      '<select class="form-control" name="moteamel[]">' +
      '<option value="" disabled selected>انتخاب کنید...</option>' +
      moteamel_list
        .map((moteamel) => `<option value="${moteamel}">${moteamel}</option>`)
        .join("") +
      "</select>" +
      "</td>" +
      "<td>" +
      '<input type="number" class="form-control" name="documentNumber[]" placeholder="شماره سند">' +
      "</td>" +
      "<td>" +
      '<input type="number" class="form-control" name="income[]" placeholder="مبلغ به ریال">' +
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
    $(".table-index").each(function (index, element) {
      $(element).text(index + 1);
    });
    calculateTotalIncome();
  });

  // calculate total income
  function calculateTotalIncome() {
    let newValue = 0;
    $("input[name^='income']").each(function (index, element) {
      newValue += Number(element.value);
    });
    $("#total-income").text(newValue);
  }

  $(document).on("input", "input[name^='income']", function (el) {
    calculateTotalIncome();
  });

  $(document).on("click", "#null-income", function (el) {
    if (el.currentTarget.checked) {
      $("#total-income").text(0);
      $("#dynamicTable").addClass("collapsed");
    } else {
      $("#dynamicTable").removeClass("collapsed");
      calculateTotalIncome();
    }
  });
});
