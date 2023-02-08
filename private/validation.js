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

    let productType = document.getElementById("productType");

    sku.addEventListener("input", APP.testField);
    name.addEventListener("input", APP.testField);

    submit.addEventListener("click", APP.missingError);

    price.addEventListener("input", APP.testNumber);
    weight.addEventListener("input", APP.testNumber);

    productType.addEventListener("change", APP.addFunction);
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

// This function generates content based on product's type

  addFunction() {

    const dvd = `
      <br>
      <label for="size">Size (MB) *</label>
      <br>

      <input name="size" required 
      type="number" id="size" 
      min="1" max="1000000000" 
      autocomplete="off"
      value="<?php echo $_POST['size] ?? ''; ?>">
      <span class="check"></span>
      <br>
      <span id="description">Please, provide size.</span>
      <br>`;

    const furniture = `
      <br>
      <label for="height">Height (cm) *</label>
      <br>

      <input name="height" required 
      type="number" id="height"
      min="1" max="100000" 
      autocomplete="off"
      value="">
      <span class="check"></span>
      <br><br>
      <label for="width">Width (cm) *</label>
      <br>

      <input name="width" required 
      type="number" id="width" 
      min="1" max="100000" 
      autocomplete="off"
      value="">
      <span class="check"></span>
      <br><br>
      
      <label for="length">Length (cm) *</label>
      <br>

      <input name="length" required 
      type="number" id="length" 
      min="1" max="100000" 
      autocomplete="off"
      value="">
      <span class="check"></span>
      <br>
      <span id="description">Please, provide dimensions.</span>
      <br>`;

    const book = `
      <br>
      <label for="weight">Weight (kg) *</label>
      <br>

      <input name="weight" required
      type="text" id="weight" 
      minlength="1" maxlength="10" 
      autocomplete="off"
      value="">
      <span class="check"></span>
      <br>
      <span id="description">Please, provide weight.</span>
      <br>`;

    let type = productType.value;
    let content = document.getElementById("genContent");
    
    if (type === "dvd") {
      content.innerHTML = dvd;
    } else if (type === "furniture") {
        content.innerHTML = furniture;
    } else if (type === "book") {
        content.innerHTML = book;
    } else {
        content.innerHTML = "";
    }

  },

};

document.addEventListener("DOMContentLoaded", APP.init);
