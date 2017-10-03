function setUpdateAction() {
document.frmProducts.action = "edit_products.php";
document.frmProducts.submit();
}
function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmProducts.action = "delete_products.php";
document.frmProducts.submit();
}
}
function validateForm()
    {
		var check = true;
		var message = "Product's name number: ";
		var names=document.getElementsByName('productName[]');
		for(key=0; key < names.length; key++)  {
			if(names[key].value === ""){
				check = false;
				message = message + (key+1) +" ";
			}
		}
		message = message +"is empty";
		if (check ==false){
			alert(message);
			return false;
		}
		else{
			return true;
		}
    }
