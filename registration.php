<?php
  require_once "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type = "text/css" href="css/bootstrap.min.css">
</head>
<body>
<div>
	<?php
	
	?>	
</div>
    <div>
        <form action="registration.php" method = "post">
            <div class = "container">

                <div class="row">
                    <div class = "col-sm-3">
                        <h1>Registration</h1>
                        <hr class = "mb-3">
                        <label for="username"><b>username</b></label>
                        <input class = "form-control is-valid" type="text" id= "username" name = "username" placeholder = "Username" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>

                        <label for="email"><b>email</b></label>
                        <input class = "form-control" type="email" id= "email" name = "email" placeholder = "Enter email" required>

                        <label for="pass"><b>password</b></label>
                        <input class = "form-control" type="password"  id= "pass" name = "pass" placeholder = "Password" required>
                        <hr class = "mb-3">
                        <input class = "btn btn-dark" type="submit" id= "register" name = "submit" value = "sign up">
                    </div>    
                </div>        
            </div>
        </form>
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