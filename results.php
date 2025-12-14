<?php

// This page will display all the results for the chosen state as a drop-down menu of cities with listings available.
// * There will be a "Change State or Dates" button to backtrack to the home page.
// * There will be a dropdown menu containing all cities associated with the state in the database.
// * There is a number counter for the number of rooms available, starting from 1, and it cannot be negative.
// * There is a number counter for the number of guests who need accommodation.
// * There is a search button to submit the query containing the city, number of rooms and number of guests.
// * If there are no results, the page will display the message "no results".
//  Otherwise, the page will display all available listings that match the query.
// * If there are positive results, each listing will have a "Book" button for the user to book this listing.

// * The "Book" button redirects the user to "book.php".


require __DIR__ . '/inc/all.inc.php';


if (
    !isset($_POST) || !isset($_POST['state']) || !isset($_POST['checkin']) || !isset($_POST['checkout']) ||
    empty($_POST['state']) || empty($_POST['checkin']) || empty($_POST['checkout'])
) {
    echo "Invalid form submission";
    exit;
}


$stateId = e($_POST['state']); // e to avoid sql injuection :) 
$checkin = e($_POST['checkin']);
$checkout = e($_POST['checkout']);

// Validate that dates are fine 
if (!isCheckingDatesValid($checkin, $checkout)) {
    echo "Invalid Checking date";
    exit;
}


$queryCities = "SELECT * FROM cities WHERE state_id = :id";

// Prepares the statement for execution and returns a statement object
$stmtCities = $pdo->prepare($queryCities);
$stmtCities->bindParam(":id", $stateId);
$stmtCities->execute();
$cities = $stmtCities->fetchAll(PDO::FETCH_ASSOC); // fetch all the rows instead of one single row
// https://www.php.net/manual/en/pdostatement.fetchall.php 


// Getting the state name using state id. 
// A simpler option would be to use a hidden post input and set it's value to the name of the chosoen state 
// and catch that with $_POST, but I will do it this way because I think it's temper proof. 
$queryStateName = "SELECT name FROM states where id = :id";
$stateNameStmt = $pdo->prepare($queryStateName);
$stateNameStmt->bindParam("id", $stateId);
$stateNameStmt->execute();
$stateNameRes = $stateNameStmt->fetch(PDO::FETCH_ASSOC);


render('results.view', [
    'title' => 'Results ',
    'stateId' => $stateId,
    'checkin' => $checkin,
    'checkout' => $checkout,
    'state' => $stateNameRes['name'],
    'cities' => $cities
]);