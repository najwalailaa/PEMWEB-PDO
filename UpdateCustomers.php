<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['customerNumber'])) {
          //query SQL
          $customerNumber_upd = $_GET['customerNumber'];
          $query = $conn->prepare("SELECT * FROM customers WHERE customerNumber = '$customerNumber_upd'");

          //eksekusi query
          $query->bindParam(':customerNumber',$customerNumber_upd );

          $query->execute();
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $customerNumber = $_POST['customerNumber'];
      $customerName = $_POST['customerName'];
      $contactLastName = $_POST['contactLastName'];
      $contactFirstName = $_POST['contactFirstName'];
      $phone = $_POST['phone'];
      $addressLine1 = $_POST['addressLine1'];
      $addressLine2 = $_POST['addressLine2'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postalCode = $_POST['postalCode'];
      $country = $_POST['country'];
      $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
      $creditLimit = $_POST['creditLimit'];

      //query SQL
      $query = $conn->prepare("UPDATE customers SET customerName='$customerName', contactLastName='$contactLastName', contactFirstName='$contactFirstName',
      phone='$phone', addressLine1='$addressLine1', addressLine2='$addressLine2', city='$city', state='$state', postalCode='$postalCode', country='$country', salesRepEmployeeNumber='$salesRepEmployeeNumber', creditLimit='$creditLimit'
      WHERE customerNumber='$customerNumber'");

      $query->bindParam(':customerNumber',$customerNumber);
      $query->bindParam(':customerName',$customerName);
      $query->bindParam(':contactLastName',$contactLastName);
      $query->bindParam(':contactFirstName',$contactFirstName);
      $query->bindParam(':phone',$phone);
      $query->bindParam(':addressLine1',$addressLine1);
      $query->bindParam(':addressLine2',$addressLine2);
      $query->bindParam(':city',$city);
      $query->bindParam(':state',$state);
      $query->bindParam(':postalCode',$postalCode);
      $query->bindParam(':country',$country);
      $query->bindParam(':salesRepEmployeeNumber',$salesRepEmployeeNumber);
      $query->bindParam(':creditLimit',$creditLimit);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: index.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>UPDATE CUSTOMERS</title>
    <!-- load css boostrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Pemrograman Web</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
               <li class="nav-item">
                <a class="nav-link active" href="<?php echo "index.php"; ?>">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form_customers.php"; ?>">Input Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form_products.php"; ?>">Input Products</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Data Customers</h2>
          <form action="updateCustomers.php" method="POST">
            <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="form-group">
              <label>Customer Number</label>
              <input type="text" class="form-control" placeholder="customer number" name="customerNumber" value="<?php echo $data['customerNumber'];  ?>" required="required" readonly>
            </div>

            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" placeholder="customer name" name="customerName" value="<?php echo $data['customerName'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Contact Last Name</label>
              <input type="text" class="form-control" placeholder="contact last name" name="contactLastName" value="<?php echo $data['contactLastName'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Contact FIrst Name</label>
              <input type="text" class="form-control" placeholder="contact first name" name="contactFirstName" value="<?php echo $data['contactFirstName'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="phone" name="phone" value="<?php echo $data['phone'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Address Line 1</label>
              <input type="text" class="form-control" placeholder="address line 1" name="addressLine1" value="<?php echo $data['addressLine1'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Address Line 2</label>
              <input type="text" class="form-control" placeholder="address line 1" name="addressLine2" value="<?php echo $data['addressLine2'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" placeholder="city" name="city" value="<?php echo $data['city'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" placeholder="state" name="state" value="<?php echo $data['state'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Postal Code</label>
              <input type="text" class="form-control" placeholder="postal code" name="postalCode" value="<?php echo $data['postalCode'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Sales Rep Employee Number</label>
              <input type="text" class="form-control" placeholder="sales rep employee number" name="salesRepEmployeeNumber" value="<?php echo $data['salesRepEmployeeNumber'];  ?>" required="required">
            </div>

            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>