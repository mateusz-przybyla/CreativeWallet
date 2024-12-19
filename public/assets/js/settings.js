$(document).ready(() => {
  if (errorList["oldPassword"]) {
    $("#oldPasswordError").text(errorList["oldPassword"]);
    $("#changePasswordModal").modal("show");
  }
  if (errorList["newPassword"]) {
    $("#newPasswordError").text(errorList["newPassword"]);
    $("#changePasswordModal").modal("show");
  }
  if (errorList["newPasswordConfirmed"]) {
    $("#newPasswordConfirmedError").text(errorList["newPasswordConfirmed"]);
    $("#changePasswordModal").modal("show");
  }

  if (errorList["newExpenseCategory"]) {
    $("#addExpenseCategoryError").text(errorList["newExpenseCategory"]);
    $("#addExpenseCategoryModal").modal("show");
  }
  if (errorList["newIncomeCategory"]) {
    $("#addIncomeCategoryError").text(errorList["newIncomeCategory"]);
    $("#addIncomeCategoryModal").modal("show");
  }
  if (errorList["newPaymentMethod"]) {
    $("#addPaymentMethodError").text(errorList["newPaymentMethod"]);
    $("#addPaymentMethodModal").modal("show");
  }

  if (errorList["editExpenseCategory"]) {
    $("#editExpenseCategoryError-" + errorList["editExpenseCategoryId"]).text(
      errorList["editExpenseCategory"]
    );
    $("#editExpenseCategoryModal-" + errorList["editExpenseCategoryId"]).modal(
      "show"
    );
  }
  if (errorList["editIncomeCategory"]) {
    $("#editIncomeCategoryError-" + errorList["editIncomeCategoryId"]).text(
      errorList["editIncomeCategory"]
    );
    $("#editIncomeCategoryModal-" + errorList["editIncomeCategoryId"]).modal(
      "show"
    );
  }
  if (errorList["editPaymentMethod"]) {
    $("#editPaymentMethodError-" + errorList["editPaymentMethodId"]).text(
      errorList["editPaymentMethod"]
    );
    $("#editPaymentMethodModal-" + errorList["editPaymentMethodId"]).modal(
      "show"
    );
  }
});

$("#changePasswordModal").on("hide.bs.modal", () => {
  $("#oldPasswordError").text("");
  $("#newPasswordError").text("");
  $("#newPasswordConfirmedError").text("");
});

$("#addExpenseCategoryModal").on("hide.bs.modal", () => {
  $("#addExpenseCategoryError").text("");
});
$("#addIncomeCategoryModal").on("hide.bs.modal", () => {
  $("#addIncomeCategoryError").text("");
});
$("#addPaymentMethodModal").on("hide.bs.modal", () => {
  $("#addPaymentMethodError").text("");
});

$("#editExpenseCategoryModal-" + errorList["editExpenseCategoryId"]).on(
  "hide.bs.modal",
  () => {
    $("#editExpenseCategoryError-" + errorList["editExpenseCategoryId"]).text(
      ""
    );
  }
);
$("#editIncomeCategoryModal-" + errorList["editIncomeCategoryId"]).on(
  "hide.bs.modal",
  () => {
    $("#editIncomeCategoryError-" + errorList["editIncomeCategoryId"]).text("");
  }
);
$("#editPaymentMethodModal-" + errorList["editPaymentMethodId"]).on(
  "hide.bs.modal",
  () => {
    $("#editPaymentMethodError-" + errorList["editPaymentMethodId"]).text("");
  }
);
