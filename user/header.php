<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/templatemo.css">
<style>

.dropbtn {
  background-color: green;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
<nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                OSS
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                          <div class="dropdown">
                            <a class="nav-link" href="shoppingcart.php">Product</a>
                            <div class="dropdown-content">
                            <?php
                                        $sql="select Category_ID, Category_Name from category ";
                                        $q=mysqli_query($connect,$sql);
                                        while($row = mysqli_fetch_assoc($q)) {
                                    ?>
                            <a href="shoppingcart.php?catid=<?php echo $row['Category_ID']; ?>"><?php echo $row['Category_Name']; ?></a>
                            <?php
                                    }
                                    ?>
                              </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>

                        <?php
			                if(isset($_SESSION['login_user'])){
			            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="request.php">Sell Product</a>
                        </li>
                        <?php
			                }
			            ?>
                        <?php
			                if(isset($_SESSION['login_user'])){
			            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                        <?php
			                } else {
			            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log in</a>
                        </li>
                        <?php
			                }
			            ?>

                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <?php
			            if(isset($_SESSION['login_user'])){
			        ?>
                    <a class="nav-icon position-relative text-decoration-none" href="vieworder.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="profile.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <?php
			            }
			        ?>
                </div>
            </div>

        </div>
    </nav>