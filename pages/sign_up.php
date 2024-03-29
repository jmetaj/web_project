<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign Up</title>

    <!-- Load required Meta tags, Bootstrap, CSS -->
    <div id="general-feature"></div>
    <script>
      fetch("../components/general.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("general-feature").innerHTML = data;
        });
    </script>
    <!-- End of General -->

    <!-- Load common navbar element -->
    <div id="navbar-feature"></div>
    <script>
      fetch("../components/navbar.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("navbar-feature").innerHTML = data;
        });
    </script>
    <!-- End of navbar -->

    <!-- Load sign up javascript -->
   

  </head>
  <body>
    <br />
    <br />
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="text-center">Sign Up</h2>
          <p class="text-center">
            To sign up you must fill in all the fields of the form that follows.
          </p>

          <!-- Form -->
          <form action="../includes/proccess.php" method="post">
            <br />
            <div class="form-group">
              <label for="username"><b>Username :</b></label>
              <input
                class="form-control"
                type="text"
                id="username"
                name="username"
                placeholder="Enter your username"
                required
              />
              <div class="error"></div>
            </div>
            <div class="form-group">
              <label for="email"><b>Email :</b></label>
              <input
                type="text"
                class="form-control"
                id="email"
                aria-describedby="emailHelp"
                placeholder="Enter your email"
                required
              />
              <div class="error"></div>
            </div>
            <div class="form-group">
              <label for="password"><b>Password :</b></label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter your password"
                required
              />
            </div>
            <div class="form-group">
              <label for="passwordConf"><b>Confirm Password :</b></label>
              <input
                type="password"
                class="form-control"
                id="passwordConf"
                placeholder="Re-enter your password"
                required
              />
              <div class="error"></div>
            </div>
            <button type="submit" class="btn btn-primary btn bg-dark">
              Submit
            </button>
            <small id="emailHelp" class="form-text text-muted"
              ><b>DISCLAIMER:</b> We'll never share your personal info with
              anyone else.</small
            >
          </form>
          <!-- End of form -->
        </div>
      </div>
    </div>

    <!-- Load common footer element -->
    <div id="footer-feature"></div>
    <script>
      fetch("../components/footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer-feature").innerHTML = data;
        });
    </script>

    <!-- End of footer -->
  </body>
</html>
