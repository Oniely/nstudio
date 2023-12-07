// Check if an address already exists

$addressSql = "SELECT
                user_address.user_id,
                address_tbl.*
                FROM
                address_tbl
                INNER JOIN user_address ON address_tbl.id = user_address.address_id
                WHERE
                CONCAT(' ', street_name, ' ') LIKE '%'.$street_name . '%'
                AND postal_code = ?
                AND province = ?
                AND contact_number = ?
                AND user_id = ?";
$addressQuery = $conn->prepare($addressSql);
$addressQuery->bind_param("sssi", $pcode, $province, $contact_number, $userID);
$addressQuery->execute();

$address = $addressQuery->get_result();

if ($address && $address->num_rows == 1) {
}


<div class="w-full flex flex-col gap-3 h-full p-4 pl-6 border border-[#505050]">
    <!-- Top -->
    <div class="w-full flex items-center gap-2">
        <div class="h-44 shrink-0">
            <a href="#">
                <img class="max-w-full h-full object-cover" src="/nstudio/img/product/prod2.png" alt="">
            </a>
        </div>
        <div class="w-full flex flex-col gap-1 h-full">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-sm tracking-[2px]">CHECK WOOL SHIRT</h1>
                    <p class="text-sm">$175 USD</p>
                </div>
                <h1>
                    12/22/2022
                </h1>
            </div>
            <div class="flex flex-col justify-center items-start mb-10">
                <h1 class="text-sm font-semibold uppercase">Variation: <span>Blue</span></h1>
                <p class="before:content-['X'] before:mr-[2px] font-['Lato'] text-sm"><span class="text-[15px]">3</span></p>
            </div>
            <div class="flex justify-between items-start">
                <div class="flex gap-2">
                    <img class="w-5 h-5 object-contain" src="/nstudio/img/delivered.svg" alt="delivered">
                        <h1 class="font-semibold uppercase text-sm text-[#095d40]">Parcel had been delivered</h1>
                </div>
                <p>TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]">539</span></p>
            </div>
        </div>
    </div>
    <hr>
        <!-- Bottom -->
        <div class="w-full flex justify-end gap-3 uppercase">
            <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                <button class="text-sm w-full h-full bg-[#101010] text-white">Rate</button>
            </div>
            <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                <button class="text-sm w-full h-full">Contact Us</button>
            </div>
            <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                <button class="text-sm w-full h-full">Buy Again</button>
            </div>
        </div>
</div>