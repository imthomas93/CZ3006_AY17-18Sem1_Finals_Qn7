<html xmlns="http://www.w3.ord/1999/xhtml">
 <head>
  <title>Registration</title>
  <script type = "text/javascript">
  <!--
  		function chkID(){
  			var inputID = document.getElementById("userID");
  			var pos = inputID.value.search(/^[a-zA-Z]\d{7}$/);
  			if (pos == -1){
  				alert("Please re-enter a valid user ID");
  				inputID.focus();
  				inputID.select();
  				return false;
  			}
  			else{
  				return true;
        }
  		}
  //--></script></head>

 <body>
 	<form action = "registration.php" Method = "POST">
 		<?php
 			if (!isset($_POST["userID"])){
 				print("ID registration <input type = \"text\" name = \"userID\" id =\"userID\" onchange=\"chkID()\" />");
 				print("<br/><input type = \"reset\" value =\"reset form\" />");
 				print("<input type = \"submit\" value =\"submit form\" />");
 			}
 			else{
 				$theID = $_POST["userID"];
 				$duplicate = false;
 				$file = fopen("record.dat", "r");
 				while(!feof($file)){
 					$record = explode(":", fgets($file));
 					if ($record[1] == $theID){
 						$duplicate = true;
 						break;
 					}
 				}
 				fclose($file);

 				if ($duplicate){
 					print("This ID has been used by others. Please input a different ID. <br/>");
          print("ID registration <input type = \"text\" name = \"userID\" id =\"userID\" onchange=\"chkID()\" />");
 					print("<br/><input type = \"reset\" value =\"reset form\" />");
 					print("<input type = \"submit\" value =\"submit form\" />");
 				}
 				else{
 					$output = "UserID:".$_POST["userID"].":\r\n";
 					$file = fopen("record.dat", "a");
 					fwrite($file, $output);
 					fclose($file);
 					print("ID registration successful.");
 				}
 			}

 		?> 			
 	</form>
 </body>
</html>