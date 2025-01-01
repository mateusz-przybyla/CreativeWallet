$(document).ready(() => {
  const date = new Date();

  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  var currentDate = `${year}-${month}-${day}`;

  $("#formAddExpense").validate({
    rules: {
      category: {
        required: true,
      },
      date: {
        required: true,
        date: true,
        min: "2000-01-01",
        max: currentDate,
      },
      amount: {
        required: true,
        number: true,
        min: 0.01,
        step: 0.01,
      },
      paymentMethod: {
        required: true,
      },
    },
    errorPlacement: (error, element) => {
      if (element.attr("name") == "category") {
        error.insertAfter("#expenseCategoryArea");
      } else if (element.attr("name") == "date") {
        error.insertAfter("#expenseDateArea");
      } else if (element.attr("name") == "amount") {
        error.insertAfter("#expenseAmountArea");
      } else if (element.attr("name") == "paymentMethod") {
        error.insertAfter("#expensePaymentMethodArea");
      }
    },
  });
});
