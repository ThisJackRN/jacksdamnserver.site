function createShootingLetter() {
  // Create the letter element
  const letterEl = document.createElement('span');
  const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  const randomLetter = letters.charAt(Math.floor(Math.random() * letters.length));
  letterEl.textContent = randomLetter;
  
  // Assign random color
  const color = `rgb(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255})`;
  letterEl.style.color = color;
  
  // Set initial position and styles
  letterEl.style.position = 'fixed';
  letterEl.style.left = `${Math.random() * window.innerWidth}px`;
  letterEl.style.top = `${window.innerHeight}px`;
  letterEl.style.fontSize = `${Math.random() * 24 + 12}px`;
  
  // Append to the document
  document.body.appendChild(letterEl);
  
  // Animate the letter
  let duration = 0;
  function animate() {
    if (duration > window.innerHeight) {
      document.body.removeChild(letterEl);
    } else {
      duration += Math.random() * 5 + 5;
      letterEl.style.top = `${parseInt(letterEl.style.top) - duration}px`;
      requestAnimationFrame(animate);
    }
  }
  animate();
}

// Start adding letters at random intervals
function startShootingLetters() {
  setInterval(createShootingLetter, 300);
}

startShootingLetters();
