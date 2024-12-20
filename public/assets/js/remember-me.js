const rmCheck = document.getElementById("rememberMe"),
  emailInput = document.getElementById("loginEmail");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  emailInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  emailInput.value = "";
}

const checkRememberMe = () => {
  if (rmCheck.checked && emailInput.value !== "") {
    localStorage.username = emailInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
};

document.getElementById("loginSubmit").addEventListener("click", () => {
  checkRememberMe();
});
