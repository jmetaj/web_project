<?php
  require_once "header.php";
  require_once "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid h-100 bg-light text-dark">
  <div class="row justify-content-center align-items-center">
    <div class="d-flex align-items-center justify-content-center vh-100">
	
        <form action="Sign_up.php" method = "post">
                <div class = "container">
				    <h1 class = "text-center">Sign UP</h1>
					
							<div class = "mb-3 form-control-sm">
                            <label for="username"><b>username</b></label>
                            <input class = "form-control" type="text" id= "username" name = "username" placeholder = "Username" required>
                            </div>

							<div class = "mb-3 form-control-sm">
                            <label for="email"><b>email</b></label>
                            <input class = "form-control" type="email" id= "email" name = "email" placeholder = "Enter email" required>
                            </div>

							<div class = "mb-3 form-control-sm">
                            <label for="pass" ><b>password</b></label>
                            <input class = "form-control" type="password"  id= "pass" name = "pass" placeholder = "Password" required>
                            </div>

                            <input class = "btn btn-dark" type="submit" id= "register" name = "submit" value = "sign up">
                           
                           
                </div>
        </form>
    </div>	
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type = "text/javascript">

$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var username 	= $('#username').val();
			var email	= $('#email').val();
			var pass 	= $('#pass').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'proccess.php',
					data: {username: username, email: email,pass: pass},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

		});		
	
	});

    </script>
</body>
</html>