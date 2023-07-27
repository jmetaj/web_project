// DOMConententLoaded: Περιμένει να εκτελεστούν τα scripts
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const username = document.getElementById("username");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const passwordConf = document.getElementById("passwordConf");
  const errorElements = document.querySelectorAll(".error");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevents the immediate submit of the form

    // Η trim() κόβει τα κενά που μπορεί να περιέχουν οι είσοδοι
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordConfValue = passwordConf.value.trim();

    errorElements.forEach((errorElement) => {
      errorElement.innerText = "";
    });

    // Check username
    if (usernameValue === "") {
      setError(username, "Username is required");
    }

    // Check email
    if (emailValue === "") {
      setError(email, "Email is required");
    } else if (!isValidEmail(emailValue)) {
      setError(email, "Provide a valid email address");
    }

    // Check password
    if (passwordValue === "") {
      setError(password, "Password is required");
    } else if (!isValidPassword(passwordValue)) {
      setError(
        password,
        "Password must be at least 8 characters long and also contain at least one uppercase letter, one number, and one symbol"
      );
    }

    // Check password confirmation
    if (passwordConfValue === "") {
      setError(passwordConf, "You need to confirm your password");
    } else if (passwordConfValue !== passwordValue) {
      setError(passwordConf, "Passwords do not match");
    }

    // Allowing form submit
    if (!hasErrors()) {
      form.submit();
    }
  });

  function setError(element, message) {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector(".error");

    errorDisplay.innerText = message;
    inputControl.classList.add("error");
  }

  function isValidEmail(email) {
    //Regular expression για έλεγχο της μορφής του email
    const email_regex =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return email_regex.test(String(email).toLowerCase());
  }

  function isValidPassword(password) {
    if (password.length < 8) {
      return false;
    }
     //Regular expression για έλεγχο της μορφής του password
    const password_regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]+$/;
    return password_regex.test(password);
  }

  function hasErrors() {
    let hasError = false;
    errorElements.forEach((errorElement) => {
      if (errorElement.innerText !== "") {
        hasError = true;
      }
    });
    return hasError;
  }
});
