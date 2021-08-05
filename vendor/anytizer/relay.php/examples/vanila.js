var xhr = new XMLHttpRequest();

xhr.open("POST", "https://hookb.in/xxxxxxxxxxxxxx", true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("done.");
    }
};

const data = JSON.stringify({
    "name": "John"
});

xhr.send(data);
