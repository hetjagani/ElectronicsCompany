<?php 
  session_start(); 
  $user_query = 'SELECT * FROM employee WHERE e_id='.$_SESSION['user_id'].' LIMIT 1;';
  $run_query = mysqli_query($conn, $user_query) or die(mysqli_error($conn));
  $user_data = mysqli_fetch_assoc($run_query);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Electronics Company</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./projects.php">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./customers.php">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./suppliers.php">Suppliers</a>
        </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user_data['e_fname'].' '.$user_data['e_lname']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/ElectronicsCompany/signout.php">Sign Out</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>