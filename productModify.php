<?php
    include("connection.php");
    $CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
    $QUERY = "SELECT * FROM PRODUCT WHERE product_id=".$_GET["product_id"];
    $RESULT = mysqli_query($CONNECTION,$QUERY);
    $ROW = $RESULT ->fetch_assoc();
    switch($_GET["action"])
        case "confirmdelete":
            $QUERY="DELETE FROM PRODUCT WHERE product_id =".$_GET["product_id"];
            if($CONNECTION->query($QUERY))
            {?>
               The following product record is successfully deleted<br/>
            }
        case "remove":
    ?>
    Confirm deletion of the product record <br/>
    <table>
        <tr>
            <td>Product ID</td>
            <td><?php echo $row["product_id"];?></td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td><?php echo $row["product_name"];?></td>
        </tr>
        <tr>
            <td>Product Purchase Price</td>
            <td><?php echo $row["product_purchase_price"];?></td>
        </tr>
        <tr>
            <td>Product Sale Price</td>
            <td><?php echo $row["product_sale_price"];?></td>
        </tr>
        <tr>
            <td>Product Country of Origin</td>
            <td><?php echo $row["product_country_of_origin"];?></td>
        </tr>
    </table>
    <br />
    <table align="center">
        <tr>
            <td>
                <input type="button" value="Confirm" onclick="confirm_deletion();">
            </td>
            <td>
                <input type="button" value="Cancel" onclick="window.location='product.php'">
            </td>
        </tr>
    </table>
<?php
break;
?>

