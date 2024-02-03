// Get references to the input elements in the form
var form = document.getElementById('regForm');
var surnameInput = document.getElementsByName('surname')[0];
var csse_indexInput = document.getElementsByName('CSSE_index')[0];
var regNoInput = document.getElementsByName('regNo')[0];


// Add an event listener for when the form is submitted
form.addEventListener('submit', function(event) {
  // Prevent the default form submission behavior
  event.preventDefault();
  
  // Validate the input values
  var nameValid = validatesurname();
  var indexValid = validateCSSE_index();
  var regNoValid = validateregNo();

  // If all inputs are valid, submit the form
  if (nameValid && indexValid && regNoValid) {
    form.submit();
  }
});


// Set up event listeners for when the user changes the input values
// surnameInput.addEventListener('input', validatesurname);
// csse_indexInput.addEventListener('input', validateCSSE_index);
// regNoInput.addEventListener('input', validateregNo);

// Function to validate the name input
function validatesurname() {
  var nameValue = surnameInput.value.trim();
  if (/^[A-Z]+$/.test(nameValue)) {
    surnameInput.style.borderColor = 'green';
    surnameInput.setCustomValidity('');
  } else {
    surnameInput.style.borderColor = 'red';
    surnameInput.setCustomValidity('Name must be a capital letter only');
  }
}

// Function to validate the index input
function validateCSSE_index() {
  var indexValue = csse_indexInput.value.trim();
  if (/^s\d{4}\.\d{4}\.\d{4}$/.test(indexValue)) {
    csse_indexInput.style.borderColor = 'green';
    csse_indexInput.setCustomValidity('');
  } else {
    csse_indexInput.style.borderColor = 'red';
    csse_indexInput.setCustomValidity('Index must be in the form of s1706.0142.2018');
  }
}

// Function to validate the regNo input
function validateregNo() {
  var regNoValue = regNoInput.value.trim();
  if (/^20023022\d*$/.test(regNoValue)) {
    regNoInput.style.borderColor = 'green';
    regNoInput.setCustomValidity('');
  } else {
    regNoInput.style.borderColor = 'red';
    regNoInput.setCustomValidity('RegNo must start with pre defined numbers like 20023022');
  }
}
