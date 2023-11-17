$(document).ready(() => {
    const form = $("#searchForm");

    form.on("submit", function (e) {
        e.preventDefault();

        let keywords = $("#search").val();
        const action = $(this).attr("action");

        const to = new URL(
            action,
            `http://localhost/nstudio/views/search.php/?key=${keywords}`
        );

        window.location.href = to.toString();
    });


    $("#search").on("input", () => {
        var keywords = $("#search").val();
        var suggestionsDiv = $("#suggestions");

        suggestionsDiv.empty();

        if (keywords.length > 0) {
            $.ajax({
                url: "/nstudio/includes/ajax/search.php",
                method: "GET",
                data: { keywords: keywords },
                dataType: "json",
                success: (suggestions) => {
                    if (suggestions.length < 1) return suggestionsDiv.append($('<h1 class="text-2xl pt-3">').text(`See results for ${keywords}.`));

                    console.log(suggestions);

                    suggestions.forEach((suggestion) => {
                        let link = $(
                            `<a class='search_link underline mt-1 focus:font-semibold outline-0' href='/nstudio/views/search.php/?key=${suggestion}'>`
                        ).text(suggestion);
                        suggestionsDiv.append(link);
                    });
                },
            });
        }
    });

    const searchBtn = document.querySelectorAll('#searchBtn');

    $(searchBtn).on("click", () => {
        $("#searchForm").toggle();
        $("#search").focus();
    });

    $("#searchClose").on("click", () => {
        $("#searchForm").hide();
    });

    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#searchForm").hide();
        }

        if (e.key === "/") {
            $('#searchForm').show();
            $("#search").focus();
            e.preventDefault();
        }
    });

    $(document).on("click", (e) => {
        if (
            !$(e.target).closest("#searchBtn").length &&
            !$(e.target).closest("#searchForm").length
        ) {
            $("#searchForm").hide();
        }
    });

    $(document).keydown(function (e) {
        let links = $(".search_link");
        let currentIndex = links.index(document.activeElement);

        if (e.key === "ArrowDown") {
            currentIndex = (currentIndex + 1) % links.length;
            links.eq(currentIndex).focus();
            e.preventDefault();
        } else if (e.key === "ArrowUp") {
            currentIndex = (currentIndex - 1 + links.length) % links.length;
            links.eq(currentIndex).focus();
            e.preventDefault();
        }
    });
});
