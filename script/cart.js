$(document).ready(() => {
    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#popup-modal").hide();
        }
    });

    $(document).on("click", ".minusBtn", function (e) {
        let product_item_id = $(e.target).data("item-id");
        adjustQuantity(product_item_id, "minus_quantity");
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

    $("#confirmBtn").on("click", () => {
        let product_item_id = $(".minusBtn").data("item-id");
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
                } else {
                    $("popup-modal").hide();
                }
            },
        });
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

                if (parseInt(data[0]) === 0) {
                    $("#popup-btn").click();
                    return;
                }

                $(quantityId).text(data[0]);
                $(priceId).text(parseFloat(data[0] * data[1]).toFixed(2));
            },
            error: (xhr, status, error) => {
                console.error("Error: " + error);
            },
        });
    }
});
