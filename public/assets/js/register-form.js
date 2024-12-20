$(document).ready(() => {
  $.validator.addMethod(
    "alphanumeric",
    (value, element) => {
      var regex = new RegExp("^[a-zA-Z0-9]+$");
      var key = value;

      if (!regex.test(key)) {
        return false;
      }
      return true;
    },
    "Choose between letters from a(A) to z(Z) and numbers from 0 to 9."
  );

  $("#formSignUp").validate({
    rules: {
      username: {
        required: true,
        minlength: 3,
        maxlength: 20,
        alphanumeric: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
      passwordConfirmed: {
        required: true,
        minlength: 6,
        equalTo: "#registerPassword1",
      },
    },
    errorPlacement: (error, element) => {
      if (element.attr("name") == "username") {
        $("#usernameError").text($(error).text());
        $("#registerUsername").addClass("is-invalid");
      } else if (element.attr("name") == "email") {
        $("#emailError").text($(error).text());
        $("#registerEmail").addClass("is-invalid");
      } else if (element.attr("name") == "password") {
        $("#password1Error").text($(error).text());
        $("#registerPassword1").addClass("is-invalid");
      } else if (element.attr("name") == "passwordConfirmed") {
        $("#password2Error").text($(error).text());
        $("#registerPassword2").addClass("is-invalid");
      }
    },
  });
});
