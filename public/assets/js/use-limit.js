const expenseLimitField = document.getElementById("limitInfo");
const expenseLimitCard = document.getElementById("limitInfoCard");

const moneySpentField = document.getElementById("cashSpent");
const moneySpentCard = document.getElementById("cashSpentCard");

const moneyLeftField = document.getElementById("cashLeft");

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

  if (category === "Choose category") {
    expenseLimitField.textContent = "Category required";
  } else {
    var limitAmount = await getCategoryLimit(categoryId);

    if (limitAmount === null) {
      expenseLimitField.textContent = "No limit set";
    } else {
      expenseLimitField.textContent = `${limitAmount} PLN`;
    }
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

  if (category === "Choose category" || date === "") {
    moneySpentField.textContent = "Category and date required";
  } else {
    var amountSpent = await getMoneySpent(categoryId, date);

    if (amountSpent === null) {
      moneySpentField.textContent =
        "You did not spent any money for this category this month";
    } else moneySpentField.textContent = `${amountSpent} PLN`;
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

  if (category === "Choose category" || date === "" || amountValue === "") {
    moneyLeftField.textContent = "Category, date and amount required";
  } else {
    var limitInfo = expenseLimitField.textContent.replace(/[^0-9\.]/g, "");
    var moneySpent = moneySpentField.textContent.replace(/[^0-9\.]/g, "");

    if (limitInfo === "") {
      moneyLeftField.textContent = "No limit set";
    } else {
      var cashLeft = Number(limitInfo) - Number(moneySpent) - amountValue;
      if (cashLeft >= 0) {
        moneyLeftField.style.color = "green";
      } else {
        moneyLeftField.style.color = "red";
      }
      moneyLeftField.textContent = `${cashLeft.toFixed(2)} PLN`;
    }
  }
};
