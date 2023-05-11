<?php
include ('conn.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>MAIN</title>
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
                <a class="nav-link active" href="<?php echo "index.php"; ?>"></a>
                <ul class="nav flex-column">
                  <li class="nav-item"><a class="nav-link" style="margin-left: 20px" href="#Customers">Customers</a></li>
                  <li class="nav-item"><a class="nav-link" style="margin-left: 20px" href="#Products">Products</a></li>
                </ul>
              </li>
              <br>
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
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Perusahaan berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Perusahaan gagal di-update</div>';
              }
            }
           ?>
        <main>
          <div id="Customers">
          <h2 style="margin: 30px 0 30px 0; ">CUSTOMERS</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead align="center">
                <tr>
                  <th>Customer Number</th>
                  <th>Customer Name</th>
                  <th>Contact Last Name</th>
                  <th>Contact First Name</th>
                  <th>Phone</th>
                  <th>Address Line 1</th>
                  <th>Address Line 2</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Postal Code</th>
                  <th>Country</th>
                  <th>Sales Rep Employee Number</th>
                  <th>Credit Limit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT * FROM customers";
                  $result =  $conn->query($query);
                 ?>

                 <?php while($data = $result->fetch(PDO::FETCH_ASSOC) ): ?>
                  <tr align="center" class="table table-striped table-sm">
                    <td><?php echo $data['customerNumber'];  ?></td>
                    <td><?php echo $data['customerName'];  ?></td>
                    <td><?php echo $data['contactLastName'];  ?></td>
                    <td><?php echo $data['contactFirstName'];  ?></td>
                    <td><?php echo $data['phone'];  ?></td>
                    <td><?php echo $data['addressLine1'];  ?></td>
                    <td><?php echo $data['addressLine2'];  ?></td>
                    <td><?php echo $data['city'];  ?></td>
                    <td><?php echo $data['state'];  ?></td>
                    <td><?php echo $data['postalCode'];  ?></td>
                    <td><?php echo $data['country'];  ?></td>
                    <td><?php echo $data['salesRepEmployeeNumber'];  ?></td>
                    <td><?php echo $data['creditLimit'];  ?></td>
                    <td>
                     <a href="<?php echo "UpdateCustomers.php?customerNumber=".$data['customerNumber']; ?>" class="btn btn-outline-warning btn-sm">Update</a>
                      &nbsp;&nbsp;
                     <a href="<?php echo "DeleteCustomer.php?customerNumber=".$data['customerNumber']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                 <?php endwhile ?>
                </tbody>
                 </table>
                 </div>
                 </div>
                 
          <div id="Products">
          <h2 style="margin: 30px 0 30px 0; ">PRODUCTS</h2>
          <div class="table-responsive">
          <table class="table table-striped table-sm">
              <thead align ="center">
                <tr>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Product Line</th>
                  <th>Product Scale</th>
                  <th>Product Vendor</th>
                  <th>Product Description</th>
                  <th>Quantity In Stock</th>
                  <th>Buy Price</th>
                  <th>MSRP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no=1;
                  $query1 = "SELECT * FROM products";
                  
                  $result1 =  $conn->query($query1);

                 ?>
                
                 <?php while($data = $result1->fetch(PDO::FETCH_ASSOC) ): ?>
                  <tr align="center">
                    <td><?php echo $data['productCode'];  ?></td>
                    <td><?php echo $data['productName'];  ?></td>
                    <td><?php echo $data['productLine'];  ?></td>
                    <td><?php echo $data['productScale'];  ?></td>
                    <td><?php echo $data['productVendor'];  ?></td>
                    <td align="justify"><?php echo $data['productDescription'];  ?></td>
                    <td><?php echo $data['quantityInStock'];  ?></td>
                    <td><?php echo $data['buyPrice'];  ?></td>
                    <td><?php echo $data['MSRP'];  ?></td>
                    <td>
                      <a href="<?php echo "UpdateProduct.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-warning btn-sm">Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "DeleteProduct.php?productCode=".$data['productCode']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                  <?php $no++; ?>
                 <?php endwhile ?>
                 </div>
              </tbody>
            </table>
          </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>