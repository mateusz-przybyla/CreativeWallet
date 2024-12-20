// show backend messages in the modals

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

// frontend modal form validation

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

$("#formAddPaymentMethod").validate({
  rules: {
    newPaymentMethod: {
      required: true,
    },
  },
  errorPlacement: (error, element) => {
    if (element.attr("name") == "newPaymentMethod") {
      $("#addPaymentMethodError").text($(error).text());
      $("#addPaymentMethod").addClass("is-invalid");
    }
  },
});

$("#addPaymentMethodModal").on("hide.bs.modal", () => {
  $("#addPaymentMethodError").text("");
  $("#addPaymentMethod").removeClass("is-invalid");
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
      $("#oldPasswordError").text($(error).text());
      $("#oldPassword").addClass("is-invalid");
    } else if (element.attr("name") == "newPassword") {
      $("#newPasswordError").text($(error).text());
      $("#newPassword").addClass("is-invalid");
    } else if (element.attr("name") == "newPasswordConfirmed") {
      $("#newPasswordConfirmedError").text($(error).text());
      $("#newPasswordConfirmed").addClass("is-invalid");
    }
  },
});

$("#changePasswordModal").on("hide.bs.modal", () => {
  $("#oldPasswordError").text("");
  $("#oldPassword").removeClass("is-invalid");
  $("#newPasswordError").text("");
  $("#newPassword").removeClass("is-invalid");
  $("#newPasswordConfirmedError").text("");
  $("#newPasswordConfirmed").removeClass("is-invalid");
});
