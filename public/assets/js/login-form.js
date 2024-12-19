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
        $("#emailError").text($(error).text());
        $("#loginEmail").addClass("is-invalid");
      } else if (element.attr("name") == "password") {
        $("#passwordError").text($(error).text());
        $("#loginPassword").addClass("is-invalid");
      }
    },
  });
});
