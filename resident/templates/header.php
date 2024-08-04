<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

<!-- Fonts and icons -->
<script src="assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/atlantis.css">
<link rel="stylesheet" href="assets/css/custom.css">

<style>
    #loading-container{
        position: absolute;
        display: flex;
        height: 100%;
        width: 100%;
        background-color: white;
        z-index: 9999;
    }
    #loading-screen{
        position: absolute;
        left: 48%;
        top: 48%;
        z-index: 9999;
        text-align: center;
    }


    body::-webkit-scrollbar {
       

       width: 8px;               /* width of the entire scrollbar */
     }
     
     body::-webkit-scrollbar-track {
       background: lightgray;        /* color of the tracking area */
     }
     
     body::-webkit-scrollbar-thumb {
       background-color: gray;    /* color of the scroll thumb */
       border-radius: 10px;       /* roundness of the scroll thumb */
       border: 2px solid gray;  /* creates padding around scroll thumb */
     }


     #nameError {
display: none;
font-size: 0.8em;
}

#nameError.visible {
display: block;
}


.loginform{

display: none;
}

.otp{

    display:none;
}




#email_error {
display: none;
font-size: 0.8em;
}

#email_error.visible {
display: block;
}


#email_valid {
display: none;
font-size: 0.8em;
}

#email_valid.visible {
display: block;
}


#loading {
display: none;
font-size: 0.8em;
}

#loading.visible {
display: block;
}




    
</style>
