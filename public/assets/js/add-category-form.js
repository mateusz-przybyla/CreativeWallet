$("#formAddExpenseCategory").validate({
  rules: {
    newExpenseCategory: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newExpenseCategory") {
      $("#addExpenseCategoryError").text($(error).text());
      $("#addExpenseCategory").addClass("is-invalid");
    }
  },
});

$("#addExpenseCategoryModal").on("hide.bs.modal", () => {
  $("#addExpenseCategoryError").text("");
  $("#addExpenseCategory").removeClass("is-invalid");
});

$("#formAddIncomeCategory").validate({
  rules: {
    newIncomeCategory: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newIncomeCategory") {
      $("#addIncomeCategoryError").text($(error).text());
      $("#addIncomeCategory").addClass("is-invalid");
    }
  },
});

$("#addIncomeCategoryModal").on("hide.bs.modal", () => {
  $("#addIncomeCategoryError").text("");
  $("#addIncomeCategory").removeClass("is-invalid");
});
