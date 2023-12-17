const form = document.querySelector("form");

const elements = {
  fullName: {
    input: document.querySelector("#fullName"),
  },
  companyName: {
    input: document.querySelector("#companyName"),
  },
  email: {
    input: document.querySelector("#email"),
  },
  phoneNumber: {
    input: document.querySelector("#phoneNumber"),
  },
};

const patterns = {
  fullName: /^([a-zA-Z\s]+)$/,
  companyName: /^([a-zA-Z\d.\-_\s]+)$/,
  email:
    /^([a-zA-Z\d.\-_]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})?$/,
  phoneNumber: /^\+389([\d]{8,9})$/,
};

form.addEventListener("submit", validateForm);

function validateForm(e) {
  e.preventDefault();

  for (const [fieldName, { input }] of Object.entries(elements)) {
    const isValid = validate(input, patterns[fieldName]);
    updateElementStyle(input, isValid);
  }
}

function validate(field, regex) {
  return regex.test(field.value);
}

function updateElementStyle(element, isValid) {
  element.style.outline = isValid ? "2px solid limegreen" : "2px solid red";
}

function updateElementVisibility(element, isVisible) {
  element.classList.toggle("show", isVisible);
}

document.querySelectorAll("input").forEach((input) => {
  input.addEventListener("keyup", (e) => {
    validate(e.target, patterns[e.target.attributes.name.value]);
    updateElementStyle(
      e.target,
      patterns[e.target.attributes.name.value].test(e.target.value)
    );
  });
});
