$(document).ready(function () {
    $("#addressBtn").on("click", function () {
        $("#addressModal").toggleClass("hidden flex");
        $('#modalTitle').text("Add New Address");

        $('#addNewAddressBtn').addClass('inline-flex');
        $('#addNewAddressBtn').removeClass('hidden');

        $('#updateAddressBtn').addClass('hidden');
        $('#updateAddressBtn').removeClass('inline-flex');

        $("#fname").val("");
        $("#lname").val("");
        $("#email").val("");
        $("#street_name").val("");
        $("#pcode").val("");
        $("#city").val("");
        $("#province").val("");
        $("#contact_number").val("");
        $('#defaultAddress').prop('checked', false);

        $('#fname').focus();
    });

    $("#closeAddressBtn").on("click", function () {
        $("#addressModal").toggleClass("hidden flex");
    });

    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#addressModal").addClass("hidden");
            $("#addressModal").removeClass("flex");
            $("#popup-modal").hide();
        }
    });

    let addressID;

    $(".editBtn").on("click", function (e) {
        addressID = $(e.currentTarget).attr("data-address-id");
        $('#updateAddressBtn').attr('data-address-id', addressID);
        $('#modalTitle').text("Update Address");

        $('#addNewAddressBtn').removeClass('inline-flex');
        $('#addNewAddressBtn').addClass('hidden');

        $('#updateAddressBtn').removeClass('hidden');
        $('#updateAddressBtn').addClass('inline-flex');

        $.ajax({
            url: "/nstudio/includes/ajax/edit_address.php",
            type: "GET",
            data: {
                address_id: addressID,
            },
            success: (res) => {
                if (res === "ERROR") return alert("Something went wrong, Please Try Again Later.");

                const address = JSON.parse(res);
                $("#addressModal").toggleClass("hidden flex");
                $("#fname").val(address.fname);
                $("#lname").val(address.lname);
                $("#email").val(address.email);
                $("#street_name").val(address.street_name);
                $("#pcode").val(address.pcode);
                $("#city").val(address.city);
                $("#province").val(address.province);
                $("#contact_number").val(address.contact_number);

                $("#defaultAddress").prop(
                    "checked",
                    address.is_default == 1 ? true : false
                );
                if (address.update) {
                    $("#addNewAddressBtn").text("Update Address");
                }
                $('#fname').focus();
            },
            error: (err) => {
                console.error(err);
            },
        });
    });
});

$('#updateAddressBtn').on('click', function () {
    let addressID = $('#updateAddressBtn').attr('data-address-id');

    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let email = $("#email").val();
    let street_name = $("#street_name").val();
    let pcode = $("#pcode").val();
    let city = $('#city').val();
    let province = $("#province").val();
    let country = $("#country").val();
    let contact_number = $("#contact_number").val();

    console.log([addressID, fname, lname, email, street_name, pcode, city, province, country, contact_number]);

    $.ajax({
        url: "/nstudio/includes/ajax/update_address.php",
        type: "POST",
        data: {
            action: "update_address",
            address_id: addressID,
            fname: fname,
            lname: lname,
            email: email,
            street_name: street_name,
            pcode: pcode,
            city: city,
            province: province,
            country: country,
            contact_number: contact_number,
            default: $("#defaultAddress").is(":checked") ? 1 : 0,
        },
        success: (res) => {
            if (res === "ERROR")
                return alert(
                    "Something went wrong, Please Try Again Later."
                );
            if (res === "UPDATE FAILED") return alert('Update Failed');

            if (res === "SUCCESS") {
                location.reload();
            }
        },
    });
});

$("#addNewAddressBtn").on("click", function (e) {
    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let email = $("#email").val();
    let street_name = $("#street_name").val();
    let pcode = $("#pcode").val();
    let city = $('#city').val();
    let province = $("#province").val();
    let country = $("#country").val();
    let contact_number = $("#contact_number").val();

    console.log([fname, lname, email, street_name, pcode, city, province, country, contact_number]);

    if (fname === "") {
        alert("First Name is required.");
        return;
    } else if (lname === "") {
        alert("Last Name is required.");
        return;
    } else if (email === "") {
        alert("Email is required.");
        return;
    } else if (street_name === "") {
        alert("Street Name is required.");
        return;
    } else if (pcode === "") {
        alert("Postal Code is required.");
        return;
    }
    else if (city === "") {
        alert("City is required.");
        return;
    }
    else if (province === "") {
        alert("Province is required.");
        return;
    } else if (country === "") {
        alert("Country is required.");
        return;
    } else if (contact_number === "") {
        alert("Contact Number is required.");
        return;
    }

    $.ajax({
        url: "/nstudio/includes/ajax/add_address.php",
        type: "POST",
        data: {
            action: "add_address",
            fname: fname,
            lname: lname,
            email: email,
            street_name: street_name,
            pcode: pcode,
            city: city,
            province: province,
            country: country,
            contact_number: contact_number,
            default: $("#defaultAddress").is(":checked") ? 1 : 0,
        },
        success: (res) => {
            if (res === "ERROR")
                return alert(
                    "Something went wrong, Please Try Again Later."
                );

            if (res === "SUCCESS") {
                location.reload();
            }
        },
        error: (err) => {
            console.error(err);
        }
    });
});

$(".deleteBtn").on("click", function (e) {
    const addressID = $(e.currentTarget).attr("data-address-id");
    console.log(addressID);
    $("#popup-btn").click();

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
                    window.location.replace(
                        "/nstudio/views/dashboard/address.php"
                    );
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
