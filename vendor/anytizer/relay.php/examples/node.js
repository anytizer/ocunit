const https = require("https");

const data = JSON.stringify({
    name: "John"
});

const options = {
    hostname: "hookb.in",
    port: 443,
    path: "/xxxxxxxxxxxxxx",
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "Content-Length": data.length
    }
};

const req = https.request(options, (res) => {
    console.log(`status: ${res.statusCode}`);
});

req.write(data);
req.end();
