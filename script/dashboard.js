$(document).ready(function () {
    const toPayBtn = $('#toPay');
    const toShipBtn = $('#toShip');
    const toReceiveBtn = $('#toReceive');
    const completedBtn = $('#completedBtn');

    $(toPayBtn).on('click', function () {
        $(toPayBtn).parent().addClass('border-b-2');
        $(toShipBtn).parent().removeClass('border-b-2');
        $(toReceiveBtn).parent().removeClass('border-b-2');
        $(completedBtn).parent().removeClass('border-b-2');
    });



    $(toShipBtn).on('click', function () {

        $(toShipBtn).parent().addClass('border-b-2');
        $(toPayBtn).parent().removeClass('border-b-2');
        $(toReceiveBtn).parent().removeClass('border-b-2');
        $(completedBtn).parent().removeClass('border-b-2');
    });

    $(toReceiveBtn).on('click', function () {

        $(toReceiveBtn).parent().addClass('border-b-2');
        $(toPayBtn).parent().removeClass('border-b-2');
        $(toShipBtn).parent().removeClass('border-b-2');
        $(completedBtn).parent().removeClass('border-b-2');
    });

    $(completedBtn).on('click', function () {
        
        $(completedBtn).parent().addClass('border-b-2');
        $(toPayBtn).parent().removeClass('border-b-2');
        $(toShipBtn).parent().removeClass('border-b-2');
        $(toReceiveBtn).parent().removeClass('border-b-2');
    });
});