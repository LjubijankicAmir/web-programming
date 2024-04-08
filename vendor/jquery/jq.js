$(document).ready(function () {
  var username;
  var email;
  var loginEmail;
  var password;
  var loginPassword;
  var isChecked;
  var isLogged = false;
  $("#register_forms").submit(function (event) {
    event.preventDefault();

    username = $("#register_username").val();
    email = $("#register_email").val();
    password = $("#register_password").val();
    isChecked = $("#send_updates").is(":checked");

    console.log("Username: " + username);
    console.log("Email: " + email);
    console.log("Password: " + password);
    console.log("Send updates: " + isChecked);
  });

  $("#login_forms").submit(function (event) {
    event.preventDefault();

    loginEmail = $("#email").val();
    loginPassword = $("#password").val();

    if (loginEmail === email && loginPassword === password) {
      console.log("LOG IN SUCCESSFUL");
      isLogged = true;
    } else {
      console.log("INVALID CREDENTIALS");
    }
  });
});
