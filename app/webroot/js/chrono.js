
$(function(){

    var t = undefined;
    var log = $("#log");
    var cl_thousandths = $("#thousandths");
    var cl_seconds = $("#seconds");
    var cl_minutes = $("#minutes");
    var cl_hours = $("#hours");
	
    function showTimer() {
      if(Number(cl_thousandths.html())%999>0.8){
        cl_thousandths.html("0.00");
        printDigit(cl_seconds);
        if(Number(cl_seconds.html())>59){
          cl_seconds.html("00");
          printDigit(cl_minutes);

        }
         else if(Number(cl_minutes.html())>59){
          cl_minutes.html("00");
          printDigit(cl_hours);

        }
       
		    }
   else           cl_thousandths.html((+cl_thousandths.html() + 0.015).toFixed(2));
		
	  }
	
	  function initTimer() {
		    t=setInterval(showTimer, 20);
	  }

	  function stopTimer() {
      clearInterval(t);
      t=undefined;
      		$('#duree').val(cl_hours.html() +":"+cl_minutes.html() +":"+cl_seconds.html());
	  }
	
   function changeTimer() {
      (!t)?initTimer() : stopTimer();
      console.log(t);
      if (t  !== undefined ){
      	$("#change").css("background-image","linear-gradient(45deg, #b91212, #ec8d8b)");
      }else{
      	$("#change").css("background-image","linear-gradient(45deg, #19a01e, #94efa0)");
      }
   }
	// Reset chronometer and clean up log.
   function resetTimer() {
      if (!t) {
        cl_thousandths.html("0.00");
        cl_seconds.html("00");
        cl_minutes.html("00");
        cl_hours.html("00");
        log.html("");
        log.hide();
      }
	   }

	
	   function printDigit(digit){
     
      var number = Number(digit.html().replace(/\s+/g, "")) + 1;
      var numberString;
     
		      (number<10)?numberString="0"+number : numberString=String(number);
     
      if(numberString.substring(1,2)==="1"){
        if(number<10)
          digit.html("0"+number);
        else
          digit.html(numberString.split("").join(" "));
      }
     
      else{
        if(number<10)
          digit.html("0"+number);
        else
          digit.html(number);
      }
    }
	
    $("#change").on('click', changeTimer);
    $("#init").on('click', resetTimer);



})
