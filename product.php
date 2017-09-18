<?php
    include("connection.php");
    $CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
    $QUERY = "SELECT * FROM PRODUCT";
    $RESULT = mysqli_query($CONNECTION,$QUERY);
    while($row = $RESULT->fetch_array())
    { ?>
        <tr>
            <td><?php echo $row["product_id"];?></td>
            <td><?php echo $row["product_name"];?></td>
            <td><?php echo $row["product_purchase_price"];?></td>
            <td><?php echo $row["product_sale_price"];?></td>
            <td><?php echo $row["product_country_of_origin"];?></td>
            <td><a href="productModify.php?product_id=<?php echo $row["product_id"];?>&action=edit">Edit</a></td>
            <td><a href="productModify.php?product_id=<?php echo $row["product_id"];?>&action=remove">Remove</a></td>
        </tr>
    <?php } ?>