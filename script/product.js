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
                $("#cartNumber").text(res);
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