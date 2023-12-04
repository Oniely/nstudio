$(document).ready(() => {
    $("#productForm").submit(function (e) {
        e.preventDefault();

        const action = $(document.activeElement).val();
        const product_item_id = $(document.activeElement).attr('data-item-id');

        var selectBox = $("#colourOption");
        var radioButtons = $("input[name='size']:checked");

        if (selectBox.val() === "") {
            alert("Please select a colour for your product.");
            return false;
        }

        if (radioButtons.length === 0) {
            alert("Please choose a size for your product.");
            return false;
        }

        console.log($('#colourContainer').attr("data-colour-id"));
        console.log($('input[name="size"]:checked').attr("data-size-id"));

        if (action === "add") {
            $.ajax({
                url: "../includes/ajax/add_to_cart.php",
                type: "POST",
                data: {
                    action: "add_to_cart",
                    colour: $('#colourContainer').attr("data-colour-id"),
                    size: $("input[name='size']:checked").attr("data-size-id"),
                },
                success: (res) => {
                    if (res === "ERROR") return alert("An error occurred while adding the item to your cart. Please try again later.");
                    if (res === "NOT LOGGED IN") return window.location.replace('/nstudio/login.php');
                    if (res === "OUT OF STOCK") return alert("Sorry, this product is out of stock.");
                    if (res === "FULL STOCK") return alert("You have already added the maximum amount of this product to your cart.");

                    $("#cartNumber").text(res);
                    alert("Item added to cart");
                    console.log(res);
                },
            });
        }

        if (action === 'buy') {
            if (product_item_id === undefined) return alert("An error occurred while adding the item to your cart. Please try again later.");

            window.location.replace(`/nstudio/views/checkout.php?item=${product_item_id}&colour=${$('#colourContainer').attr("data-colour-id")}&size=${$("input[name='size']:checked").attr("data-size-id")}`)
        }
        return true;
    });
});

$(document).ready(() => {
    $(".hoverProduct").on('click', (e) => {
        let currentSrc = $(e.target).attr("src");
        $('#showProduct').attr("src", currentSrc);
    });
})

$(document).ready(() => {
    $('#colourOption').on('change', (e) => {
        let link = $(e.target).find('option:selected').attr('data-link');
        if (link !== "") {
            window.location.replace(link)
        }
    });
});

$(document).ready(function () {
    
})