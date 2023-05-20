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
