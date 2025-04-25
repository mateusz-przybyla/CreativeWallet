# CreativeWallet

CreativeWallet is the final stage of a multi-paradigm budgeting app, now built in PHP with a custom MVC framework.

## Table of contents

- [Overview](#overview)
  - [Stages](#stages)
  - [About](#about)
  - [How it works](#how-it-works)
  - [Additional features](#additional-features)
- [Architecture](#architecture)
  - [Custom Framework](#custom-framework)
  - [Database design](#database-design)
  - [Screenshots](#screenshots)
- [My process](#my-process)
  - [Built with](#built-with)
  - [Useful resources](#useful-resources)

## Overview

### Stages

Stages of building a budget application:

1. **PersonalBudget** - Console app written in **C++**:

   - **Structured paradigm:** [View project](https://github.com/mateusz-przybyla/PersonalBudget_Structured)
   - **Object-oriented paradigm:** [View project](https://github.com/mateusz-przybyla/PersonalBudget_ObjectOriented)

2. **CreativeWallet** – Web app written in **PHP**:
   - **Frontend only:** [View project](https://github.com/mateusz-przybyla/CreativeWallet_FE)
   - **Frontend + Backend (structured paradigm):** [View project](https://github.com/mateusz-przybyla/CreativeWallet_FE_BE)
   - **Frontend + Backend (OOP with custom MVC framework):** _this repository_

---

### About

**CreativeWallet** is a web application and a modern (more complex) version of the original **PersonalBudget** app written in C++.  
It allows users to keep track of expenses and incomes, with data stored in a **MySQL** database.

---

### How it works

1. Create a user account and sign in.
2. Add incomes or expenses using today's date or a selected backdate.
3. View balances for:
   - the current month,
   - the previous month,
   - or any custom time period.

The app calculates:

- total incomes,
- total expenses,
- and the balance (incomes – expenses).

---

### Additional features

- 📋 Tabular summaries of incomes and expenses by category.
- 📊 A pie chart showing expenses in a selected time period.
- 🛠️ Add/edit/delete categories and payment methods.
- 💸 Set monthly limits on expense categories.
- 🔐 Change password.
- 🧹 Delete your account along with all related transactions.

---

## Architecture

### Custom Framework

CreativeWallet is divided into two components: the **application** and a **custom MVC framework**.

- The **application component** includes project-specific code that is tightly coupled to this project.
- The **framework component** contains reusable tools designed to be portable and flexible.

This project uses the **MVC (Model-View-Controller)** design pattern to separate concerns and organize code effectively:

- **Model** – handles database logic.
- **View** – manages templates and UI rendering (HTML).
- **Controller** – contains the logic that connects user input with the model and view.

#### Tools included in the framework:

- `Router` - for mapping URLs to controllers.
- `Validator` - for input validation.
- `Database` - abstraction layer for DB access (PDO-based).
- `Template Engine` - for generating dynamic HTML.
- `Container` – for dependency injection and object management.

The `App` class inside the framework component is like a **glue** for the available tools and utilizes every tools.

---

### Database design

📄 [View DB project (PDF)](https://github.com/mateusz-przybyla/CreativeWallet_FE_BE/blob/main/DB_project.pdf)

---

### Screenshots

**Home page**

![](/readme/home.jpg)

**Sign up form**

![](/readme/sign-up.jpg)

**Sign in form**

![](/readme/sign-in.jpg)

**New income form**

![](/readme/add-income.jpg)

**Frontend and backend form validation**

![](/readme/form-validation.jpg)

**New expense form with limit info**

![](/readme/add-expense.jpg)

**Balance sheet – view expenses and incomes by category for a selected time period**

![](/readme/show-balance1.jpg)

**Balance sheet - income/expense list + pie chart**

![](/readme/show-balance2.jpg)

**Transaction settings – category/payment method management**

![](/readme/transaction-settings.jpg)

**Transaction settings – expense limit activation**

![](/readme/expense-limit-activation.jpg)

**User account settings**

![](/readme/user-account-settings.jpg)

**Mobile view**

![](/readme/mobile.jpg)

## My process

### Built with

**Frontend:**

- Bootstrap
- HTML, CSS
- JavaScript, jQuery
- JavaScript chart library

**Backend:**

- OOP PHP
- Design patterns: MVC, Singleton, Factory, Dependency Injection
- Reflective programming (`ReflectionClass`)
- SQL queries
- Custom Exceptions
- Composer & Packagist
- Development environment - XAMPP (MySQL, Apache, phpMyAdmin)

---

### Useful resources

- https://www.udemy.com/course/complete-modern-php-developer/
- https://www.php.net/manual/en/
- https://getcomposer.org/
- https://regex101.com/
- https://json-ld.org/
- https://mariadb.com/
- https://www.php-fig.org/psr/
- https://miroslawzelent.pl/kurs-php/
- https://miroslawzelent.pl/kurs-mysql/
- https://miroslawzelent.pl/kurs-bootstrap/
- https://getbootstrap.com
- https://www.php.net
- https://canvasjs.com/
- https://www.geeksforgeeks.org
- https://stackoverflow.com
- https://jquery.com/
