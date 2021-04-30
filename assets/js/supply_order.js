var add_item_form = document.getElementById("item_add_form");
var items_display = document.getElementById("item_list");
var supplyOrderForm = document.getElementById("main-form");

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

supplyOrderForm.onsubmit = function(e) {
    e.preventDefault();
    var supplyOrderData = new FormData(supplyOrderForm);

    var soData = {
        desc: supplyOrderData.get("desc"),
        addr: supplyOrderData.get("addr"),
        total_cost: supplyOrderData.get("tot_cost"),
        delivery_date: supplyOrderData.get("delivery_date"),
        supplier: supplyOrderData.get("supplier"),
        items: itemsArr
    }

    $.post("/ElectronicsCompany/inventory_manager/db_create_supply_order.php",soData).done(function(data){
        console.log(data);
        if(data == 'OK') {
            window.location.replace("/ElectronicsCompany/inventory_manager/supply_orders.php");
        }
    });
}