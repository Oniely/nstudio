$(document).ready(() => {
    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#popup-modal").hide();
        }
    });

    $(document).on("click", ".minusBtn", function (e) {
        let product_item_id = $(e.target).data("item-id");
        adjustQuantity(product_item_id, "minus_quantity");

        $("#confirmBtn").on("click", () => {
            $.ajax({
                type: "POST",
                url: "../includes/ajax/delete_cart_product.php",
                data: {
                    action: "delete_product",
                    item_id: product_item_id,
                },
                success: (res) => {
                    if (res === "SUCCESS") {
                        location.reload();
                    } else if (res === "FAILURE") {
                        $("#popup-modal").hide();
                    } else {
                        $("#popup-modal").hide();
                    }
                },
            });
            $("#popup-modal").hide();
        });
    });

    $(document).on("click", ".addBtn", function (e) {
        let product_item_id = $(e.target).data("item-id");
        adjustQuantity(product_item_id, "add_quantity");
    });

    $("#popup-btn").on("click", () => {
        $("#popup-modal").show();
    });
    $("#cancelBtn").on("click", () => {
        $("#popup-modal").hide();
    });
    $("#closeBtn").on("click", () => {
        $("#popup-modal").hide();
    });

    function adjustQuantity(product_item_id, action) {
        $.ajax({
            url: "../includes/ajax/cart_quantity.php",
            type: "POST",
            data: {
                action: action,
                item_id: product_item_id,
            },
            success: (res) => {
                let quantityId = `[data-quantity-id='${product_item_id}'`;
                let priceId = `[data-price-id='${product_item_id}'`;
                let data = JSON.parse(res);

                if (res === "") {
                    window.location.reload('/nstudio/login.php');
                    return;
                }

                if (parseInt(data[0]) === 0) {
                    console.log("Quantity is zero. Triggering click on #popup-btn");
                    $("#popup-btn").click();
                    return;
                }


                $(quantityId).text(data[0]);
                $(priceId).text(data[0] * data[1]);
                $('#subtotal').text(data[2].toFixed(2));
            },
            error: (xhr, status, error) => {
                console.error("Error: " + error);
            },
        });
    }
});

$('.removeItem').on('click', (e) => {
    let product_item_id = $(e.target).data("delete-item-id");
    $.ajax({
        type: "POST",
        url: "../includes/ajax/delete_cart_product.php",
        data: {
            action: "delete_product",
            item_id: product_item_id,
        },
        success: (res) => {
            if (res === "SUCCESS") {
                location.reload();
            } else if (res === "FAILURE") {
                return;
            } else {
                return;
            }
        },
    });
});