<?php
    session_start();
    if (!($_SESSION["access_status"] === "granted")) {
        $page = "images.php";
        header("location: login.php?Page=$page");
    }
    include("connection.php");
    $CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
    $imagedir = "product_images/";
    $dir = opendir($imagedir);
    if(empty($_POST["check"]))
    {?>
        <html>
        <head>
        <title>Famox Images Manage Page</title>
        </head>
        <body>
        <form action="images.php" method="post">
        <table>
        <tr>
        <th>Filename</th>
        <th>Product</th>
        <th>Delete</th>
        </tr>
        <?php
        while($file=readdir($dir))
        {
            if($file == "." || $file =="..")
            {
            continue;
            } 
            $query = "SELECT p.product_name FROM PRODUCT_IMAGE pi, PRODUCT p WHERE pi.product_id = p.product_id and pi.image_name=$file";
            $result = $CONNECTION->query($query);
            echo "<tr>";
            echo "<td>".$file."</td>";
            echo "<td>".$result["product_name"]."</td>";
            echo "<td><input type='checkbox' name='check[]' value='".$file."'></td>";
            echo "</tr>";
        }?>
        </table>
        <input type="submit" value="Delete images">
        </form>
        <?php
    }
    else
    {
        foreach($_POST["check"] as $filename)
        {
            if(unlink($imagedir.$filename))
            {
                echo("The file ".$filename." has been successfully deleted.<br/>");
            }
        }
    }
?>