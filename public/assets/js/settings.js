// show backend validation messages in the modals

$(document).ready(() => {
  if (errorList["oldPassword"]) {
    $("#oldPasswordError").text(errorList["oldPassword"]);
    $("#changePasswordModal").modal("show");
    $("#oldPassword").addClass("is-invalid");
  }
  if (errorList["newPassword"]) {
    $("#newPasswordError").text(errorList["newPassword"]);
    $("#changePasswordModal").modal("show");
    $("#newPassword").addClass("is-invalid");
  }
  if (errorList["newPasswordConfirmed"]) {
    $("#newPasswordConfirmedError").text(errorList["newPasswordConfirmed"]);
    $("#changePasswordModal").modal("show");
    $("#newPasswordConfirmed").addClass("is-invalid");
  }

  if (errorList["newExpenseCategory"]) {
    $("#addExpenseCategoryError").text(errorList["newExpenseCategory"]);
    $("#addExpenseCategoryModal").modal("show");
    $("#addExpenseCategory").addClass("is-invalid");
  }
  if (errorList["newIncomeCategory"]) {
    $("#addIncomeCategoryError").text(errorList["newIncomeCategory"]);
    $("#addIncomeCategoryModal").modal("show");
    $("#addIncomeCategory").addClass("is-invalid");
  }
  if (errorList["newPaymentMethod"]) {
    $("#addPaymentMethodError").text(errorList["newPaymentMethod"]);
    $("#addPaymentMethodModal").modal("show");
    $("#addPaymentMethod").addClass("is-invalid");
  }

  if (errorList["editExpenseCategory"]) {
    $("#editExpenseCategoryError-" + errorList["editExpenseCategoryId"]).text(
      errorList["editExpenseCategory"]
    );
    $("#editExpenseCategoryModal-" + errorList["editExpenseCategoryId"]).modal(
      "show"
    );
    $("#editExpenseCategory-" + errorList["editExpenseCategoryId"]).addClass(
      "is-invalid"
    );
  }
  if (errorList["editIncomeCategory"]) {
    $("#editIncomeCategoryError-" + errorList["editIncomeCategoryId"]).text(
      errorList["editIncomeCategory"]
    );
    $("#editIncomeCategoryModal-" + errorList["editIncomeCategoryId"]).modal(
      "show"
    );
    $("#editIncomeCategory-" + errorList["editIncomeCategoryId"]).addClass(
      "is-invalid"
    );
  }
  if (errorList["editPaymentMethod"]) {
    $("#editPaymentMethodError-" + errorList["editPaymentMethodId"]).text(
      errorList["editPaymentMethod"]
    );
    $("#editPaymentMethodModal-" + errorList["editPaymentMethodId"]).modal(
      "show"
    );
    $("#editPaymentMethod-" + errorList["editPaymentMethodId"]).addClass(
      "is-invalid"
    );
  }
});

$("#changePasswordModal").on("hide.bs.modal", () => {
  $("#oldPasswordError").text("");
  $("#oldPassword").removeClass("is-invalid");
  $("#newPasswordError").text("");
  $("#newPassword").removeClass("is-invalid");
  $("#newPasswordConfirmedError").text("");
  $("#newPasswordConfirmed").removeClass("is-invalid");
});

$("#addExpenseCategoryModal").on("hide.bs.modal", () => {
  $("#addExpenseCategoryError").text("");
  $("#addExpenseCategory").removeClass("is-invalid");
});
$("#addIncomeCategoryModal").on("hide.bs.modal", () => {
  $("#addIncomeCategoryError").text("");
  $("#addIncomeCategory").removeClass("is-invalid");
});
$("#addPaymentMethodModal").on("hide.bs.modal", () => {
  $("#addPaymentMethodError").text("");
  $("#addPaymentMethod").removeClass("is-invalid");
});

$("#editExpenseCategoryModal-" + errorList["editExpenseCategoryId"]).on(
  "hide.bs.modal",
  () => {
    $("#editExpenseCategoryError-" + errorList["editExpenseCategoryId"]).text(
      ""
    );
    $("#editExpenseCategory").removeClass("is-invalid");
  }
);
$("#editIncomeCategoryModal-" + errorList["editIncomeCategoryId"]).on(
  "hide.bs.modal",
  () => {
    $("#editIncomeCategoryError-" + errorList["editIncomeCategoryId"]).text("");
    $("#editIncomeCategory").removeClass("is-invalid");
  }
);
$("#editPaymentMethodModal-" + errorList["editPaymentMethodId"]).on(
  "hide.bs.modal",
  () => {
    $("#editPaymentMethodError-" + errorList["editPaymentMethodId"]).text("");
    $("#editPaymentMethod").removeClass("is-invalid");
  }
);

// frontend modal form validation

$("#formAddExpenseCategory").validate({
  rules: {
    newExpenseCategory: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newExpenseCategory") {
      error.insertAfter("#addExpenseCategoryArea");
    }
  },
});

$("#addExpenseCategoryModal").on("hide.bs.modal", () => {
  $("#addExpenseCategory-error").text("");
  $("#addExpenseCategory").removeClass("error");
});

$("#formAddIncomeCategory").validate({
  rules: {
    newIncomeCategory: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newIncomeCategory") {
      error.insertAfter("#addIncomeCategoryArea");
    }
  },
});

$("#addIncomeCategoryModal").on("hide.bs.modal", () => {
  $("#addIncomeCategory-error").text("");
  $("#addIncomeCategory").removeClass("error");
});

$("#formAddPaymentMethod").validate({
  rules: {
    newPaymentMethod: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newPaymentMethod") {
      error.insertAfter("#addPaymentMethodArea");
    }
  },
});

$("#addPaymentMethodModal").on("hide.bs.modal", () => {
  $("#addPaymentMethod-error").text("");
  $("#addPaymentMethod").removeClass("error");
});

$("#formChangePassword").validate({
  rules: {
    oldPassword: {
      required: true,
      minlength: 6,
    },
    newPassword: {
      required: true,
      minlength: 6,
    },
    newPasswordConfirmed: {
      required: true,
      minlength: 6,
      equalTo: "#newPassword",
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "oldPassword") {
      error.insertAfter("#oldPasswordArea");
    } else if (element.attr("name") == "newPassword") {
      error.insertAfter("#newPasswordArea");
    } else if (element.attr("name") == "newPasswordConfirmed") {
      error.insertAfter("#newPasswordConfirmedArea");
    }
  },
});

$("#changePasswordModal").on("hide.bs.modal", () => {
  $("#oldPassword-error").text("");
  $("#oldPassword").removeClass("error");
  $("#newPassword-error").text("");
  $("#newPassword").removeClass("error");
  $("#newPasswordConfirmed-error").text("");
  $("#newPasswordConfirmed").removeClass("error");
});
