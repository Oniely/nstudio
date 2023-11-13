<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NStudio</title>
    <!-- Styles -->
    <link rel="stylesheet" href="/nstudio/styles/style.css" />
    <link rel="stylesheet" href="/nstudio/styles/navbar.css" />

    <!-- Scripts -->
    <script src="/nstudio/script/animation.js" defer></script>
    <script src="/nstudio/script/magnet.js" defer></script>
    <script src="/nstudio/script/nav.js" defer></script>
    <script src="/nstudio/script/search.js" defer></script>

    <!-- CDNs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                },
                screens: {
                    "2xl": { max: "1535px" },
                    xl: { max: "1279px" },
                    lg: { max: "1023px" },
                    md: { max: "767px" },
                    sm: { max: "639px" },
                    xs: { max: "439px" },
                },
            }
        }
    </script>
</head>