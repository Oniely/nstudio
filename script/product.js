$(document).ready(() => {
    $(".productForm").submit(function (e) {
        e.preventDefault();

        const action = $(document.activeElement).val();

        $('.addToCartBtn').attr('disabled', true);
        $('.buyNowBtn').attr('disabled', true);

        const product_item_id = $(document.activeElement).attr('data-item-id');

        var radioButton = $("input[name='size']:checked");

        if (radioButton.length == 0) {
            $('#warning-text').text('Please choose a size for your product.');
            gsap.to("#alert-warning", { duration: 1, opacity: 1 });
            gsap.from(".line", { duration: 5, right: "" });
            gsap.to(".line", { duration: 5, right: "0.5" });
            setTimeout(() => {
                gsap.to("#alert-warning", { duration: 0.4, opacity: 0 });
                $('.addToCartBtn').attr('disabled', false);
                $('.buyNowBtn').attr('disabled', false);
            }, 5000);
            return false;
        }

        console.log($('#colourContainer').attr("data-colour-id"));
        console.log($('input[name="size"]:checked').attr("data-size-id"));
        console.log(action);

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
                    $('.addToCartBtn').attr('disabled', false);
                    $('.buyNowBtn').attr('disabled', false);


                    if (res === "NOT LOGGED IN") return window.location.replace('/nstudio/login.php');
                    if (res === "OUT OF STOCK") return alert("Sorry, this product is out of stock.");
                    if (res === "FULL STOCK") return alert("You have already added the maximum amount of this product to your cart.");

                    $("#cartNumber").text(res);

                    gsap.to("#alert-success", { duration: 1, opacity: 1 });
                    gsap.from(".line", { duration: 5, right: "" });
                    gsap.to(".line", { duration: 5, right: "0.5" });
                    setTimeout(() => {
                        gsap.to("#alert-success", { duration: 0.4, opacity: 0 });
                    }, 5000);
                },
            });
        }

        if (action === 'buy') {
            if (product_item_id === undefined) return alert("An error occurred while adding the item to your cart. Please try again later.");

            window.location.replace(`/nstudio/views/checkout.php?item=${product_item_id}&colour=${$('#colourContainer').attr("data-colour-id")}&size=${$("input[name='size']:checked").attr("data-size-id")}`)
        }
        $('.addToCartBtn').attr('disabled', false);
        $('.buyNowBtn').attr('disabled', false);
        return true;
    });
});

$(document).ready(function () {
    const dBtn1 = $('.dBtn1');
    const dBtn2 = $('.dBtn2');
    const dBtn3 = $('.dBtn3');

    const desc1 = $('.desc1');
    const desc2 = $('.desc2');
    const desc3 = $('.desc3');

    dBtn1.on('click', () => {
        dBtn1.addClass('underline')
        dBtn2.removeClass('underline');
        dBtn3.removeClass('underline');

        desc1.show();
        desc2.hide()
        desc3.hide()
    });

    dBtn2.on('click', () => {
        dBtn2.addClass('underline')
        dBtn1.removeClass('underline');
        dBtn3.removeClass('underline');

        desc2.show();
        desc1.hide()
        desc3.hide()
    });

    dBtn3.on('click', () => {
        dBtn3.addClass('underline')
        dBtn1.removeClass('underline');
        dBtn2.removeClass('underline');

        desc3.show();
        desc1.hide()
        desc2.hide()
    });

    $("#main").on('click', '.showSizeModalBtn', () => {
        $('#sizeModal').addClass('grid');
        $('#sizeModal').removeClass('hidden');
        $('body').css('overflow', 'hidden');
    });

    $('#closeSizeBtn').on('click', () => {
        $('#sizeModal').removeClass('grid');
        $('#sizeModal').addClass('hidden');
        $('body').css('overflow', 'auto');
    });

    $(document).on('keydown', (e) => {
        if (e.key === 'Escape') {
            $('#sizeModal').removeClass('grid');
            $('#sizeModal').addClass('hidden');
            $('body').css('overflow', 'auto');
        }
    });

    $('#inchesBtn').on('click', function () {
        $('#inchesBtn').addClass('underline');
        $('#cmBtn').removeClass('underline');

        $('.chestInches').removeClass('hidden');
        $('.chestCm').addClass('hidden');

        $('.waistInches').removeClass('hidden');
        $('.waistCm').addClass('hidden');

        $('.armInches').removeClass('hidden');
        $('.armCm').addClass('hidden');
    })

    $('#cmBtn').on('click', function () {
        $('#cmBtn').addClass('underline');
        $('#inchesBtn').removeClass('underline');

        $('.chestInches').addClass('hidden');
        $('.chestCm').removeClass('hidden');

        $('.waistInches').addClass('hidden');
        $('.waistCm').removeClass('hidden');

        $('.armInches').addClass('hidden');
        $('.armCm').removeClass('hidden');
    });

    const imageSlider = document.getElementById('imageSlider');
    const counter = document.getElementById('counter');

    let currentImage = 1;
    counter.textContent = `${currentImage}/3`;

    $(imageSlider).on('scroll', () => {
        const scrollLeft = imageSlider.scrollLeft;
        const imageWidth = imageSlider.clientWidth;

        currentImage = Math.ceil(scrollLeft / imageWidth) + 1;
        counter.textContent = `${currentImage}/3`;
    });
});
