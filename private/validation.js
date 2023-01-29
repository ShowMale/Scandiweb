const APP = {

  init() {
    APP.addListeners();
  },

  addListeners() {
    let sku = document.getElementById("sku");
    let name = document.getElementById("name");
    let price = document.getElementById("price");
    let weight = document.getElementById("genContent");

    let submit = document.getElementById("button-save");

    sku.addEventListener("input", APP.testField);
    name.addEventListener("input", APP.testField);

    submit.addEventListener("click", APP.missingError);

    price.addEventListener("input", APP.testNumber);
    weight.addEventListener("input", APP.testNumber);
  },

  missingError() {
    let inputs = ["sku", "name", "price", "size", "height", "width", "length", "weight"];
    for (let i = 0; i < inputs.length; i++) {
      const input = document.getElementById(inputs[i]);
      if (input != null) {
        const validityState = input.validity;
        if (validityState.valueMissing) {
          input.setCustomValidity("Please, submit required data.");
        } else {
          input.setCustomValidity("");
        }
        input.reportValidity();
      }
    }
  },

  testField(ev) {
    let fieldValue = ev.target;
    fieldValue.setCustomValidity("");
    let current = fieldValue.checkValidity();
    if (current) {
      let valueCheck = new RegExp("^[a-zA-Z0-9-:._ ]+$");
      if (valueCheck.test(fieldValue.value) === false) {
        fieldValue.setCustomValidity(
          "Please, provide [-:._ ] characters & alphanumeric."
        );
        fieldValue.reportValidity();
      }
    }
  },
  
  testNumber(num) {
    let fieldValue = num.target;
    fieldValue.setCustomValidity("");
    let current = fieldValue.checkValidity();
    if (current) {
      let valueCheck = new RegExp("^([0-9]+(\\.[0-9]{1,2})?)$");
      if (valueCheck.test(fieldValue.value) === false) {
        fieldValue.setCustomValidity(
          "Please, provide numbers in 0.00 format."
        );
        fieldValue.reportValidity();
      }
    }
  },
};

document.addEventListener("DOMContentLoaded", APP.init);
