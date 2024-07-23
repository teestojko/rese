const canvas = document.getElementById('clockIcon');
const ctx = canvas.getContext('2d');

function drawClock() {
    const width = canvas.width;
    const height = canvas.height;
    const radius = Math.min(width, height) / 2;

    // Clear canvas
    ctx.clearRect(0, 0, width, height);

    // Draw outer circle
    ctx.beginPath();
    ctx.arc(width / 2, height / 2, radius - 10, 0, 2 * Math.PI);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 4;
    ctx.stroke();

    // Draw hour hand
    ctx.beginPath();
    ctx.moveTo(width / 2, height / 2);
    ctx.lineTo(width / 2, height / 2 - radius / 2);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 4;
    ctx.stroke();

    // Draw minute hand
    ctx.beginPath();
    ctx.moveTo(width / 2, height / 2);
    ctx.lineTo(width / 2, height / 2 - radius * 0.75);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 2;
    ctx.stroke();

    // Draw center dot
    ctx.beginPath();
    ctx.arc(width / 2, height / 2, 4, 0, 2 * Math.PI);
    ctx.fillStyle = '#000';
    ctx.fill();
}

drawClock();
