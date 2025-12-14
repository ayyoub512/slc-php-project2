<!-- 
This page will display the booking for confirmation.
This page will show the check-in and check-out dates, the number of nights, and the owner user of this listing.
Below are two buttons: one returns to the home page, and the other confirms the listing, redirecting to confirm.php.
-->


<div class="py-12">
    <div class="wrapper max-w-5xl mx-auto">
        <h3 class="text-3xl text-slate-800 font-semibold text-center mb-4">Your booking details</h3>
        <div class="text-slate-700 text-center space-y-3">
            <p><b>Place: </b><?= $place["place_name"] ?></p>
            <p><b>Check in date: </b><?= $checkin ?></p>
            <p><b>Check out date: </b><?= $checkout ?></p>
            <p><b>Total Nights: </b> <?= $nights ?></p>
            <p><b>Price per night: </b> $<?= $place["price_by_night"] ?></p>
            <p><b>User: </b><?= $place["first_name"] . " " . $place["last_name"] ?></p>

            <a href="confirm.php" class="w-fit block mx-auto  cursor-pointer items-center justify-center px-4 py-2 text-base
                font-medium leading-6 text-gray-600 whitespace-no-wrap bg-white border border-gray-200 rounded-md
                shadow-sm hover:bg-gray-50 focus:outline-none focus:shadow-none">Confirm</a>

            <a href="index.php" class="w-fit block mx-auto cursor-pointer items-center justify-center px-4 py-2 text-base
                font-medium leading-6 text-gray-600 whitespace-no-wrap bg-white border border-gray-200 rounded-md
                shadow-sm hover:bg-gray-50 focus:outline-none focus:shadow-none">Back to home</a>
        </div>
    </div>
</div>