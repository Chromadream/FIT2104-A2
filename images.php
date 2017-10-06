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
        <link rel="stylesheet" type="text/css" href="styles.css" />
        </head>
        <body>
        <a href="index.html" ><button>Return to Main Page</button></a>
        <center>
        <h3>Famox Images Manage Page</h3>
        <form action="images.php" method="post">
        <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
        <tr class="listheader">
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
        </center>
        <?php
    }
    else
    {
        foreach($_POST["check"] as $filename)
        {
            if(unlink($imagedir.$filename))
            {
                $query = "DELETE FROM product_image WHERE image_name = ".$filename;
                $result = $CONNECTION->query($query);
                echo("The file ".$filename." has been successfully deleted.<br/>");
            }
        }
    }
?>
        <a href="displayFile.php?filename=images.php"><img src="images/Assignment2-Image-007.jpg"></a>
        </body>
        </html>

