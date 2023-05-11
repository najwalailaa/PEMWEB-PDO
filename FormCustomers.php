<?php 
  include ('conn.php'); 

  $status = '';
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
    
    $query = $conn->prepare("INSERT INTO customers VALUES('$customerNumber', '$customerName', '$contactLastName', '$contactFirstName', '$phone', '$addressLine1', '$addressLine2', '$city', '$state', '$postalCode', '$country', '$salesRepEmployeeNumber', '$creditLimit')");
    
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

    if ($query->execute()) {
      $status = 'ok';
    }
    else{
      $status = 'err';
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>FORM CUSTOMER</title>
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
                <a class="nav-link" href="<?php echo "FormCustomers.php"; ?>">Input Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "FormProduct.php"; ?>">Input Products</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          
          <?php 
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customers berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customers gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form Customer</h2>
          <form action="form_customers.php" method="POST">
            
          <div class="form-group">
              <label>Customer Number</label>
              <input type="text" class="form-control" placeholder="customer number" name="customerNumber" required="required">
            </div>

            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" placeholder="customer name" name="customerName" required="required">
            </div>

            <div class="form-group">
              <label>Contact Last Name</label>
              <input type="text" class="form-control" placeholder="contact last name" name="contactLastName" required="required">
            </div>

            <div class="form-group">
              <label>Contact First Name</label>
              <input type="text" class="form-control" placeholder="contact first name" name="contactFirstName" required="required">
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="phone" name="phone" required="required">
            </div>

            <div class="form-group">
              <label>Address Line 1</label>
              <input type="text" class="form-control" placeholder="address line 1" name="addressLine1" required="required">
            </div>

            <div class="form-group">
              <label>Address Line 2</label>
              <input type="text" class="form-control" placeholder="address line 2" name="addressLine2" required="required">
            </div>

            <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" placeholder="city" name="city" required="required">
            </div>

            <div class="form-group">
              <label>State</label>
              <input type="text" class="form-control" placeholder="state" name="state" required="required">
            </div>

            <div class="form-group">
              <label>Postal Code</label>
              <input type="text" class="form-control" placeholder="postal code" name="postalCode" required="required">
            </div>

            <div class="form-group">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="country" name="country" required="required">
            </div>

            <div class="form-group">
              <label>Sales Rep Employee Number</label>
              <input type="text" class="form-control" placeholder="sales rep employee number" name="salesRepEmployeeNumber" required="required">
            </div>

            <div class="form-group">
              <label>Credit Limit</label>
              <input type="text" class="form-control" placeholder="credit limit" name="creditLimit" required="required">
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>