<!-- 
The home page will be used to search for listings in the database

Display a drop-down menu for all states in the database, followed by check-in and check-out date inputs.
The dates must follow these rules:
 1. The check-in date cannot be earlier than the current date.
 2. The check-out date cannot be before or the same as the check-in date.

Add a "Search" button to submit your query that will take you to the "results.php" page.

-->

<div class="py-12">
    <div class="wrapper">
        <h3 class="text-3xl text-slate-800 font-semibold text-center mb-4">Booking</h3>

        <form class="max-w-md mx-auto space-y-4" action="results.php" method="POST" id="index-search-form">

            <!-- For drop down I have used this component -->
            <!-- https://www.material-tailwind.com/docs/html/select -->
            <div class="w-full mx-auto">
                <label for="state" class="block mb-2 text-sm text-slate-600">
                    State
                </label>
                <div class="relative">
                    <select id="state" name="state" required
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        <option value="" selected>--Choose a state--</option>

                        <?php foreach ($states as $state): ?>
                            <option value="<?= $state["id"] ?>"><?= $state["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>



            <div class="relative w-full mx-auto">
                <label for="checkin" class="block mb-2 text-sm text-slate-600">
                    Check In Date
                </label>

                <input id="checkin" type="date" name="checkin" required
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="Select checkin date">
            </div>

            <div class="relative w-full mx-auto">
                <label for="checkout" class="block mb-2 text-sm text-slate-600">
                    Checkout Out Date
                </label>

                <input id="checkout" type="date" name="checkout" required
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="Select checkout date">
            </div>

            <input type="submit" class=" w-full mx-auto inline-flex cursor-pointer items-center justify-center px-4 py-2 text-base
                font-medium leading-6 text-gray-600 whitespace-no-wrap bg-white border border-gray-200 rounded-md
                shadow-sm hover:bg-gray-50 focus:outline-none focus:shadow-none" value="Search" />

            <p class="text-center text-red-500 text-bold" id="error"></p>
        </form>
    </div>
</div>