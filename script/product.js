$(document).ready(() => {
    $("#productForm").submit(function (e) {
        e.preventDefault();

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

        $.ajax({
            url: "../includes/ajax/add_to_cart.php",
            type: "POST",
            data: {
                action: "add_to_cart",
                colour: $("#colourOption").val(),
                size: $("input[name='size']:checked").val()
            },
            success: (res) => {
                if (res === "NOT LOGGED IN") return window.location.replace('/nstudio/login.php');
                if (res === "OUT OF STOCK") return alert("Sorry, this product is out of stock.");
                if (res === "FULL STOCK") return alert("You have already added the maximum amount of this product to your cart.");

                $("#cartNumber").text(res);
                alert("Item added to cart");
                console.log(res);
            },
        });
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