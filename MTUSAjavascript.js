function _(id){
  return document.getElementById(id);
}

$(document).ready(function(){
  $('#contactForm').on('submit', function(event){
    event.preventDefault();
    if($('#fullName').val() == "")
    {
      alert("Name is required");
    }
    else if($('#companyName').val() == "")
    {
      alert("Company name is required");
    }
    else if($('#companyLocation').val() == "")
    {
      alert("Company location is required");
    }
    else if($('#contactEmail').val() == "")
    {
      alert("Contact email is required");
    }
    else if($('#contactPhoneNumber').val() == "")
    {
      alert("Contact phone number is required");
    }
    else if($('#msg').val() == "")
    {
      alert("Message is required");
    }
    else
    {
      $.ajax({
        url:"sendContactForm.php",
        method:"POST",
        data:$('#contactForm').serialize(),
        success:function(data)
        {
          if (data == "CAPTCHA") {
            alert("Please make sure you check the security CAPTCHA box.");
          }
          else if (data == "error") {
            alert("Mail not sent. Please send an email with the entered information directly to mtusainfo@microtipsusa.com.");
          }
          else {
            $('#contactForm')[0].reset();
            $('#contactModal').modal('hide');
            alert("Your contact request has been sent!");
          }
        }
      });
    }
  });
});

$(document).ready(function(){
  $('#subscribe-form').on('submit', function(event){
    event.preventDefault();
    if($('#email').val() == "")
    {
      alert("Email is required");
    }
    else
    {
      $.ajax({
        url:"../subscribe.php",
        method:"POST",
        data:$('#subscribe-form').serialize(),
        success:function(data)
        {
          $('#subscribe-form')[0].reset();
          alert("You have been added to the email list!");
        }
      });
    }
  });
});

// // Set the date we're counting down to
// var countDownDate = new Date("Jan 8, 2018 12:00:00").getTime();

// // Update the count down every 1 second
// var x = setInterval(function() {

//     // Get todays date and time
//     var now = new Date().getTime();
 
//     // Find the distance between now an the count down date
//     var distance = countDownDate - now;
    
//     // Time calculations for days, hours, minutes and seconds
//     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
//     // Output the result in an element with id="demo"
//     // document.getElementById("demo").innerHTML = days + " days <br>" + hours + " hours <br>" + minutes + " minutes <br>" + seconds + " seconds <br>";

//     document.getElementById("days").innerHTML = days;

//     document.getElementById("hours").innerHTML = hours;

//     document.getElementById("minutes").innerHTML = minutes;

//     document.getElementById("seconds").innerHTML = seconds;
    
//     // If the count down is over, write some text 
//     if (distance < 0) {
//         clearInterval(x);
//         document.getElementById("demo").innerHTML = "EXPIRED";
//     }
// }, 1000);

$(document).ready(function(){
    $("#contactBtn").click(function(){
        $("#contactModal").modal();
    });
});

function initMap() {
  var uluru = {lat: 28.601167, lng: -81.223228};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: uluru,
    clickableIcons: true
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}

!function(d,s,id){
  var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https';
  if(!d.getElementById(id)){
    js = d.createElement(s);
    js.id = id;
    js.src = p+"://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js,fjs);
  }
}
(document,"script","twitter-wjs");
