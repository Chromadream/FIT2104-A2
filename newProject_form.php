<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "newProject_form.php";
    header("location: login.php?Page=$page");
}
?>
<html>
<head><title>New Product Form</title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<form method="post" action="newProject.php">
    <center><h3>Project detail</h3><br/></center>
    <p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Project Description</b></td>
            <td><input type="text" name="pdesc" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Project Country</b></td>
            <td><input type="text" name="pcountry" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Project City</b></td>
            <td><input type="text" name="pcity" size="30" value="" required></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <br/>
        <tr>
            <td><input type="submit" value="Insert project"></td>
            <td><input type="button" value="Return to list" OnClick="window.location='project.php'"></td>
        </tr>
    </table>
</form>

</body>

</html>