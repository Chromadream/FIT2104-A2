<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "insert_it.php";
    header("location: login.php?Page=$page");
}
?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<body>
<form method="post" action="insert.php">
    <center><h3>Product detail</h3><br/>
    <p/>
    <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
        <tr>
            <td class="listheader"><b>Product Name</b></td>
            <td><input type="text" name="pname" size="30" value=""></td>
        </tr>
        <tr>
            <td class="listheader"><b>Purchase Price</b></td>
            <td><input type="text" name="pprice" size="30" value=""></td>
        </tr>
        <tr>
            <td class="listheader"><b>Sale Price</b></td>
            <td><input type="text" name="sprice" size="40" value=""></td>
        </tr>
        <tr>
            <td class="listheader"><b>Origin</b></td>
            <td><input type="text" name="origin" size="10" value=""></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <br/>
        <tr>
            <td><input type="submit" value="Insert product"></td>
            <td><input type="button" value="return to list" OnClick="window.location='single_product.php'"></td>
        </tr>
    </table>
    </center>
</form>

</body>

</html>