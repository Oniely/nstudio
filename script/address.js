$(document).ready(function () {
    $('#addressBtn').on('click', function () {
        $('#addressModal').toggleClass('hidden flex');
        $('#addNewAddressBtn').text("Add New Address");

        $("#fname").val("");
        $("#lname").val("");
        $("#email").val("");
        $("#street_name").val("");
        $("#pcode").val("");
        $("#city").val("");
        $("#province").val("");
        $('#contact_number').val("");
    });

    $('#closeAddressBtn').on('click', function () {
        $('#addressModal').toggleClass('hidden flex');
    });

    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#addressModal").addClass('hidden');
            $("#addressModal").removeClass('flex');
            $("#popup-modal").hide();
        }
    });

    $('.editBtn').on('click', function (e) {
        const addressID = $(e.currentTarget).attr('data-address-id');
        $.ajax({
            url: "/nstudio/includes/ajax/edit_address.php",
            type: "GET",
            data: {
                address_id: addressID,
            },
            success: (res) => {
                if (res === "ERROR") return alert("Something went wrong, Please Try Again Later.");

                const address = JSON.parse(res);
                $('#addressModal').toggleClass('hidden flex');
                $("#fname").val(address.fname);
                $("#lname").val(address.lname);
                $("#email").val(address.email);
                $("#street_name").val(address.street_name);
                $("#pcode").val(address.pcode);
                $("#city").val(address.city);
                $("#province").val(address.province);
                $('#contact_number').val(address.contact_number);

                $('#defaultAddress').prop('checked', address.is_default == 1 ? true : false);
                if (address.update) {
                    $('#addNewAddressBtn').text("Update Address");
                }
            },
            error: (err) => {
                console.error(err);
            },
        });
    });

});

$('.deleteBtn').on('click', function (e) {
    const addressID = $(e.currentTarget).attr('data-address-id');
    console.log(addressID);
    $('#popup-btn').click();

    $("#confirmBtn").on("click", () => {
        $.ajax({
            url: "/nstudio/includes/ajax/delete_address.php",
            type: "POST",
            data: {
                action: "delete_address",
                address_id: addressID,
            },
            success: (res) => {
                if (res === "SUCCESS") {
                    window.location.replace("/nstudio/views/dashboard/address.php");
                } else {
                    $("#popup-modal").hide();
                    console.error("Deletion failed:", res);
                }
            },
        });
        $("#popup-modal").hide();
    });
});

$("#popup-btn").on("click", () => {
    $("#popup-modal").show();
});
$("#cancelBtn").on("click", () => {
    $("#popup-modal").hide();
});
$("#closeBtn").on("click", () => {
    $("#popup-modal").hide();
});