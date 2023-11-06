$(document).ready(() => {
    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#popup-modal").hide();
        }
    });

    $(document).on("click", ".minusBtn", function () {
        let product_id = $(this).data("product-id");
        adjustQuantity(product_id, -1, "minus_quantity");
    });

    $(document).on("click", ".addBtn", function () {
        let product_id = $(this).data("product-id");
        adjustQuantity(product_id, 1, "add_quantity");
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
        let product_id = $(".minusBtn").data("product-id");
        $.ajax({
            type: "POST",
            url: "../includes/ajax/delete_cart_product.php",
            data: {
                action: "delete_product",
                product_id: product_id,
            },
            success: (res) => {
                if (res === "SUCCESS") {
                    location.reload();
                } else {
                    $('popup-modal').hide();
                }
            },
        });
        $("#popup-modal").hide();
    });

    function adjustQuantity(product_id, quantityChange, action) {
        $.ajax({
            url: "../includes/ajax/cart_quantity.php",
            type: "POST",
            data: {
                action: action,
                product_id: product_id,
                quantity_change: quantityChange,
            },
            success: (res) => {
                let quantityId = `[data-quantity-id='${product_id}'`;
                let priceId = `[data-price-id='${product_id}'`;
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
