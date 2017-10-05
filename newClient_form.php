<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "newClient_form.php";
    header("location: login.php?Page=$page");
}
?>
<html>
<head><title>New Client Form</title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<form method="post" action="newClient.php">
    <center>Client detail<br/></center>
    <p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>First Name</b></td>
            <td><input type="text" name="fname" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Last Name</b></td>
            <td><input type="text" name="lname" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Address</b></td>
            <td><input type="text" name="addr" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Suburb</b></td>
            <td><input type="text" name="suburb" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>State</b></td>
            <td><input type="text" name="state" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Postcode</b></td>
            <td><input type="text" name="pcode" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td><input type="text" name="email" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Phone Number</b></td>
            <td><input type="number" name="phonenum" size="30" value="" required></td>
        </tr>
        <tr>
            <td><b>Mailing List</b></td>
            <td><input type="checkbox" name="check[]" size="30"></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <br/>
        <tr>
            <td><input type="submit" value="Insert product"></td>
            <td><input type="button" value="return to list" OnClick="window.location='client.php'"></td>
        </tr>
    </table>
</form>

</body>

</html>