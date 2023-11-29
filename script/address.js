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

    $('.editBtn').on('click', function(e) {
        const target = e.currentTarget;
        let userDetails = target.siblings('#userDetails');

        console.log(userDetails)

        $.ajax({
            url: "../includes/ajax/edit_address.php",
            type: "GET",
            data: {  }
        })
    });
});