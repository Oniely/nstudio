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
                        window.location.replace("/nstudio/views/cart.php");
                    } else {
                        $("#popup-modal").hide();
                        console.error("Deletion failed:", res);
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
                let data = JSON.parse(res);
                console.log(res)
                if (res === "") {
                    window.location.reload('/nstudio/login.php');
                    return;
                }

                if (parseInt(data[0]) === 0) {
                    $("#popup-btn").click();
                    return;
                }
                console.log(product_item_id);
                $(`[data-quantity-id=${product_item_id}]`).data('quantity-id', data[3])
                $(`[data-price-id=${product_item_id}]`).data('price-id', data[3]);

                console.log($(`[data-quantity-id=${product_item_id}]`).data('quantity-id'));
                console.log($(`[data-price-id=${product_item_id}]`).data('price-id'));

                $(`[data-quantity-id=${data[3]}]`).text(data[0]);
                $(`[data-price-id=${data[3]}]`).text(data[0] * data[1]);
                $('#subtotal').text(data[2].toFixed(2));
            },
            error: (xhr, status, error) => {
                console.error("Error: " + error);
            },
        });
    }
});
// edit cart
$(document).ready(function () {
    $('.cartProduct').on('click', '.doneBtn', function (e) {
        e.preventDefault();

        const selectedValueID = $(this).parent().siblings('.editContainer').children('.variation').val();
        const currentItemID = $(this).closest('.cartProduct').data('item-id');

        console.log([selectedValueID, currentItemID]);

        $.ajax({
            type: "POST",
            url: "../includes/ajax/edit_cart.php",
            data: {
                action: "done",
                item_id: selectedValueID,
                currentItemID: currentItemID
            },
            success: (res) => {
                if (res === "SUCCESS") return location.reload();
                if (res === "ERROR") return alert('Something went wrong, Please Try Again Later.');

                $(this).parent().siblings('.editContainer').html(res);
                $(this).hide();
                $(this).siblings('.editItem').show();

                $(this).siblings('.editItem').data('item-id', selectedValueID);
                $(this).closest('.cartProduct').data('item-id', selectedValueID);

                $(this).closest('.cartProduct').find('.addBtn').data('item-id', selectedValueID);
                $(this).closest('.cartProduct').find('.minusBtn').data('item-id', selectedValueID);

                $(this).closest('.cartProduct').find('.quantityCount').attr('data-quantity-id', selectedValueID);
                $(this).closest('.cartProduct').find('.priceCount').attr('data-price-id', selectedValueID);
            }
        })
    });

    $('.cartProduct').on('click', '.editItem', function (e) {
        e.preventDefault();

        let product_id = $(e.target).data('product-id');
        let product_item_id = $(e.target).data('item-id');
        let colour_value = $(e.target).data('colour-value');

        console.log(product_item_id);

        $.ajax({
            type: "GET",
            url: "../includes/ajax/edit_cart.php",
            data: {
                action: "edit",
                product_id: product_id,
                item_id: product_item_id,
                colour_value: colour_value
            },
            success: (res) => {
                if (res === "ERROR") return alert('Something went wrong, Please Try Again Later.');

                $(e.target).parent().siblings('.editContainer').html(res);
                $(e.target).hide();
                $(e.target).siblings('.doneBtn').show();
            }
        })
    });

    $('.removeItem').on('click', (e) => {
        e.preventDefault();

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
})