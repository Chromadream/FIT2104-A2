<?php
    ob_start();
?>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<center>
	<?php
	$count=0;
    foreach($checks as $pid)
    {
        $count=$count+1;
        $query1 = "SELECT * FROM product WHERE product_id=$pid";
        $result1 = $conn -> query($query1);
        $Products = $result1->fetch_assoc();
        ?>
      <form name="form1" method="post" action="">
        <table border="1">
            <tr>
            <td>Product ID</td>
                <? $id[]=$Products['id']; ?>
                <td><?php echo $Products["product_id"]; ?></td> 
           </tr>
           <tr>
            <td>Product Name</td>
                <td align="center"><input type="text" name="productname[]" value="<?php echo $Products["product_name"]; ?>"></td>  
           </tr>
         <tr>
            <td>Product Purchase Price</td>
                <td align="center"><input type="text" name="productpprice[]" value="<?php echo $Products["product_purchase_price"]; ?>"></td>  
           </tr>
         <tr>
            <td>Product Sale Price</td>
                <td align="center"><input type="text" name="productsprice[]" value="<?php echo $Products["product_sale_price"]; ?>"></td>  
           </tr>
         <tr>
            <td>Product Country of Origin</td>
                <td align="center"><input type="text" name="productorigin[]" value="<?php echo $Products["product_country_of_origin"]; ?>"></td>  
           </tr>                       					   
        </table>

        <?php
    }
        ?>
    <a href="checkboxes_update.php" ><button>Submit</button></a>
   </form>
</center>
</body>
</html>