const username = document.getElementById("username");
const password = document.getElementById("password");
const form = document.querySelector("form");
const errorElement = document.getElementById("errorElement");

form.addEventListener("submit", (e) => {
  // warnings contains messages toward the user for all the things that could go wrong during sign up
  let warnings = [];
  if (!form.checkValidity()) {
    e.preventDefault();
  }

  form.classList.add("was-validated");


});
