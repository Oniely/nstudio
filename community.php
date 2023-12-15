<?php

session_start();
require_once 'includes/connection.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
} else {
    $userID = "";
}

require_once "./includes/functions.php";

$communityActive = "active";

?>

<!doctype html>
<html lang="en" class="scroll-smooth">

<?php require './views/partials/head.php' ?>

<body>
    <!-- Loading Screen -->
    <?php require './views/partials/loading.php' ?>
    <!-- Navbar -->
    <?php require './views/partials/nav.php' ?>
    <!-- Main -->
    <main class="w-full min-h-screen pt-[5rem] overflow-hidden px-[4rem] md:px-[3rem] sm:px-[2rem] pb-[6rem] animate__animated fadeIn">
        <div id="about" class="container h-full">

            <div class="flex justify-center mb-[1rem]">
                <!-- prettier-ignore -->
                <h1 class="text-5xl md:text-4xl font-semibold uppercase text-center tracking-wider whitespace-pre-line">Welcome To Nstudio: Where
                    Fashion Meets Comfort
                </h1>
            </div>
            <!-- First Section -->
            <div id="mission" class="w-full h-full flex md:flex-col-reverse justify-center items-center gap-[5rem] py-[3rem]">
                <div class="flex flex-col justify-between gap-[5.5rem] md:gap-[3rem] w-[min(20rem,100%)]">
                    <!-- prettier-ignore -->
                    <p class="whitespace-pre-line text-sm font-medium text-justify break-words">At Nstudio, we are more than just an e-commerce platform; we are the result of a passionate and dedicated team's commitment to revolutionize your shopping experience. As the brains behind the brand, we take pride in crafting an online haven for fashion enthusiasts where convenience and style seamlessly converge.</p>
                    <div class="flex flex-col gap-5 w-[min(20rem,100%)]">
                        <h1 class="text-4xl font-semibold uppercase text-center">Our Mission</h1>
                        <!-- prettier-ignore -->
                        <p class="whitespace-pre-line text-sm font-medium text-justify break-words">Our mission at Nstudio is clear - to redefine the way you experience fashion. We understand that your style is an extension of your personality, and we believe in making the latest trends easily accessible to you. Whether you prefer to shop from the comfort of your home or on the go, Nstudio is designed to cater to your fashion needs, 24/7.</p>
                    </div>
                </div>
                <div class="w-[min(20rem,100%)] max-h-full shrink-0">
                    <img class="max-w-full w-full object-cover object-center" src="./img/community (1).svg" alt="">
                </div>
            </div>
            <!-- Second Section -->
            <div class="w-full flex md:flex-col justify-center items-center gap-[5rem] py-[3rem]">
                <div class="w-[min(20rem,100%)] max-h-full shrink-0">
                    <img class="max-w-full w-full object-cover object-center" src="./img/s_community (1).svg" alt="">
                </div>
                <div class="flex flex-col justify-between gap-10 w-[min(20rem,100%)]">
                    <!-- prettier-ignore -->
                    <div class="flex flex-col gap-5 w-[min(20rem,100%)]">
                        <h1 class="text-4xl font-semibold uppercase text-start">Passion for Fashion</h1>
                        <!-- prettier-ignore -->
                        <p class="whitespace-pre-line text-sm font-medium text-justify break-words">What sets Nstudio apart is our genuine passion for fashion. We aren't just selling clothes; we are curating a collection that reflects the latest trends, diverse styles, and timeless classics. Each piece on our platform is handpicked with care, ensuring that when you shop with Nstudio, you're investing in quality and style.</p>
                    </div>
                </div>
            </div>
            <!-- Third Section -->
            <div class="w-full flex md:flex-col justify-center items-center gap-[5rem] py-[3rem]">
                <div class="flex flex-col justify-between gap-10 w-[min(20rem,100%)]">
                    <!-- prettier-ignore -->
                    <div class="flex flex-col gap-5 w-[min(20rem,100%)]">
                        <h1 class="text-4xl font-semibold uppercase text-start">User-Centered Design</h1>
                        <!-- prettier-ignore -->
                        <p class="whitespace-pre-line text-sm font-medium text-justify break-words">At the core of our philosophy is a commitment to user-centered design. We've meticulously planned and developed our e-commerce platform with your needs in mind. From the sleek UI/UX design to the intricacies of wireframing, charting, and user flows, every aspect of Nstudio is optimized for a seamless and enjoyable shopping journey.</p>
                    </div>
                </div>
                <div class="w-[min(20rem,100%)] max-h-full shrink-0">
                    <img class="max-w-full w-full object-cover object-center" src="./img/s_community (2).svg" alt="">
                </div>
            </div>
            <hr>
            <div id="our-team" class="flex justify-center my-[2rem] md:py-[1rem]">
                <!-- prettier-ignore -->
                <h1 class="text-5xl md:text-4xl font-semibold uppercase text-center tracking-wider whitespace-pre-line">Meet the visionaries
                    behind Nstudio
                </h1>
            </div>
            <div class="flex justify-center items-center pt-[1rem] pb-[4rem] md:pt-0 md:pb-[3rem]">
                <p class="w-[min(45rem,100%)] whitespace-pre-line text-sm font-medium text-justify break-words">At Nstudio, our success is driven by a team of dedicated professionals who are not just experts in their respective fields but also share a deep passion for fashion. Committed to delivering an unparalleled online shopping experience, we take pride in introducing the individuals who are shaping the future of Nstudio:</p>
            </div>
            <div class="flex flex-col justify-center items-center gap-[4rem] px-[12rem] md:px-0">
                <!-- p1 -->
                <div class="flex md:flex-col gap-8">
                    <div class="w-[16rem] h-[20rem] md:h-[25rem] md:w-full max-h-full shrink-0">
                        <a href="https://www.facebook.com/iamwardell09" target="_blank"><img class="max-w-full w-full h-full object-cover object-center" src="./img/team/1.svg" alt=""></a>
                    </div>
                    <div class="flex flex-col justify-center gap-5">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-semibold">Japheth Gonzales</h1>
                            <p class="text-base font-medium italic">UI/UX Designer / Product Manager</p>
                        </div>
                        <div class="w-[25rem] xs:w-auto">
                            <p class="whitespace-pre-line text-base font-medium text-justify break-words">As the creative force behind Nstudio, Japheth Gonzales, our UI/UX Designer and Product Manager, brings artistry to functionality. Ensuring meticulous project planning, Japheth's role is integral to making the website not only aesthetically pleasing but also seamlessly managed from start to finish.</p>
                        </div>
                    </div>
                </div>
                <!-- p2 -->
                <div class="flex md:flex-col gap-8">
                    <div class="w-[16rem] h-[20rem] md:h-[25rem] md:w-full max-h-full shrink-0">
                        <a href="https://www.facebook.com/kraahh.khaass/" target="_blank"><img class="max-w-full w-full h-full object-cover object-center" src="./img/team/2.svg" alt=""></a>
                    </div>
                    <div class="flex flex-col justify-center gap-5">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-semibold">Denneil Jhune Flores</h1>
                            <p class="text-base font-medium italic">Backend Developer / Data Analyst</p>
                        </div>
                        <div class="w-[25rem] xs:w-auto">
                            <p class="whitespace-pre-line text-base font-medium text-justify break-words">Denneil Jhune Flores, our Backend Developer and Data Analyst, is the architect of Nstudio's digital backbone. His expertise lies in managing data with precision, creating systems that work flawlessly, and prioritizing the convenience and security of administrators, suppliers, and data.</p>
                        </div>
                    </div>
                </div>
                <!-- p3 -->
                <div class="flex md:flex-col gap-8">
                    <div class="w-[16rem] h-[20rem] md:h-[25rem] md:w-full max-h-full shrink-0">
                        <a href="https://www.facebook.com/nielangelo.gencaya" target="_blank"><img class="max-w-full w-full h-full object-cover object-center" src="./img/team/3.svg" alt=""></a>
                    </div>
                    <div class="flex flex-col justify-center gap-5">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-semibold">Niel Angelo Gencaya</h1>
                            <p class="text-base font-medium italic">Front/Backend Developer</p>
                        </div>
                        <div class="w-[25rem] xs:w-auto">
                            <p class="whitespace-pre-line text-base font-medium text-justify break-words">Niel Angelo Gencaya, our Front/Backend Developer, bridges the gap between design and functionality. Collaborating closely with the UI/UX team, Niel ensures that the visual elegance conceptualized by our designers seamlessly translates into a user-friendly and responsive front-end experience.</p>
                        </div>
                    </div>
                </div>
                <!-- p4 -->
                <div class="flex md:flex-col gap-8">
                    <div class="w-[16rem] h-[20rem] md:h-[25rem] md:w-full max-h-full shrink-0">
                        <a href="https://www.facebook.com/winwin.loberas" target="_blank"><img class="max-w-full w-full h-full object-cover object-center" src="./img/team/4.svg" alt=""></a>
                    </div>
                    <div class="flex flex-col justify-center gap-5">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-semibold">Godwin John Seguiro</h1>
                            <p class="text-base font-medium italic">Backend Developer / Data Analyst</p>
                        </div>
                        <div class="w-[25rem] xs:w-auto">
                            <p class="whitespace-pre-line text-base font-medium text-justify break-words">Godwin John Seguiro, our Backend Developer and Data Analyst, is the guardian of data integrity and system reliability. His commitment to meticulous data management ensures that Nstudio operates with the utmost precision, providing a secure environment for administrators, suppliers, and data.</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <!-- prettier-ignore -->
                    <h1 class="text-5xl md:text-4xl font-semibold uppercase text-center tracking-wider whitespace-pre-line">Collaborative Excellence</h1>
                </div>
                <div class="flex justify-center items-center">
                    <p class="w-[min(45rem,100%)] whitespace-pre-line text-sm font-medium text-justify break-words">At Nstudio, our success is not just about individual expertise but the synergy created by our collaborative spirit. Together, we bring a unique blend of skills and passion to the table, working seamlessly to transform Nstudio into a fashion destination that sets new standards for online shopping.
                        Join us on this fashion-forward journey, where innovation meets aesthetics, and experience the passion and dedication that define the Nstudio team. Discover, shop, and be inspired with Nstudio!</p>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <section class="w-full min-h-[50vh] bg-[#252525] px-[2rem] py-[3rem]">
        <h1 class="text-5xl md:text-4xl font-semibold uppercase text-center tracking-wider whitespace-pre-line mb-[3rem] text-white">Join the NStudio Community</h1>
        <div class="flex justify-center items-center">
            <p class="whitespace-pre-line text-sm font-medium text-justify break-words text-white w-[30rem]">As we unveil Nstudio to the world, we invite you to join our growing community of fashion enthusiasts. Whether you're a trendsetter, a classic connoisseur, or someone who simply loves expressing themselves through fashion, Nstudio is your go-to destination.

                Thank you for being a part of the Nstudio journey. Get ready to embark on a fashion adventure where convenience meets style, and every click brings you closer to your fashion aspirations.

                Happy shopping!

                -The Nstudio Team
            </p>
        </div>
    </section>
    <?php require './views/partials/footer.php' ?>
</body>

</html>