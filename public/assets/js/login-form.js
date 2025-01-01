$(document).ready(() => {
  $("#formSignIn").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
    },
    errorPlacement: (error, element) => {
      if (element.attr("name") == "email") {
        error.insertAfter("#loginEmailArea");
      } else if (element.attr("name") == "password") {
        error.insertAfter("#loginPasswordArea");
      }
    },
  });
});
