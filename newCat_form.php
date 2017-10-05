<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "newCat_form.php";
    header("location: login.php?Page=$page");
}
?>
<html>
<head><title>New Client Form</title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<form method="post" action="newCat.php">
    <center>Client detail<br/></center>
    <p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Category Name</b></td>
            <td><input type="text" name="catname" size="30" value="" required></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <br/>
        <tr>
            <td><input type="submit" value="Insert product"></td>
            <td><input type="button" value="return to list" OnClick="window.location='category.php'"></td>
        </tr>
    </table>
</form>

</body>

</html>