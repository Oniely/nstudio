$(document).ready(function () {
    // To pay
    $("#toPayProducts").on('click', '.viewMoreBtn', function () {
        var orderId = $(this).data('order-id');
        $.ajax({
            url: "/nstudio/includes/ajax/view_more.php",
            method: "GET",
            data: {
                orderID: orderId,
            },
            success: function (data) {
                $("#toPayProducts").html(data);
                $('#toPayProducts').append(`
                <div class="w-full flex justify-start gap-3 uppercase -mt-8">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="goBackBtn" class="text-sm w-full h-full">Back</button>
                    </div>
                </div>
                `);
            }
        });
    });
    $("#toPayProducts").on('click', '#goBackBtn', function () {
        $.ajax({
            url: "/nstudio/includes/ajax/to_pay.php",
            method: "GET",
            success: function (data) {
                $("#toPayProducts").html(data);
            }
        });
    });
    $('#toPayProducts').on('click', '.cancelOrderBtn', function () {
        $('#popup-btn').click();
        let orderID = $(this).attr('data-order-id');
        console.log(orderID);

        $("#confirmBtn").on('click', function () {
            $.ajax({
                url: "/nstudio/includes/ajax/cancel_order.php",
                method: "POST",
                data: {
                    orderID: orderID,
                },
                success: function (data) {
                    if (data === "SUCCESS") location.reload();
                    if (data === "ERROR") return alert("Something went wrong. Please try again later.");
                }
            });
        });
    });

    // To ship orders
    $("#toShipProducts").on('click', '.viewMoreBtn', function () {
        var orderId = $(this).data('order-id');
        $.ajax({
            url: "/nstudio/includes/ajax/view_more.php",
            method: "GET",
            data: {
                orderID: orderId,
            },
            success: function (data) {
                $("#toShipProducts").html(data);
                $('#toShipProducts').append(`
                <div class="w-full flex justify-start gap-3 uppercase -mt-8">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="goBackBtn" class="text-sm w-full h-full">Back</button>
                    </div>
                </div>
                `);
            }
        });
    });
    $("#toShipProducts").on('click', '#goBackBtn', function () {
        $.ajax({
            url: "/nstudio/includes/ajax/to_ship.php",
            method: "GET",
            success: function (data) {
                $("#toShipProducts").html(data);
            }
        });
    });

    // To receive orders
    $("#toReceiveProducts").on('click', '.viewMoreBtn', function () {
        var orderId = $(this).data('order-id');
        $.ajax({
            url: "/nstudio/includes/ajax/view_more.php",
            method: "GET",
            data: {
                orderID: orderId,
            },
            success: function (data) {
                $("#toReceiveProducts").html(data);
                $('#toReceiveProducts').append(`
                <div class="w-full flex justify-start gap-3 uppercase -mt-8">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="goBackBtn" class="text-sm w-full h-full">Back</button>
                    </div>
                </div>
                `);
            }
        });
    });
    $("#toReceiveProducts").on('click', '#goBackBtn', function () {
        $.ajax({
            url: "/nstudio/includes/ajax/to_receive.php",
            method: "GET",
            success: function (data) {
                $("#toReceiveProducts").html(data);
            }
        });
    });
    $("#toReceiveProducts").on('click', '.orderReceivedBtn', function () {
        var orderId = $(this).data('order-id');
        console.log(orderId)
        $.ajax({
            url: "/nstudio/includes/ajax/order_received.php",
            method: "POST",
            data: {
                orderID: orderId,
            },
            success: function (data) {
                if (data === 'SUCCESS') {
                    location.reload();
                };
                if (data === "ERROR") return alert('Something went wrong. Please try again later.');
            }
        });
    });

    // Cancelled orders
    $('#cancelledProducts').on('click', '.viewMoreBtn', function () {
        $.ajax({
            url: "/nstudio/includes/ajax/view_more.php",
            method: "GET",
            data: {
                orderID: $(this).attr('data-order-id'),
            },
            success: function (data) {
                $("#cancelledProducts").html(data);
                $('#cancelledProducts').append(`
                <div class="w-full flex justify-start gap-3 uppercase -mt-8">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="goBackBtn" class="text-sm w-full h-full">Back</button>
                    </div>
                </div>
                `);
            }
        });
    });
    $("#cancelledProducts").on('click', '#goBackBtn', function () {
        $.ajax({
            url: "/nstudio/includes/ajax/cancelled_products.php",
            method: "GET",
            success: function (data) {
                $("#cancelledProducts").html(data);
            }
        });
    });
});

$(document).keydown((e) => {
    if (e.key === "Escape") {
        $("#popup-modal").hide();
    }
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


$(document).ready(function () {
    const toPayBtn = $('#toPay');
    const toShipBtn = $('#toShip');
    const toReceiveBtn = $('#toReceive');
    const completedBtn = $('#completedBtn');
    const cancelledBtn = $('#cancelledBtn');

    $(toPayBtn).on('click', function () {
        $(toPayBtn).parent().addClass('border-b-2 font-medium');
        $(toShipBtn).parent().removeClass('border-b-2 font-medium');
        $(toReceiveBtn).parent().removeClass('border-b-2 font-medium');
        $(completedBtn).parent().removeClass('border-b-2 font-medium');
        $(cancelledBtn).parent().removeClass('border-b-2 font-medium');

        $('#toPayProducts').addClass('flex');
        $('#toPayProducts').removeClass('hidden');

        $('#toShipProducts').addClass('hidden');
        $('#toReceiveProducts').addClass('hidden');
        $('#completedProducts').addClass('hidden');
        $('#cancelledProducts').addClass('hidden');
    });



    $(toShipBtn).on('click', function () {
        $(toShipBtn).parent().addClass('border-b-2 font-medium');
        $(toPayBtn).parent().removeClass('border-b-2 font-medium');
        $(toReceiveBtn).parent().removeClass('border-b-2 font-medium');
        $(completedBtn).parent().removeClass('border-b-2 font-medium');
        $(cancelledBtn).parent().removeClass('border-b-2 font-medium');

        $('#toShipProducts').addClass('flex');
        $('#toShipProducts').removeClass('hidden');

        $('#toPayProducts').addClass('hidden');
        $('#toReceiveProducts').addClass('hidden');
        $('#completedProducts').addClass('hidden');
        $('#cancelledProducts').addClass('hidden');
    });

    $(toReceiveBtn).on('click', function () {
        $(toReceiveBtn).parent().addClass('border-b-2 font-medium');
        $(toPayBtn).parent().removeClass('border-b-2 font-medium');
        $(toShipBtn).parent().removeClass('border-b-2 font-medium');
        $(completedBtn).parent().removeClass('border-b-2 font-medium');
        $(cancelledBtn).parent().removeClass('border-b-2 font-medium');

        $('#toReceiveProducts').addClass('flex');
        $('#toReceiveProducts').removeClass('hidden');

        $('#toShipProducts').addClass('hidden');
        $('#toPayProducts').addClass('hidden');
        $('#completedProducts').addClass('hidden');
        $('#cancelledProducts').addClass('hidden');
    });

    $(completedBtn).on('click', function () {
        $(completedBtn).parent().addClass('border-b-2 font-medium');
        $(toPayBtn).parent().removeClass('border-b-2 font-medium');
        $(toShipBtn).parent().removeClass('border-b-2 font-medium');
        $(toReceiveBtn).parent().removeClass('border-b-2 font-medium');
        $(cancelledBtn).parent().removeClass('border-b-2 font-medium');

        $('#completedProducts').addClass('flex');
        $('#completedProducts').removeClass('hidden');

        $('#toReceiveProducts').addClass('hidden');
        $('#toShipProducts').addClass('hidden');
        $('#toPayProducts').addClass('hidden');
        $('#cancelledProducts').addClass('hidden');
    });

    $(cancelledBtn).on('click', function () {
        $(completedBtn).parent().removeClass('border-b-2 font-medium');
        $(toPayBtn).parent().removeClass('border-b-2 font-medium');
        $(toShipBtn).parent().removeClass('border-b-2 font-medium');
        $(toReceiveBtn).parent().removeClass('border-b-2 font-medium');
        $(cancelledBtn).parent().addClass('border-b-2 font-medium');

        $('#cancelledProducts').addClass('flex');
        $('#cancelledProducts').removeClass('hidden');

        $('#toReceiveProducts').addClass('hidden');
        $('#toShipProducts').addClass('hidden');
        $('#toPayProducts').addClass('hidden');
        $('#completedProducts').addClass('hidden');
    });
});