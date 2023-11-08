$(document).ready(() => {
    $("#addToCartBtn").on("click", () => {
        $.ajax({
            url: "../includes/ajax/add_to_cart.php",
            type: "POST",
            data: { action: "add_to_cart" },
            success: (res) => {
                $("#cartNumber").text(res);
                console.log(res);
            },
        });
    });
});

$(document).ready(() => {
    $(".hoverProduct").on('mouseover', (e) => {
        let currentSrc = $(e.target).attr("src");
        $('#showProduct').attr("src", currentSrc);
    });
})