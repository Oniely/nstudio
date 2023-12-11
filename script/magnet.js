const magnetElements = document.querySelectorAll(".magnet");
const magnetDots = document.querySelectorAll(".magnet-dot");

function handleMagnetMove(e) {
    const { clientX, clientY } = e;
    const rect = this.getBoundingClientRect(); // Get the bounding rect of the current .magnet element
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    const deltaX = clientX - centerX;
    const deltaY = clientY - centerY;
    const distance = Math.sqrt(deltaX ** 2 + deltaY ** 2);

    const magnetStrength = 10; // Adjust this value to control the magnet strength
    const magnetX = (deltaX / distance) * magnetStrength;
    const magnetY = (deltaY / distance) * magnetStrength;

    const magnetDot = this.querySelector(".magnet-dot"); // Get the .magnet-dot element within the current .magnet element

    magnetDot.style.opacity = 1;
    magnetDot.style.transform = `translate(${magnetX}px, ${magnetY}px)`;
}

function handleMouseEnter() {
    const magnetDot = this.querySelector(".magnet-dot"); // Get the .magnet-dot element within the current .magnet element
    magnetDot.style.transform = "scale(1.2)"; // Optional: Add a scale effect on hover
}

function handleMouseLeave() {
    const magnetDot = this.querySelector(".magnet-dot"); // Get the .magnet-dot element within the current .magnet element
    magnetDot.style.opacity = 0;
    magnetDot.style.transform = "translate(0, 0)";
}

magnetElements.forEach((magnetElement) => {
    magnetElement.addEventListener("mousemove", handleMagnetMove);
    magnetElement.addEventListener("mouseenter", handleMouseEnter);
    magnetElement.addEventListener("mouseleave", handleMouseLeave);
});
