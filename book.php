<?php
// This page will display the booking for confirmation.
// This page will show the check-in and check-out dates, the number of nights, and the owner user of this listing.
// Below are two buttons: one returns to the home page, and the other confirms the listing, redirecting to confirm.php.

require __DIR__ . '/inc/all.inc.php';


if (
    !isset($_POST) || !isset($_POST['place-id']) || !isset($_POST['checkin']) || !isset($_POST['checkout']) ||
    empty($_POST['place-id']) || empty($_POST['checkin']) || empty($_POST['checkout'])
) {
    echo "Invalid form submission";
    exit;
}


$placeId = e($_POST['place-id']); // e to avoid sql injuection :) 
$checkin = e($_POST['checkin']);
$checkout = e($_POST['checkout']);

// Validate that dates are fine 
if (!isCheckingDatesValid($checkin, $checkout)) {
    echo "Invalid Checking date";
    exit;
}


$queryCities = "SELECT p.name as place_name, u.first_name, u.last_name, p.price_by_night 
        FROM places as p INNER JOIN users as u on p.user_id = u.id WHERE p.id =:id";

// Prepares the statement for execution and returns a statement object
$stmtCities = $pdo->prepare($queryCities);
$stmtCities->bindParam(":id", $placeId);
$stmtCities->execute();
$place = $stmtCities->fetch(PDO::FETCH_ASSOC);


// Calculating nights. I took a hint from this answer
// https://stackoverflow.com/a/31196355/6174268
$checkInDate = new DateTime($checkin);
$checkOutDate = new DateTime($checkout);
$nights = $checkOutDate->diff($checkInDate)->format('%a');

render('book.view', [
    'title' => 'Book',
    'placeId' => $placeId,
    'checkin' => $checkin,
    'checkout' => $checkout,
    'place' => $place,
    'nights' => $nights
]);