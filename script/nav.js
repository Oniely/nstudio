const navbar = document.querySelector("#main_navbar");
const heroSection = document.querySelector("#hero_section");
let prevScrollPos = window.scrollY;

function isElementVisible(element) {
    const rect = element.getBoundingClientRect();
    return rect.top <= window.innerHeight && rect.bottom >= 0;
}

function updateNavbarVisibility() {
    const currentScrollPos = window.scrollY;
    if (currentScrollPos < prevScrollPos) {
        navbar.style.top = "0";
    } else {
        if (!isElementVisible(heroSection)) {
            navbar.style.top = "-4.5rem";
        }
    }
    prevScrollPos = currentScrollPos;
}

window.addEventListener("scroll", updateNavbarVisibility);
window.addEventListener("resize", updateNavbarVisibility);
