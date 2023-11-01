const minusBtns = document.querySelectorAll('#minusBtn');
const addBtns = document.querySelectorAll('#addBtn');

minusBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        $.ajax({
            url: "../includes/cart_quantity.php",
            type: "POST",
            data: { action: "minus_quantity" },
            success: (res) => {
                $('#quantityCount').text(res);
                console.log(res);
            }
        })
    })
})
