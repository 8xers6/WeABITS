<?php include 'server/server.php' 


?>





<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>notif-  Barangay Management System</title>

    <style>



input {
  border: 2px solid #333;
  padding: 7px 7px;
  font-weight:bold;
  width: 35px;
  text-align: center;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}


</style>
</head>
<body >
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
	

		
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="justify-content-center">
							<div>
								<h2 class="text-white text-center fw-bold"></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					




                        <div class="row mt--2 justify-content-center">
            
            <div class="col-md-4">

                    

             <div class="card border">
                 <div class="card-header bg-primary-gradient">
                     <div class="card-head-row">
                         <div class="card-title fw-bold text-white">OTP - Email Verification</div>
                         <div class="card-tools">
                         <button type="submit" class="btn btn-primary fw-bold" id='resend'>Resend</button>
                             
                         </div>
                     </div>
                 </div>
                 <div class="card-body" >


                 <?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? ' text-light' : null ?> " role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>


                 <form method="POST" action="model/otp.php">
                     <div class="text-center">
                   <!---  <div class='fw-bold mb-3'>OTP - code expires in: <span id="timer"></span></div> --->
                     <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code1"
      name="num1"
      class="text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 1)"
      onKeydown="keydownHandler(event, 'code', 1)"
      onKeyup="autotab(event, 1, 'code2')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code2"
      name="num2"
      class="text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 2)"
      onKeydown="keydownHandler(event, 'code', 2)"
      onKeyup="autotab(event, 2, 'code3')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code3"
      name="num3"
      class="text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 3)"
      onKeydown="keydownHandler(event, 'code', 3)"
      onKeyup="autotab(event, 3, 'code4')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code4"
      name="num4"
      class="text-center w-8 xxs:w-12 mx-1 border-primary rounded "
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 4)"
      onKeydown="keydownHandler(event, 'code', 4)"
      onKeyup="autotab(event, 4, 'code5')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code5"
      name="num5"
      class="text-center w-8 xxs:w-12 mx-1 border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 5)"
      onKeydown="keydownHandler(event, 'code', 5)"
      onKeyup="autotab(event, 5, 'code6')"
      required
    />

    <input
      type="number"
      inputmode="numeric"
      pattern="\d"
      title="Numeric"
      onKeyPress="if(this.value.length===1) return false;"
      id="code6"
      name="num6"
      class="text-center w-8 xxs:w-12 mx-1  border-primary rounded"
      maxlength="1"
      onPaste="pasteHandler(event, 'code', 6)"
      onKeydown="keydownHandler(event, 'code', 6)"
      onKeyup="autotab(event, 6, 'code7')"
      required
    />
                     </div>
                     
                   
                    
                     <div class="row justify-content-center m-4">
                     
                         <button type="submit" class="btn btn-primary" id='buttones'>Submit</button>
                     </div>
                     </form>

             </div>

         </div>
 
 </div>




				
				

                        
					
				</div>

             
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		
		
	</div>
	<?php include 'templates/footer.php' ?>


    <script>


/*

let timerOn = true;

document.getElementById('resend').disabled =true ;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }

  document.getElementById('resend').disabled =false;
  document.getElementById('buttones').disabled = true;
  // Do timeout stuff here


}

timer(10);

*/

</script>



    <script>



      let inputVal = [];

      const isKeyInput = (e) => {
        // exclude backspace, tab, shift, ctrl, alt, esc and arrow keys
        return (
          [8, 9, 16, 17, 18, 27, 37, 38, 39, 40, 46].indexOf(e.which) === -1
        );
      };

      const isNumberInput = (e) => {
        var charKey = e.key;
        return !isNaN(charKey) || charKey.toLowerCase() === "backspace";
      };

      const autotab = (e, currentPosition, to) => {
        const currentElement = e.currentTarget;
        // if (currentElement.type === "number" && !isNumberInput(e)) {
        //   e.preventDefault();
        //   return;
        // }
        if (
          isKeyInput(e) &&
          currentElement.getAttribute &&
          !e.ctrlKey &&
          currentElement.value.length >=
            currentElement.getAttribute("maxlength")
        ) {
          if (to) {
            const elem = document.getElementById(to);
            if (elem) {
              elem.focus();
              elem.select();
            }
          }
        }
        inputVal[currentPosition] = currentElement.value;
      };

      const keydownHandler = (e, prefix, currentPosition) => {
        const currentElement = e.currentTarget;
        if (e.which === 8 && currentElement.value.length === 0) {
          // go to previous input when backspace is pressed
          const elem = document.getElementById(
            `${prefix}${currentPosition - 1}`
          );
          if (elem) {
            elem.focus();
            elem.select();
            e.preventDefault();
            return;
          }
        }
        // only allows numbers (prevents e, +, - on input number type)
        if (
          // currentElement.type === "number" &&
          e.which === 69 ||
          e.which === 187 ||
          e.which === 189 ||
          e.which === 190 ||
          !isNumberInput(e)
        ) {
          e.preventDefault();
          return;
        }
      };

      const pasteHandler = (e, prefix, currentPosition) => {
        const clipboardData = e.clipboardData || window.clipboardData;
        const pastedData = clipboardData.getData("Text");
        let inputPos = currentPosition;
        let strIndex = 0;
        let elem;
        do {
          elem = document.getElementById(`${prefix}${inputPos}`);
          if (elem && pastedData[strIndex]) {
            elem.value = pastedData[strIndex];
            elem.dispatchEvent(new Event("input"));
            e.preventDefault();
          }
          strIndex++;
          inputPos++;
        } while (elem && strIndex < pastedData.length);
      };

      const loadValues = (tfaValue, prefix) => {
        if (tfaValue && tfaValue[0]) {
          inputVal = tfaValue[0].split("");
          inputVal.forEach((val, index) => {
            const inputElement = document.getElementById(`${prefix}${index}`);
            if (inputElement) {
              inputElement.value = val;
              inputElement.className =
                inputElement.className + " border border-solid border-red";
              inputElement.dispatchEvent(new Event("input"));
            }
          });
        }
      };
    </script>

</body>
</html>


