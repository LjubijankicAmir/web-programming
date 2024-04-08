var countdownInterval = null;
function loadContestDetails() {
  let id = parseInt(sessionStorage.getItem("contestId"));
  fetch("../assets/json/contests.json")
    .then((response) => response.json())
    .then((data) => {
      console.log("JSON Fethced");
      var contest = data.contests.find(function (contest) {
        return contest.id === id;
      });

      if (contest) {
        console.log(id);
        document.querySelector("h2.space-need").textContent = contest.name;

        var countDownDate = new Date(contest.deadline_date).getTime();
        if (countdownInterval) {
          clearInterval(countdownInterval);
        }
        countdownInterval = setInterval(function () {
          var now = new Date().getTime();
          var distance = countDownDate - now;

          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
          );
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          document.querySelector(".days .value").innerText = days;
          document.querySelector(".hours .value").innerText = hours;
          document.querySelector(".minutes .value").innerText = minutes;
          document.querySelector(".seconds .value").innerText = seconds;

          if (distance < 0) {
            clearInterval(countdownInterval);
            document.querySelector(".counter").innerHTML =
              '<div class="expired"><h1 style="color: white">EXPIRED</h1></div>';
          }
        }, 1000);

        document.querySelector("#participantsAndSubmissions").innerHTML = `
        <ul>
        <li><span>Participants:</span> ${contest.participants}</li>
        <li><span>Submissions:</span> ${contest.submissions}</li>
        </ul>
        `;

        document.querySelector("#paragraph1").textContent = contest.paragraph1;
        document.querySelector("#paragraph2").textContent = contest.paragraph2;
        document.querySelector("#paragraph3").textContent = contest.paragraph3;
        document.querySelector("#paragraph4").textContent = contest.paragraph4;

        if (contest.entry_price === 0) {
          document.querySelector(".main-button").innerHTML = `
          <a href="#">Submit Your Photo</a>`;
        } else {
          document.querySelector(".main-button").innerHTML = `
            <a href="https://www.paypal.com">Proceed to Payment</a>`;
        }
      } else {
        console.error("Contest not found");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
