// DOMConententLoaded: Περιμένει να εκτελεστούν τα scripts
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const username = document.getElementById("username");
  const password = document.getElementById("password");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevents the immediate submit of the form
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();

    errorElements.forEach((errorElement) => {
      errorElement.innerText = "";
    });

    // Check if inputs correspond with a pair of username and password from the database
    fetch("/connection.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        username: usernameValue,
        password: passwordValue,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Εμφάνιση μηνύματος επιτυχούς σύνδεσης
          errorMessage.innerText = "Successful login!";
        } else {
          // Εμφάνιση μηνύματος λάθους
          errorMessage.innerText = "Invalid username or password.";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });

    // Allowing form submit
    if (!hasErrors()) {
      form.submit();
    }
  });
});
