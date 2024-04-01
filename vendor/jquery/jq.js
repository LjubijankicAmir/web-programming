$(document).ready(function() {

    var username;
    var email;
    var loginEmail
    var password;
    var loginPassword;
    var isChecked;
    var isLogged = false;


    $.getJSON("../assets/json/users.json", function(data) {


    $("#register_forms").submit(function(event) {
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

    $("#login_forms").submit(function(event) {
        event.preventDefault();

        loginEmail = $("#email").val();
        loginPassword = $("#password").val();


        if (loginEmail === email && loginPassword === password){

            console.log("LOG IN SUCCESSFUL");
            isLogged = true;
        } else {
            console.log("INVALID CREDENTIALS");
        }
    });
      
      var numberOfUsers = data.users.length;
      var userId = 4
      
      var user = data.users.find(function(user) {
        return user.id === userId;
      }); 


      if (user) {

        var output = "";
        var totalEarned = 0;
        var contestsWon = 0;
        var totalContests = user.submissions.length;

        user.submissions.forEach(submission => {
          console.log(submission)
          var imageSource = submission.imageSource;
          var award = submission.award;
          if(award == null){
            award = 0;
          }
          var positionWon = submission.positionWon;
          let positionString;
          switch(positionWon){
            case 1:
              positionString = "st";
              contestsWon++;
              break;
            case 2:
              positionString = "nd";
              break;
            case 3:
              positionString = "rd";
              break;
            default:
              positionString = "th";
          }
          var contestName = submission.contestName;
          totalEarned+=parseInt(award);
  
          output+= `
          <div class="col-lg-4">
           <div class="thumb"style="width: 400px; height: 300px;">
            <img src=${imageSource} alt="" style="width: 400px; height: 300px;">
            <div class="hover-effect">
              <div class="content">
                <h4>${contestName}</h4>
                <span>Ranked: <em>${positionWon}${positionString}</em></span>
                <span>Award Won: <em>$${award}</em></span>
                <ul>
                  <li><a href="#"><i class="fa fa-heart"></i></a></li>
                  <li><a href="#"><i class="fa fa-eye"></i></a></li>
                </ul>
              </div>
            </div>
           </div>
          </div>
          `
        });
        
        var username = user.username;
        var avatar;
        if(user.avatar == null){
          avatar = "../assets/images/default_avatar.jpg";
        }
        else{
          avatar = user.avatar;
        }
        var rank = user.rank;
        var rating = user.rating;
        var favoriteCategory = user.favoriteCategory;
        var profileViews = user.profileViews;
        
        $(".user-info").html(`
        <div class="container">
         <div class="row">
          <div class="col-lg-12">
            <div class="avatar">
              <img src=${avatar} alt="" style="width: 200px; height: 170px;">
              <h4>${username}</h4>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Rank</h6>
              <h4>${rank}</h4>
              <span>of ${numberOfUsers}</span>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Ratings</h6>
              <h4>${rating}</h4>
              <span>of 5.00 Stars</span>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Favorite</h6>
              <h4>${favoriteCategory}</h4>
              <span>Picture Category</span>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Profile Views</h6>
              <h4>${profileViews}</h4>
              <span>Monthly</span>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Contests Won</h6>
              <h4>${contestsWon}</h4>
              <span>of ${totalContests}</span>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="info">
              <h6>Total Earned</h6>
              <h4>$${totalEarned}</h4>
              <span>All Time</span>
            </div>
          </div>
        </div>
       </div>
        `);
        document.getElementById("portfolio-row").innerHTML = output;
        
      } else {
        $(".user-info").html(`
        <div class="container">
         <div class="row">
          <div class="col-lg-12">
            <div class="avatar">
              <img src="../assets/images/default_avatar.jpg" alt="" style="width: 200px; height: 170px;">
              <h4>Log in or make an account</h4>
            </div>
          </div>`
      )
      document.getElementById("portfolio-row").innerHTML = `<div style="margin-bottom: 183px;"></div>`;
    }
    
    });

});







        
