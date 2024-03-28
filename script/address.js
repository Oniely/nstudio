$(document).ready(function () {
    $("#addressBtn").on("click", function () {
        $("#addressModal").toggleClass("hidden flex");
        $("#modalTitle").text("Add New Address");

        $("#addNewAddressBtn").addClass("inline-flex");
        $("#addNewAddressBtn").removeClass("hidden");

        $("#updateAddressBtn").addClass("hidden");
        $("#updateAddressBtn").removeClass("inline-flex");

        $("#fname").val("");
        $("#lname").val("");
        $("#email").val("");
        $("#street_name").val("");
        $("#pcode").val("");
        $("#city").val("");
        $("#province").val("");
        $("#contact_number").val("");
        $("#defaultAddress").prop("checked", false);

        $("#fname").focus();
    });

    $("#mainContainer").on("click", "#closeAddressBtn", function () {
        $("#addressModal").removeClass("flex");
        $("#addressModal").addClass("hidden");
    });

    $(document).keydown((e) => {
        if (e.key === "Escape") {
            $("#addressModal").addClass("hidden");
            $("#addressModal").removeClass("flex");
            $("#popup-modal").hide();
        }
    });

    $("#addressContainer").on("click", ".editBtn", function (e) {
        const addressID = $(e.target).attr("data-address-id");
        console.log("Edit Address Id", addressID);
        $("#updateAddressBtn").attr("data-address-id", addressID);
        $("#modalTitle").text("Update Address");

        $("#addNewAddressBtn").removeClass("inline-flex");
        $("#addNewAddressBtn").addClass("hidden");

        $("#updateAddressBtn").removeClass("hidden");
        $("#updateAddressBtn").addClass("inline-flex");

        $.ajax({
            url: "/nstudio/includes/ajax/edit_address.php",
            type: "GET",
            data: {
                address_id: addressID,
            },
            success: (res) => {
                if (res === "ERROR")
                    return alert(
                        "Something went wrong, Please Try Again Later."
                    );

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
                $("#fname").focus();
            },
            error: (err) => {
                console.error(err);
            },
        });
    });
});

$("#mainContainer").on("click", "#updateAddressBtn", function (e) {
    const updateAddressId = $("#updateAddressBtn").attr("data-address-id");

    // console.log("Update Address Id", updateAddressId);
    // console.log(e.target);

    const currentEditBtn = $(`[data-address-id=${updateAddressId}]`);

    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let email = $("#email").val();
    let street_name = $("#street_name").val();
    let pcode = $("#pcode").val();
    let city = $("#city").val();
    let province = $("#province").val();
    let country = $("#country").val();
    let contact_number = $("#contact_number").val();

    $.ajax({
        url: "/nstudio/includes/ajax/update_address.php",
        type: "POST",
        data: {
            action: "update_address",
            address_id: updateAddressId,
            fname: fname,
            lname: lname,
            email: email,
            street_name: street_name,
            pcode: pcode,
            city: city,
            province: province,
            country: country,
            contact_number: contact_number,
            default: $("#defaultAddress").is(":checked")
                ? 1
                : 0,
        },
        success: (res) => {
            if (res === "ERROR")
                return alert(
                    "Something went wrong, Please Try Again Later."
                );
            if (res === "UPDATE FAILED")
                return alert("Update Failed");

            if (res === "SUCCESS") {
                $("#addressModal").removeClass("flex");
                $("#addressModal").addClass("hidden");
                $("#updateAddressBtn").attr(
                    "data-address-id",
                    ""
                );

                const card = $(currentEditBtn).closest(
                    ".addressCard"
                );
                card.find(".fullname").text(
                    `${fname} ${lname}`
                );
                card.find(".email").text(email);
                card.find(".street_name").text(street_name);
                card.find(".city").text(
                    `${city} ${province}`
                );
                card.find(".pcode").text(pcode);
                card.find(".country").text(country);
                card.find(".contact_number").text(
                    contact_number
                );

                if ($("#defaultAddress").is(":checked")) {
                    $(".is_default").text("");
                    card.find(".is_default").text(
                        "Default"
                    );
                } else {
                    card.find(".is_default").text("");
                }

                $("#success-text").text("Address Updated!");
                gsap.to("#alert-success", {
                    duration: 1,
                    opacity: 1,
                });
                gsap.from(".line", {
                    duration: 5,
                    right: "",
                });
                gsap.to(".line", {
                    duration: 5,
                    right: "0.5",
                });
                setTimeout(() => {
                    gsap.to("#alert-success", {
                        duration: 0.4,
                        opacity: 0,
                    });
                }, 5000);
            }
        },
    });
}
);

$("#mainContainer").on("click", "#addNewAddressBtn", function (e) {
    const fname = $("#fname").val();
    const lname = $("#lname").val();
    const email = $("#email").val();
    const street_name = $("#street_name").val();
    const pcode = $("#pcode").val();
    const city = $("#city").val();
    const province = $("#province").val();
    const country = $("#country").val();
    const contact_number = $("#contact_number").val();

    if (fname === "") {
        $("#warning-text").text("First Name is required.");
    } else if (lname === "") {
        $("#warning-text").text("Last  Name is required.");
    } else if (email === "") {
        $("#warning-text").text("Email is required.");
    } else if (street_name === "") {
        $("#warning-text").text("Street  Name is required.");
    } else if (pcode === "") {
        $("#warning-text").text("Postal Code is required.");
    } else if (city === "") {
        $("#warning-text").text("City is required.");
    } else if (province === "") {
        $("#warning-text").text("Province is required.");
    } else if (country === "") {
        $("#warning-text").text("Country is required.");
    } else if (contact_number === "") {
        $("#warning-text").text("Contact Number is required.");
    }

    if (
        [
            fname,
            lname,
            email,
            street_name,
            pcode,
            city,
            province,
            country,
            contact_number,
        ].includes("")
    ) {
        gsap.to("#alert-warning", { duration: 1, opacity: 1 });
        gsap.from(".line", { duration: 5, right: "" });
        gsap.to(".line", { duration: 5, right: "0.5" });
        setTimeout(() => {
            gsap.to("#alert-warning", { duration: 0.4, opacity: 0 });
        }, 5000);
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
                return alert("Something went wrong, Please Try Again Later.");
            const data = JSON.parse(res);
            console.log(res);
            console.log(data);
            if (data[1] === "1") {
                $(".is_default").text("");
            }
            $("#addressContainer").append(data[0]);

            $("#addressModal").toggleClass("hidden flex");

            $("#success-text").text("New Address Added!");
            gsap.to("#alert-success", { duration: 1, opacity: 1 });
            gsap.from(".line", { duration: 5, right: "" });
            gsap.to(".line", { duration: 5, right: "0.5" });
            setTimeout(() => {
                gsap.to("#alert-success", {
                    duration: 0.4,
                    opacity: 0,
                });
            }, 5000);
        },
        error: (err) => {
            console.error(err);
        },
    });
});

$("#addressContainer").on("click", ".deleteBtn", function (e) {
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
