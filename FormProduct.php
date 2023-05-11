<?php 
  include ('conn.php'); 

  $status = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //Products
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $MSRP = $_POST['MSRP'];
    
    $query = $conn->prepare("INSERT INTO products VALUES ('$productCode', '$productName', '$productLine', '$productScale', '$productVendor', '$productDescription', '$quantityInStock', '$buyPrice', '$buyPrice')");

    $query->bindParam(':productCode',$productCode);
    $query->bindParam(':productName',$productName);
    $query->bindParam(':productLine',$productLine);
    $query->bindParam(':productScale',$productScale);
    $query->bindParam(':productVendor',$productVendor);
    $query->bindParam(':productDescription',$productDescription);
    $query->bindParam(':quantityInStock',$quantityInStock);
    $query->bindParam(':buyPrice',$buyPrice);
    $query->bindParam(':MSRP',$MSRP);

    //eksekusi query
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
    <title>Form Pegawai</title>
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
                echo '<br><br><div class="alert alert-success" role="alert">Data Products berhasil disimpan</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Products gagal disimpan</div>';
              }
           ?>

          <h2 style="margin: 30px 0 30px 0;">Form Produk</h2>
          <form action="form_products.php" method="POST">
            
          <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="product code" name="productCode" required="required">
            </div>

            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="product name" name="productName" required="required">
            </div>

            <div class="form-group">
              <label>Product Line</label>
              <input type="text" class="form-control" placeholder="product line" name="productLine" required="required">
            </div>

            <div class="form-group">
              <label>Product Scale</label>
              <input type="text" class="form-control" placeholder="product scale" name="productScale" required="required">
            </div>

            <div class="form-group">
              <label>Product Vendor</label>
              <input type="text" class="form-control" placeholder="product vendor" name="productVendor" required="required">
            </div>

            <div class="form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="product description" name="productDescription" required="required">
            </div>

            <div class="form-group">
              <label>Quantity In Stock</label>
              <input type="text" class="form-control" placeholder="quantity in stock" name="quantityInStock" required="required">
            </div>

            <div class="form-group">
              <label>Buy Price</label>
              <input type="text" class="form-control" placeholder="buy price" name="buyPrice" required="required">
            </div>

            <div class="form-group">
              <label>MSRP</label>
              <input type="text" class="form-control" placeholder="msrp" name="MSRP" required="required">
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>