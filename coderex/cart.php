<?php
include 'database_connection.php';
if(isset($_POST['select_items'])){
  $quantity = $_POST['quantity']; 
  
}
// Recieved id of a selected item
$rcv_id = $_REQUEST['id'];
// Insert selected items in a new database table start
  $cart_insert =  "INSERT INTO selected_items (id, product_name, product_price, vendor_email, product_image, tax, product_quantity)
  SELECT id, product_name, product_price, vendor_email, product_image, tax, '$quantity'
  FROM products
  WHERE id = $rcv_id";
  $cart_insert_connection = mysqli_query($connect,$cart_insert);
  if(!$cart_insert_connection){
    die("Not inserted". mysqli_error());
  }
  // Insert selected items in a new database table end


?>
<?php
// Read selected items from database query start
$selected_items_query = "SELECT * FROM selected_items";
$selected_items_query_connection = mysqli_query($connect,$selected_items_query);
$count_selected_items = mysqli_num_rows($selected_items_query_connection);
// Read selected items from database query end
            // Conditions if database contains any data or is it blank
              if($count_selected_items >0){
              ?>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No of items</th>
      <th scope="col">Product name</th>
      <th scope="col">Product image</th>
      <th scope="col">Quantity</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Tax</th>
      <th scope="col">Total Price</th>
      <th scope="col">Vendor's Email</th>
    </tr>
  </thead>
  <?php
  $serial_no= 0;
  // While loop for showing database data repeatedly in the content
   while($row = mysqli_fetch_assoc($selected_items_query_connection)){

              $db_id =   $row['id'];
              $db_product_name =   $row['product_name'];
              $db_product_price =   $row['product_price'];
              $db_vendor_email =   $row['vendor_email'];
              $db_img_name =   $row['product_image'];
              $db_product_tax =   $row['tax'];
              $quantity = $row['product_quantity'];
              $db_tax_amount = $db_product_tax*$db_product_price/100;
              $unit_price = $db_product_price+$db_tax_amount;
              $total_price = $unit_price*$quantity;
              $serial_no++;
              ?>

<tbody>
  <!-- Html table showing selected data from database(this is inside while loop) -->
    <tr>
      <th scope="row"><?php echo $serial_no;?></th>
      <td><?php echo $db_product_name;?></td>
      <td><img src="images/<?php echo $db_img_name;?>" height="50px" width="50px" alt=""></td>
      <td><?php echo $quantity;?></td>
      <td><?php echo $db_product_price;?></td>
      <td><?php echo $db_product_tax;?><p style="display:inline;">%</p></td>
      <td><?php echo $total_price;?></td>
      <td><?php echo $db_vendor_email;?></td>
    </tr>
  </tbody>
  
  <?php
   }
   ?>
</table>
   <?php
              
              }else{
                echo "No selected items to show!";
              }
              ?>
<!-- html with bootsrtap cdn -->
          <!DOCTYPE html>
          <html lang="en">
              <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
                <link rel="stylesheet" href="css/all.min.css">
                <link rel="stylesheet" href="css/fontawesome.min.css">
                <link rel="stylesheet" href="style.css">
                <title>Document</title>
              </head>
            <body>
              <form action="send_mail.php" method = "post">
                <button type="submit" name="order_btn" class="btn btn-primary">Place order</button>
              </form>
              <!-- javastript  -->
              <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"
              ></script>
              <script src="js/animated_progressbar.js"></script>
              <!-- jquery -->
              <script src="https://code.jquery.com/jquery-3.3.1.min.js" 
                integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" 
                crossorigin="anonymous">
              </script> 

            </body>
          </html>
              
