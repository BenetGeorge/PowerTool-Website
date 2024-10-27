document.getElementById("loginForm").addEventListener("submit", function(event){
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Basic validation (you can expand it as per your needs)
    if (username === "" || password === "") {
        alert("Both fields are required!");
        return;
    }

    if (username === "admin" && password === "1234") {
        alert("Login successful!");
    } else {
        alert("Incorrect username or password");
    }
});
