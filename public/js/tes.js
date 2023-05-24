$(document).ready(() => {
    $.ajax({
        url: "/api/apicuaca?latitude=11&longitude=11",
        success: (e) => {
            console.log(e);
        },
        error: (e) => {
            console.log(e);
        },
    });
});
