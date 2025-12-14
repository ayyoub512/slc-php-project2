<?php
if (!isset($_SESSION)) {
    session_start();
}
require __DIR__ . '/../inc/all.inc.php';
header("Content-Type: application/json");
$resp = ['ok' => 1, 'data' => [], 'errors' => []];

try {

    if (!isset($_POST) || !isset($_POST["city"]) || !isset($_POST["rooms"]) || !isset($_POST["guests"])) {
        $resp['ok'] = 0;
        $resp['errors'] = "Invalid form submission";

    } else {
        $cityId = $_POST['city']; // Casting https://stackoverflow.com/a/8529687/6174268
        $rooms = (int) $_POST['rooms'];
        $guests = (int) $_POST['guests'];

        if (empty($cityId) || $rooms <= 0 || $guests <= 0) {
            $resp['ok'] = 0;
            $resp['errors'] = "Invalid form submission";
        } else {
            // I think we're good to query to the database now that we have city id, rooms and guests as expected.

            // Altough the instruction probably meant that we look for listings that have the exact same number of rooms/guest
            // A better query would pull any listing that is >= than requested.. I just think that way
            $queryListings = "SELECT * FROM places WHERE city_id =:id AND number_rooms=:rooms AND max_guest=:guests";

            // Prepares the statement for execution and returns a statement object
            $listingStmt = $pdo->prepare($queryListings);
            $listingStmt->execute([
                ':id' => $cityId,
                ':rooms' => $rooms,
                ':guests' => $guests
            ]);
            $listings = $listingStmt->fetchAll(PDO::FETCH_ASSOC);

            $resp['data'] = $listings;
        }
    }
} catch (Exception $err) {
    http_response_code(500);
    $resp['ok'] = 0;
    $resp['errors'][] = $err->getMessage();
} finally {
    echo json_encode($resp);
}
