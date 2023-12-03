// Check if an address already exists

$addressSql = "SELECT
                user_address.user_id,
                address_tbl.*
                FROM
                address_tbl
                INNER JOIN user_address ON address_tbl.id = user_address.address_id
                WHERE
                CONCAT(' ', street_name, ' ') LIKE '% ? %'
                AND postal_code = ?
                AND province = ?
                AND contact_number = ?
                AND user_id = ?";
$addressQuery = $conn->prepare($addressSql);
$addressQuery->bind_param("ssssi", $street_name, $pcode, $province, $contact_number, $userID);
$addressQuery->execute();

$address = $addressQuery->get_result();

if ($address && $address->num_rows == 1) {
}
