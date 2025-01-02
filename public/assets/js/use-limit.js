const expenseLimitField = document.getElementById("limitInfo");
const expenseLimitCard = document.getElementById("limitInfoCard");

const moneySpentField = document.getElementById("cashSpent");
const moneySpentCard = document.getElementById("cashSpentCard");

const moneyLeftField = document.getElementById("cashLeft");
const moneyLeftCard = document.getElementById("cashLeftCard");

const amountField = document.getElementById("amount");
const dateField = document.getElementById("date");
const categoryField = document.getElementById("category");

amountField.addEventListener("input", (event) => {
  var val = event.target.value;
  showMoneyLeft(val);
});

categoryField.addEventListener("change", async () => {
  await showCategoryLimit();
  await showMoneySpent();
  showMoneyLeft("");
});

dateField.addEventListener("change", async () => {
  await showCategoryLimit();
  await showMoneySpent();
  showMoneyLeft("");
});

window.addEventListener("load", () => {
  showCategoryLimit();
  showMoneySpent();
  showMoneyLeft("");
});

const showCategoryLimit = async () => {
  var categoryId = categoryField.options[categoryField.selectedIndex].id;
  var category = categoryField.options[categoryField.selectedIndex].text.trim();

  if (category !== "Choose category") {
    var limitAmount = await getCategoryLimit(categoryId);

    if (limitAmount !== null) {
      expenseLimitCard.hidden = false;
      expenseLimitField.textContent = `${limitAmount} PLN`;
    } else {
      expenseLimitCard.hidden = true;
      expenseLimitField.textContent = "";
    }
  } else {
    expenseLimitCard.hidden = true;
    expenseLimitField.textContent = "";
  }
};

const getCategoryLimit = async (categoryId) => {
  try {
    const res = await fetch(`/api/limit/${categoryId}`);
    return await res.json();
  } catch (error) {
    console.log("ERROR: ", error);
  }
};

const showMoneySpent = async () => {
  var categoryId = categoryField.options[categoryField.selectedIndex].id;
  var category = categoryField.options[categoryField.selectedIndex].text.trim();
  var date = dateField.value;

  if (category !== "Choose category" && date !== "") {
    var amountSpent = await getMoneySpent(categoryId, date);

    if (amountSpent !== null) {
      moneySpentCard.hidden = false;
      moneySpentField.textContent = `${amountSpent} PLN`;
    } else {
      moneySpentCard.hidden = true;
      moneySpentField.textContent = "";
    }
  } else {
    moneySpentCard.hidden = true;
    moneySpentField.textContent = "";
  }
};

const getMoneySpent = async (categoryId, date) => {
  try {
    const res = await fetch(`/api/amount/${categoryId}/${date}`);
    return await res.json();
  } catch (error) {
    console.log("ERROR: ", error);
  }
};

const showMoneyLeft = (amountValue) => {
  var category = categoryField.options[categoryField.selectedIndex].text.trim();
  var date = dateField.value;

  moneyLeftField.style.color = "rgb(33, 37, 41)";

  if (category !== "Choose category" && date !== "" && amountValue !== "") {
    var limitInfo = expenseLimitField.textContent.replace(/[^0-9\.]/g, "");
    var moneySpent = moneySpentField.textContent.replace(/[^0-9\.]/g, "");

    if (limitInfo !== "") {
      moneyLeftCard.hidden = false;
      var cashLeft = Number(limitInfo) - Number(moneySpent) - amountValue;
      if (cashLeft >= 0) {
        moneyLeftField.style.color = "green";
      } else {
        moneyLeftField.style.color = "red";
      }
      moneyLeftField.textContent = `${cashLeft.toFixed(2)} PLN`;
    } else {
      moneyLeftCard.hidden = true;
    }
  } else {
    moneyLeftCard.hidden = true;
  }
};
