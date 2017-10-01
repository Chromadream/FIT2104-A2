<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<form method="post" action="insert.php">
    <center>Product detail<br/></center>
    <p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Product Name</b></td>
            <td><input type="text" name="pname" size="30" value=""></td>
        </tr>
        <tr>
            <td><b>Purchase Price</b></td>
            <td><input type="text" name="pprice" size="30" value=""></td>
        </tr>
        <tr>
            <td><b>Sale Price</b></td>
            <td><input type="text" name="sprice" size="40" value=""></td>
        </tr>
        <tr>
            <td><b>Origin</b></td>
            <td><input type="text" name="origin" size="10" value=""></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <br/>
        <tr>
            <td><input type="submit" value="Insert product"></td>
            <td><input type="button" value="return to list" OnClick="window.location='example0603.php'"></td>
        </tr>
    </table>
</form>

</body>

</html>