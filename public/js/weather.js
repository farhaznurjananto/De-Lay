if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
} else {
    alert("Geolocation is not supported by this browser.");
}

function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    var url = "/api/apicuaca?latitude=" + latitude + "&longitude=" + longitude;

    $.get(url, function (data) {
        var dailyForecasts = data.DailyForecasts;

        // headline weather
        document.getElementById("Date").innerHTML = new Date(
            dailyForecasts[0]["Date"]
        ).toDateString();
        document.getElementById("IconPhrase").innerHTML =
            dailyForecasts[0]["Day"]["IconPhrase"];
        document.getElementById("Icon").src =
            "https://developer.accuweather.com/sites/default/files/" +
            (dailyForecasts[0]["Day"]["Icon"] < 10
                ? "0" + dailyForecasts[0]["Day"]["Icon"]
                : dailyForecasts[0]["Day"]["Icon"]) +
            "-s.png";
        document.getElementById("Icon").style.width = "150px";
        document.getElementById("Maximum").innerHTML =
            dailyForecasts[0]["Temperature"]["Maximum"]["Value"] +
            "°" +
            dailyForecasts[0]["Temperature"]["Maximum"]["Unit"];
        document.getElementById("Minimum").innerHTML =
            dailyForecasts[0]["Temperature"]["Minimum"]["Value"] +
            "°" +
            dailyForecasts[0]["Temperature"]["Minimum"]["Unit"];
        // end headline weather

        // forecasts weather
        var forecastHtml = "";
        dailyForecasts.forEach(function (forecast) {
            var date = new Date(forecast.Date);
            var dayOfWeek = [
                "Minggu",
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jum'at",
                "Sabtu",
            ][date.getDay()];
            var weatherDescription = forecast.Day.IconPhrase;
            var weatherIcon =
                forecast.Day.Icon < 10
                    ? "0" + forecast.Day.Icon
                    : forecast.Day.Icon;
            var minTemp = forecast.Temperature.Minimum.Value;

            forecastHtml +=
                '<div class="border-2 border-[#293649] rounded-lg p-5 flex flex-col mt-5 items-center text-center justify-between w-full md:w-52 lg:w-60 mr-2">';
            forecastHtml +=
                '<p class="text-2xl font-semibold text-[#293649] mb-2">' +
                dayOfWeek +
                "</p>";
            // forecastHtml += '<div class="p-3">';
            forecastHtml +=
                "<img class='w-12' src='https://developer.accuweather.com/sites/default/files/" +
                weatherIcon +
                "-s.png'>";
            // forecastHtml += "</div>";
            forecastHtml +=
                '<p class="text-sm text-[#293649] mb-3">' +
                weatherDescription +
                "</p>";
            forecastHtml += minTemp + "°F";
            forecastHtml += "</div>";
        });

        $("#weather-forecast").html(forecastHtml);
        // end forecasts weather
    });
}
