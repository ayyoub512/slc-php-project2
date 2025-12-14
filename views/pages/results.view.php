<!-- 
This page will display all the results for the chosen state as a drop-down menu of cities with listings available.
* There will be a "Change State or Dates" button to backtrack to the home page.
* There will be a dropdown menu containing all cities associated with the state in the database.
* There is a number counter for the number of rooms available, starting from 1, and it cannot be negative.
* There is a number counter for the number of guests who need accommodation.
* There is a search button to submit the query containing the city, number of rooms and number of guests.
* If there are no results, the page will display the message "no results". Otherwise, the page will display all available listings that match the query.
* If there are positive results, each listing will have a "Book" button for the user to book this listing.

* The "Book" button redirects the user to "book.php".
-->


<div class="py-12">
    <div class="wrapper max-w-5xl mx-auto">
        <h3 class="text-3xl text-slate-800 font-semibold text-center mb-4">Results for <?= $state ?></h3>

        <form class="max-w-md mx-auto space-y-4" action="results.php" method="POST" id="results-search-form">
            <a href="index.php" class="w-fit mx-auto inline-flex cursor-pointer items-center justify-center px-4 py-2 text-base
                font-medium leading-6 text-gray-600 whitespace-no-wrap bg-white border border-gray-200 rounded-md
                shadow-sm hover:bg-gray-50 focus:outline-none focus:shadow-none">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18">
                    </path>
                </svg>

                Change State or Dates
            </a>

            <!-- I need someway to save previous page state (checkin dates, and state)  -->
            <!-- To that I will make hidden input faileds to store it and later us jquery to extract them while sending out the request -->
            <input type="hidden" name="checkin" value="<?= $checkin ?>">
            <input type="hidden" name="checkout" value="<?= $checkout ?>">
            <input type="hidden" name="state-id" value="<?= $stateId ?>">

            <!-- For drop down I have used this component -->
            <!-- https://www.material-tailwind.com/docs/html/select -->
            <div class="w-full mx-auto">
                <label for="city" class="block mb-2 text-sm text-slate-600">
                    City
                </label>
                <div class="relative">
                    <select id="city" name="city" required class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border
                         border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none 
                         focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none 
                         cursor-pointer">
                        <option value="" selected>--Choose a city--</option>

                        <?php foreach ($cities as $city): ?>
                            <option value="<?= $city["id"] ?>"><?= $city["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>

            <div class="w-full mx-auto">
                <label for="number-rooms" class="block mb-2 text-sm text-slate-600">Number of rooms</label>
                <input type="number" name="rooms" step="1" min="1"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="1" required />
            </div>

            <div class="w-full mx-auto">
                <label for="number-guests" class="block mb-2 text-sm text-slate-600">Number of guests</label>
                <input type="number" name="guests" step="1" min="1"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="1" required />
            </div>

            <input type="submit" class="w-full mx-auto inline-flex cursor-pointer items-center justify-center px-4 py-2 text-base
                font-medium leading-6 text-gray-600 whitespace-no-wrap bg-white border border-gray-200 rounded-md
                shadow-sm hover:bg-gray-50 focus:outline-none focus:shadow-none" value="Search" />

            <p class="text-center text-red-500 text-bold" id="error"></p>
        </form>

        <div id="listings" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 wrapper px-6">
        </div>

    </div>
</div>