$(document).ready(function () {
  $.get(
    Constants.API_BASE_URL + "login_check.php",
    function (response) {
      if (response.logged_in) {
        $("#modal_trigger")
          .html('<i class="fa fa-user"></i> Logout')
          .off()
          .click(function (event) {
            event.preventDefault();
            $.post(Constants.API_BASE_URL + "logout.php", function () {
              location.reload();
            });
          });
      } else {
        console.log("User is not logged in");
      }
    },
    "json"
  ).fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Request failed: " + textStatus + ", " + errorThrown);
  });

  // Register form
  $("#register_forms").on("submit", function (event) {
    event.preventDefault();
    console.log("Register form submitted");

    var formData = {
      username: $("#register_username").val(),
      email: $("#register_email").val(),
      password: $("#register_password").val(),
      send_updates: $("#send_updates").is(":checked"),
    };

    $.post(
      Constants.API_BASE_URL + "register.php",
      formData,
      function (response) {
        console.log(response);
        location.reload();
      }
    ).fail(function () {
      console.log("Error occurred");
    });
  });

  // Login form
  $("#login_forms").on("submit", function (event) {
    event.preventDefault();

    var formData = {
      email: $("#email").val(),
      password: $("#password").val(),
    };

    $.post(
      Constants.API_BASE_URL + "login.php",
      formData,
      function (response) {
        console.log(response);
        if (response.success) {
          console.log("Login successful!");
          location.reload();
        } else {
          console.log("Login failed!");
          alert(response.message);
        }
      },
      "json"
    ).fail(function () {
      console.log("Error occurred");
    });
  });
});
