(async function(){
    if (navigator.geolocation) {
        const position = navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
        return history.go(-1);
    }

    async function showPosition(position) {
        var latitude = await position.coords.latitude;
        var longitude = await  position.coords.longitude;
    
        var url = "/api/apicuaca?latitude="+latitude+"&longitude="+longitude;
    
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
            var forecastHtml;
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
                    '<div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3 text-center">';
                forecastHtml += "<span>" + dayOfWeek + "</span>";
                forecastHtml +=
                    "<img src='https://developer.accuweather.com/sites/default/files/" +
                    weatherIcon +
                    "-s.png'>";
                forecastHtml += "<span>" + weatherDescription + "</span>";
                forecastHtml += "<span>" + minTemp + "°F</span>";
                forecastHtml += "</div>";
            });

            $("#weather-forecast").html(forecastHtml);
            // end forecasts weather
        });
    }
})();
