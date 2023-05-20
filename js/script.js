// Fetch server UTC time using ISO-8601 format
const serverTimeElement = document.getElementById('server-time');
const serverTime = new Date().toISOString();
serverTimeElement.textContent = `Server UTC time: ${serverTime}`;

// Fetch client IP address
const clientIpElement = document.getElementById('client-ip');
fetch('https://api.ipify.org?format=json')
  .then(response => response.json())
  .then(data => {
    const clientIp = data.ip;
    clientIpElement.textContent = `Client IP address: ${clientIp}`;
  });

  //Vlidating the username input
function validateForm() {
  var username = document.getElementById("username").value;

  // Regular expression to match alphanumeric characters
  var alphanumericRegex = /^[a-zA-Z0-9]+$/;

  // Check if the username contains only alphanumeric characters
  if (!alphanumericRegex.test(username)) {
    alert("Username can only contain alphanumeric characters.");
    return false; // Prevent form submission
  }
}
