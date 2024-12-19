const btn = document.getElementById("scrollToTop");

window.onscroll = function () {
  scrollFunction();
};

const scrollFunction = () => {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btn.style.display = "block";
  } else {
    btn.style.display = "none";
  }
};

btn.addEventListener("click", backToTop);

const backToTop = () => {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
