<?php

include('server/serverhome.php');




 

		

		if(!empty($_POST['fname'])){



			$_SESSION['fname']		   = $conn->real_escape_string($_POST['fname']);
			$_SESSION['mname']	 		   = $conn->real_escape_string($_POST['mname']);
			$_SESSION['lname']	= $conn->real_escape_string($_POST['lname']);
			$_SESSION['suffix']		   = $conn->real_escape_string($_POST['suffix']);
		
			$_SESSION['bdate']	 		    = $conn->real_escape_string($_POST['bdate']);
			$_SESSION['bplace']			= $conn->real_escape_string($_POST['bplace']);
			//$age 		    = $conn->real_escape_string($_POST['age']);
			
		
			$_SESSION['cstatus']			= $conn->real_escape_string($_POST['cstatus']);
			$_SESSION['citizenship']	        = $conn->real_escape_string($_POST['citizenship']);
			$_SESSION['gender']			= $conn->real_escape_string($_POST['gender']);
		
		
			$_SESSION['religion']			= $conn->real_escape_string($_POST['religion']);
		
			$_SESSION['contact']			= $conn->real_escape_string($_POST['contact_no']);
			$_SESSION['occupation']		    = $conn->real_escape_string($_POST['occupation']);
		
			$_SESSION['class_sec']			= $conn->real_escape_string($_POST['class_sec']);
		
			$_SESSION['educ']		    = $conn->real_escape_string($_POST['educ']);
			
			$_SESSION['los']		    = $conn->real_escape_string($_POST['los']);
		
			$_SESSION['m_income']		= $conn->real_escape_string($_POST['m_income']);
			
		
			//$hof 	= $conn->real_escape_string($_POST['headoffamily']);
			$_SESSION['pwd']	    = $conn->real_escape_string($_POST['pwd']);
		
		
			$_SESSION['ename']		= $conn->real_escape_string($_POST['ename']);
			$_SESSION['eno']	   = $conn->real_escape_string($_POST['eno']);
		
		 
		
		
			$_SESSION['vbrand']		= $conn->real_escape_string($_POST['vbrand']);
			$_SESSION['vstatus']			    = $conn->real_escape_string($_POST['vstatus']);
			$_SESSION['ailment']			    = $conn->real_escape_string($_POST['ailment']);
			$_SESSION['bloodtype']		= $conn->real_escape_string($_POST['bloodtype']);
		
		
			$_SESSION['height']			= $conn->real_escape_string($_POST['height']);
			$_SESSION['weight']	     = $conn->real_escape_string($_POST['weight']);
			$_SESSION['preg']	     = $conn->real_escape_string($_POST['preg']);
			$_SESSION['singleparent']	     = $conn->real_escape_string($_POST['singleparent']);
		
			include 'household.php';
		

	
	}


	

        
        
	
?>