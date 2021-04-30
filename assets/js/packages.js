var add_item_form = document.getElementById("item_add_form");
var items_display = document.getElementById("item_list");
var packageForm = document.getElementById("main-form");

var itemsArr = [];

add_item_form.onsubmit = function(e){
    e.preventDefault();
    var formData = new FormData(add_item_form);

    item = formData.get("item");

    itemID = item.split("|")[0];
    itemName = item.split("|")[1];

    itemsArr.push({
        id: itemID,
        qty: formData.get("qty"),
        cost: formData.get("cost")
    });

    $('#itemModal').modal("hide");

    var liStr = "<b> Name: </b>" + itemName + " <b>Qty: </b>" + formData.get("qty") + " <b>Cost: </b>" + formData.get("cost");
    var li = document.createElement("li");
    li.className = "list-group-item";
    pele = document.createElement("p")
    pele.innerHTML = liStr
    li.appendChild(pele);
    items_display.appendChild(li);

    console.log(itemsArr);
}

packageForm.onsubmit = function(e) {
    e.preventDefault();
    var packageData = new FormData(packageForm);

    var pData = {
        name: packageData.get("name"),
        status: packageData.get("status"),
        dispatched_date: packageData.get("dispatched_date"),
        delivery_date: packageData.get("delivery_date"),
        customer_order: packageData.get("customer_order"),
        items: itemsArr
    }

    $.post("/ElectronicsCompany/inventory_manager/db_create_package.php",pData).done(function(data){
        console.log(data);
        if(data == 'OK') {
            window.location.replace("/ElectronicsCompany/inventory_manager/packages.php");
        } else {
            window.location.replace("/ElectronicsCompany/inventory_manager/packages.php?err="+encodeURI(data));
        }
    });
}