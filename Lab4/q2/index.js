$(document).ready(function () {
  $("#name").focus();
}); //function to start focus with name on page ready
// Function to jump from box to another for auto focusing in telephone
function num(ele) {
  let maxLength;
  if (ele.id == "tel1") maxLength = 4;
  else maxLength = 3;
  if (ele.value.length == maxLength) {
    if (
      ele.nextElementSibling != null &&
      ele.nextElementSibling.name == "tel"
    ) {
      ele.nextElementSibling.focus();
      return;
    } else {
      ele.nextElementSibling.nextElementSibling.nextElementSibling.focus();
    }
  }
}
