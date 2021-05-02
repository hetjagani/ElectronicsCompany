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
          <a class="nav-link" href="./teams.php">Teams</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./tasks.php">Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./customer_orders.php">Customer Orders</a>
        </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-right: 50px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user_data['e_fname'].' '.$user_data['e_lname']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
              if($_SESSION['employee_type'] === 'general_manager') {
                echo '<li><a class="dropdown-item" href="#">General Manager</a></li>';
              } else if($_SESSION['employee_type'] === 'project_manager') {
                echo '<li><a class="dropdown-item" href="#">Project Manager</a></li>';
              } else if($_SESSION['employee_type'] === 'inventory_manager') {
                echo '<li><a class="dropdown-item" href="#">Inventory Manager</a></li>';
              }  else if ($_SESSION['employee_type'] === 'employee'){
                echo '<li><a class="dropdown-item" href="#">Employee</a></li>';
              }
            ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/ElectronicsCompany/signout.php">Sign Out</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>