function fetchRooms(city, rooms, guests) {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: "api/listings.api.php",
			method: "POST",
			data: { city, rooms, guests },
			cache: false
		})
			.done(function (data) {
				resolve(data);

				if (data["ok"] === 1) {
					resolve(data);
					// window.location.replace("admin.php");
				} else {
					reject(data);
				}
			})
			.fail(function () {
				reject(null);
			});
	});
}

$(async function () {
	$("#index-search-form").on("submit", function (event) {
		event.preventDefault();
		const fromDataArray = $(this).serializeArray(); // turns data into array

		console.log(fromDataArray);
		const checkInDate = new Date(fromDataArray[1]["value"]);
		const checkOutDate = new Date(fromDataArray[2]["value"]);
		const todayDate = new Date();

		// I removed the hours because they were missing with the comparison
		checkInDate.setHours(0, 0, 0, 0);
		checkOutDate.setHours(0, 0, 0, 0);
		todayDate.setHours(0, 0, 0, 0);

		// https://stackoverflow.com/questions/34747467/how-do-i-compare-two-dates-in-html
		if (checkInDate >= checkOutDate || todayDate > checkInDate) {
			console.log("Invalid dates");
			$("#error").text("Invalid dates");
		} else {
			// console.log("All good");
			// https://stackoverflow.com/questions/5651933/what-is-the-opposite-of-evt-preventdefault
			$(this).unbind("submit").submit();
		}
	});

	// Results.php form
	$("#results-search-form").on("submit", function (event) {
		event.preventDefault();
		const fromDataArray = $(this).serializeArray(); // turns data into array
		console.log(fromDataArray);
		const city = fromDataArray[3]["value"] || "";
		const rooms = Number(fromDataArray[4]["value"]) || 0;
		const guests = Number(fromDataArray[5]["value"]) || 0;
		const checkin = $("[name='checkin']").val();
		const checkout = $("[name='checkout']").val();
		const stateId = $("[name='state-id']").val(); // not sure I need state id but why not for now.

		if (rooms <= 0 || guests <= 0 || !city) {
			$("#error").text("Invalid number of rooms/guests"); // though i am also checking for city
		} else {
			fetchRooms(city, rooms, guests)
				.then((data) => {
					$("#listings").html(""); // clear if there is anything there
					if (data["data"].length == 0) {
						$("#error").html("").append("No listings match your search criteria");
					} else {
						// We got results, lets clear any errors from last search
						$("#error").html("");
						data["data"].forEach((p) => {
							console.log(p);
							$("#listings").append(`
							    <form method="post" action="book.php" class="relative flex flex-col mx-auto bg-white shadow-sm border border-slate-200 rounded-lg w-full">
                                    <div class="mx-3 mb-0 border-b border-slate-200 pt-3 pb-2 px-1 flex justify-between gap-3">
                                        <span class="text-sm text-slate-600 font-medium">
                                            $${p["price_by_night"]}  
                                        </span>

                                        <span class="text-sm text-slate-600 ">
                                            ${p["latitude"]} ,  ${p["longitude"]}
                                        </span>
                                    </div>
                                    <div class="p-4">
                                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                                            ${p["name"]}
                                        </h5>
                                        <p class="text-slate-600 leading-normal font-light">
                                        ${p["description"]}
                                        </p>
                                    
                                    </div>

                                    <input type="submit" value="Book" class="m-4 w-fit cursor-pointer rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent 
                                            text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none 
                                            active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 
                                            disabled:shadow-none"  />
                                    
                                    <!-- Using form and hidden input field to submit GET post, 
                                        I learned this while building shopify themes previously :) -->

                                    <input type="hidden" name="place-id" value="${p["id"]}" />
                                    <input type="hidden" name="state-id" value="${stateId}" />
                                    <input type="hidden" name="checkin" value="${checkin}" />
                                    <input type="hidden" name="checkout" value="${checkout}" />
                                </form>
							`);
						});
					}
				})
				.catch((data) => {
					let error = "Error while loading listings";
					if (data !== null) {
						error = data;
					}
					$("#error").html("").append(`${error}`);
				});
		}
	});
});
