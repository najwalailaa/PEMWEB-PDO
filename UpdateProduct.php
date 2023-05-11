<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['productCode'])) {
          //query SQL
          $productCode_upd = $_GET['productCode'];
          $query = $conn->prepare("SELECT * FROM products WHERE productCode = '$productCode_upd'");
          //binding data
          $query->bindParam(':productCode',$productCode);
          //eksekusi query
          $query->execute(); 
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productCode = $_POST['productCode'];
      $productName = $_POST['productName'];
      $productLine = $_POST['productLine'];
      $productScale = $_POST['productScale'];
      $productVendor = $_POST['productVendor'];
      $productDescription = $_POST['productDescription'];
      $quantityInStock = $_POST['quantityInStock'];
      $buyPrice = $_POST['buyPrice'];
      $MSRP = $_POST['MSRP'];

      //query SQL
      $query = $conn->prepare("UPDATE products SET productName='$productName', productLine='$productLine', productScale='$productScale', productVendor='$productScale',
      productDescription='$productDescription', quantityInStock='$quantityInStock', buyPrice='$buyPrice', MSRP='$MSRP' WHERE productCode='$productCode'");
      //binding data
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

      //redirect ke halaman lain
      header('Location: index.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>UPDATE PRODUCTS</title>
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


          <h2 style="margin: 30px 0 30px 0;">Update Data Products</h2>
          <form action="updateProducts.php" method="POST">
            <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="product code" name="productCode" value="<?php echo $data['productCode'];  ?>" required="required" readonly>
            </div>

            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="product name" name="productName" value="<?php echo $data['productName'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Product Line</label>
              <input type="text" class="form-control" placeholder="product line" name="productLine" value="<?php echo $data['productLine'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Product Scale</label>
              <input type="text" class="form-control" placeholder="product scale" name="productScale" value="<?php echo $data['productScale'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Product Vendor</label>
              <input type="text" class="form-control" placeholder="product vendor" name="productVendor" value="<?php echo $data['productVendor'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Product Description</label>
              <input type="text" class="form-control" placeholder="product description" name="productDescription" value="<?php echo $data['productDescription'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Quantity In Stock</label>
              <input type="text" class="form-control" placeholder="quantity in stock" name="quantityInStock" value="<?php echo $data['quantityInStock'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>Buy Price</label>
              <input type="text" class="form-control" placeholder="buy price" name="buyPrice" value="<?php echo $data['buyPrice'];  ?>" required="required">
            </div>

            <div class="form-group">
              <label>MSRP</label>
              <input type="text" class="form-control" placeholder="msrp" name="MSRP" value="<?php echo $data['MSRP'];  ?>" required="required">
            </div>
            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </main>
      </div>
    </div>
  </body>
</html>