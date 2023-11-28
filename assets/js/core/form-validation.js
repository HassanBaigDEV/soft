document.addEventListener("DOMContentLoaded", function () {
  const nameInput = document.querySelector(".email-sign-up-input");
  const emailInput = document.querySelector('input[type="email"]');
  const passwordInput = document.querySelector('input[type="password"]');
  const agreeCheckbox = document.getElementById("flexCheckDefault");
  const signUpButton = document.querySelector(".sign-up-btn");

  function validateForm() {
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    if (name === "" || email === "" || password === "") {
      alert("Please fill in all fields.");
      return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
      return false;
    }

    if (!agreeCheckbox.checked) {
      alert("Please agree to the Terms and Conditions.");
      return false;
    }

    return true;
  }

  signUpButton.addEventListener("click", function () {
    if (validateForm()) {
      alert("Form submitted successfully!");
    }
  });
});
