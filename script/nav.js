const links = document.querySelectorAll("#NAV_LINK");
let currentHoveredLink = null;
let currentHoveredHoverLink = null;

links.forEach((link) => {
    link.addEventListener("mouseover", (e) => {
        if (currentHoveredLink) {
            currentHoveredLink.nextElementSibling.style.height = "0";
            currentHoveredLink.nextElementSibling.style.padding = "0 2rem";
            currentHoveredLink.nextElementSibling.style.borderBottom = "0";
        }

        currentHoveredLink = link;
        let hoverLink = link.nextElementSibling;
        currentHoveredHoverLink = hoverLink;

        hoverLink.style.height = "25rem";
        hoverLink.style.padding = "2rem 2rem";
        hoverLink.style.borderBottom = "1px solid #101010";
        $('.nav_bar').css('border-bottom-color', 'transparent');

        hoverLink.addEventListener("mouseout", (e) => {
            const targetElement = e.relatedTarget;

            if (!currentHoveredHoverLink.contains(targetElement)) {
                currentHoveredHoverLink.style.height = "0";
                currentHoveredHoverLink.style.padding = "0 2rem";
                currentHoveredHoverLink.style.borderBottom = "0";
                $('.nav_bar').css('border-bottom-color', '#101010');
            }
        });
    });
});

$(document).keydown((e) => {
    if (e.key === "Escape") {
        $("#user-dropdown").hide();
    }
});

$("#user-menu-button").on("click", (e) => {
    e.stopPropagation();
    $("#user-dropdown").toggle();
});

$(document).on("click", (e) => {
    if (
        !$(e.target).closest("#user-menu-button").length &&
        !$(e.target).closest("#user-dropdown").length
    ) {
        $("#user-dropdown").hide();
    }
});

$('#burger').on('click', () => {
    const isOpen = $('.line1').hasClass('open');

    if (isOpen) {
        $('.line1, .line3').removeClass('open');
        $('.line2').removeClass('hide');
        $('#burger_menu').removeClass('show');
    } else {
        $('.line1, .line3').addClass('open');
        $('.line2').addClass('hide');
        $('#burger_menu').addClass('show');
    }
});