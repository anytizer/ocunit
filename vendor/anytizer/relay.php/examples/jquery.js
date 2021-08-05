$.ajax({
    type: "POST",
    url: "https://hookb.in/xxxxxxxxxxxxxx",
    data: JSON.stringify({
        "name": "John"
    }),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (data) {
        console.log("done.");
    }
});
