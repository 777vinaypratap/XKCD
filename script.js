$(document).ready(function() {
    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( email );
      }
      
    var emailVal;


$("#inpt-box button").on("click", function(){
    var inpt=$(this).parent().find("input"), p=$(this).parent().find("p")
    var email=inpt.val();
    emailVal= validateEmail( email );
    if( emailVal){
  //       $.post("register.php",
  // {
  //   email:email
  // },
  // function(data, status){
  //   console.log("The data is over here: " + data+ " with the given status: " + status)
  // });

      $.ajax({
        type: "POST",
        url: "register.php",
        data: {email:email},
        beforeSend: function(){
          $("#inpt-box").append('<img id="loader" style="position:absolute;left:50%;top:100px; transform:translate(-50%,0%);" src="./public/loaderblue.gif" alt="" srcset="">')
        },
        success: function (data,status) {
          $('#loader').remove();
          p.show();
          p.text(data);
          p.css('color','#118AB2');
        },
        error: function (XMLrequest, status, err){
          console.log("There is a problem. Please try again later.");
        }
      });

    }
    else{
        inpt.css("outline","solid 1px #EF476F");
        p.show();
        p.text("Incorrect email address !!! ")
        p.css('color','#EF476F');

    }
})
    
$("#inpt-box input").on("keyup", function(e){
        if(e.keyCode === 13){
            $("#inpt-box button").click();
        }
        else if(emailVal===false){
           $(this).css('outline', '');
           $("#inpt-box p").hide();
        }
})



})