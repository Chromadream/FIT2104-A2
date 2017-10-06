<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "newCat_form.php";
    header("location: login.php?Page=$page");
}
?>
<html>
<head><title>New Client Form</title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<body>
<form method="post" action="newCat.php">
    <center><h3>Client detail</h3><br/>
    <p/>
    <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
        <tr>
            <td class="listheader"><b>Category Name</b></td>
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
    </center>
</form>

</body>

</html>