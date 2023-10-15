const fadeIn = new IntersectionObserver((entries) => {
    // Loop over the entries
    entries.forEach((entry) => {
        // If the element is visible
        if (entry.isIntersecting) {
            // Add the animation class
            entry.target.classList.add("animate__fadeIn");
        }
    });
});

let fadeInEl = document.querySelectorAll(".fadeUp");

fadeInEl.forEach((el) => {
    fadeInUp.observe(el);
});

const fadeInUp = new IntersectionObserver((entries) => {
    // Loop over the entries
    entries.forEach((entry) => {
        // If the element is visible
        if (entry.isIntersecting) {
            // Add the animation class
            entry.target.classList.add("animate__fadeInUp");
        }
    });
});

let fadeInUpEl = document.querySelectorAll(".fadeUp");

fadeInUpEl.forEach((el) => {
    fadeInUp.observe(el);
});

const slideInUp = new IntersectionObserver((entries) => {
    // Loop over the entries
    entries.forEach((entry) => {
        // If the element is visible
        if (entry.isIntersecting) {
            // Add the animation class
            entry.target.classList.add("animate__slideInUp");
        }
    });
});

let slideInUpEl = document.querySelectorAll(".slideUp");

slideInUpEl.forEach((el) => {
    slideInUp.observe(el);
});
