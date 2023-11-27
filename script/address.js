$(document).ready(function () {
    $('#addressBtn').on('click', function () {
        $('#addressModal').toggleClass('hidden flex');
    });

    $('#closeAddressBtn').on('click', function () {
        $('#addressModal').toggleClass('hidden flex');
    });

    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#addressModal").toggleClass('hidden flex');
        }
    });
});