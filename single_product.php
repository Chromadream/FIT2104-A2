<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "single_product.php";
    header("location: login.php?Page=$page");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>(Single) Product Viewing</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>

<?php
	include("connection.php");
	//$conn = new mysqli($Host, $UName, $PWord, $DB);
	$conn = new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
	$query = "select * from product";
	$stmt = $conn->query($query);

	
?>


<a href="index.html" ><button>Return to Main Page</button></a><br/>
<center>
<h3>Products</h3>
<form>
  <input type="text" name="search" placeholder="Search..">
</form>
<br>

<?php
$key = $_GET["search"];
if (empty($key)){
?>
    <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
        <tr class="listheader">
            <td><?php echo "Product Name" ?> </td>
           <td><?php echo "Purchase Price" ?> </td>
           <td><?php echo "Sale Price" ?> </td>
           <td><?php echo "Origin" ?> </td>
        </tr>
    
    <?php
        while ($row = $stmt->fetch_assoc())
        {
    ?>
        <tr>
           <td><?php echo $row["product_name"]; ?> </td>
           <td><?php echo $row["product_purchase_price"]; ?> </td>
           <td><?php echo $row["product_sale_price"]; ?> </td>
           <td><?php echo $row["product_country_of_origin"]; ?> </td>
           <td>
            <a href="ProductModify.php?pid= <?php echo $row["product_id"]; ?> &Action=Delete">Delete</a>
            </td>
            <td>
                <a href="ProductModify.php?pid= <?php echo $row["product_id"]; ?>
    &Action=Update">Update</a>
            </td>
        </tr>
    
    <?php
        }
    ?>
    
    </table>
<?php
}
else {
    ?>
	<table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
    <tr>
    	<tr class="listheader">
            <td><?php echo "Product Name" ?> </td>
           <td><?php echo "Purchase Price" ?> </td>
           <td><?php echo "Sale Price" ?> </td>
           <td><?php echo "Origin" ?> </td>
        </tr>
    </tr>
    <?php
		$key = "'"."%".$key."%"."'";
		$query1 = "select * from category WHERE category_name LIKE ".$key;
		$stmt1 = $conn->query($query1);
		$rowaff = $stmt1->num_rows;
		if ($rowaff ==0){
			echo "There is no category for that keyword!";
		}
		else{
			$query2 = "select * from product_category where category_id IN (";
			$i=0;
			while ($row1 = $stmt1->fetch_assoc()){
				if ($i==0) {
					$query2 = $query2.$row1["category_id"];
				}
				else{
					$query2 = $query2.", ".$row1["category_id"];
				}
				$i = $i +1;	
			}
			
			$query2 = $query2.")";
			
			$stmt2 = $conn->query($query2);
			$rowaff2 = $stmt2->num_rows;
			if ($rowaff2 ==0 && $rowaff!=0)
				echo "There is no product for that keyword!";
			else{
				
				
				$query3 = "select * from product where product_id IN (";
				$i=0;
				while ($row2 = $stmt2->fetch_assoc()){
					if ($i==0) {
						$query3 = $query3.$row2["product_id"];
					}
					else{
						$query3 = $query3.", ".$row2["product_id"];
					}
					$i = $i +1;	
				}
				
				$query3 = $query3.")";
				$stmt3 = $conn->query($query3);
			
			
			while ($row3 = $stmt3->fetch_assoc())
				{
			?>
				<tr>
				   <td><?php echo $row3["product_name"]; ?> </td>
				   <td><?php echo $row3["product_purchase_price"]; ?> </td>
				   <td><?php echo $row3["product_sale_price"]; ?> </td>
				   <td><?php echo $row3["product_country_of_origin"]; ?> </td>
				   <td>
					<a href="ProductModify.php?pid= <?php echo $row3["product_id"]; ?> &Action=Delete">Delete</a>
					</td>
					<td>
						<a href="ProductModify.php?pid= <?php echo $row3["product_id"]; ?>
			&Action=Update">Update</a>
					</td>
				</tr>
		
		<?php
			}
		}
		}
		?>
    
    </table>
    <?php
}
?>
</center>
<center><a href="insert_it.php" ><button>Insert</button></a></center>
<br/>
<a href="multiView.php?page=singleprod"><img src="images/Assignment2-Image-000.jpg"></a>
</body>
</html>