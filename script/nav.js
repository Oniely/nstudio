const navbar = document.querySelector("#main_navbar");
// const heroSection = document.querySelector("#hero_section");
let prevScrollPos = window.scrollY;

// function isElementVisible(element) {
//     const rect = element.getBoundingClientRect();
//     return rect.top <= window.innerHeight && rect.bottom >= 0;
// }

function updateNavbarVisibility() {
    const currentScrollPos = window.scrollY;
    if (currentScrollPos < prevScrollPos) {
        navbar.style.top = "0";
    } else {
        // if (!isElementVisible(heroSection)) {
            navbar.style.top = "-4.5rem";
        // }
    }
    prevScrollPos = currentScrollPos;
}

window.addEventListener("scroll", updateNavbarVisibility);
window.addEventListener("resize", updateNavbarVisibility);

// -------------------------------------------------------

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

        hoverLink.addEventListener("mouseout", (e) => {
            const targetElement = e.relatedTarget;

            if (!currentHoveredHoverLink.contains(targetElement)) {
                currentHoveredHoverLink.style.height = "0";
                currentHoveredHoverLink.style.padding = "0 2rem";
                currentHoveredHoverLink.style.borderBottom = "0";
            }
        });
    });
});
