//PUT this into function on make them window.onload

var inputField = document.getElementById("input_field");
var returnedValue = inputField.value;

inputField.onfocus = function() {
   if ( inputField.value == returnedValue) {
      // console.log("field with " + returnedValue);
      inputField.setAttribute("value", "")
      // inputField.value == ""; DONT KNOW WHY THIS WAY DOES NOT WORK
   }
};

inputField.onblur = function() {
   if ( inputField.value == "") {
      // console.log("field vuoto");
      inputField.setAttribute("value", returnedValue)
      // inputField.value == returnedValue; DONT KNOW WHY THIS WAY DOES NOT WORK
   }
};

// console.log(inputField.value);
