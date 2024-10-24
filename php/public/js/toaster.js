
const toastCloseButton = document.getElementById('toast-close-button');
const toastTitle = document.getElementById('toast-title');
const toastContent = document.getElementById('toast-content');
const toastProgress = document.getElementById('toast-progress');
let progressBarTimeout;

function startToast(title, message, level) {
  toastTitle.textContent = title;
  toastContent.textContent = message;
  toastProgress.style = `toast-progress-${level}`;

  toastTitle.removeAttribute("class")
  toastTitle.classList.add(`toast-message-${level}`);
  toastProgress.removeAttribute("class");
  toastProgress.classList.add(`toast-progress-${level}`);

  if (toastCloseButton) {
    toastCloseButton.parentElement.style = `
      transform: translateX(0%) translateY(100%); 
      transition: transform 0s cubic-bezier(0.19, 1, 0.22, 1);
    `
    setTimeout(() => {
      toastCloseButton.parentElement.style = `
        transform: translateX(0%) translateY(100%); 
        transition: transform 0.25s cubic-bezier(0.19, 1, 0.22, 1);
      `
    }, 5);
    setTimeout(() => {
      toastCloseButton.parentElement.style = `
        transform: translateX(0%) translateY(0%);
        transition: transform 0.25s cubic-bezier(0.87, 0, 0.13, 1);
      `;
    }, 50);
    toastCloseButton.addEventListener('click', () => {
      toastCloseButton.parentElement.style = `
        transform: translateX(110%);
        transition: transform 0.25s cubic-bezier(0.87, 0, 0.13, 1);
      `;
      // cancel promise
    });
  
    if (toastProgress) {
      toastProgress.removeAttribute("style");
      toastProgress.style = `
        width: 0%;
      `;
      setTimeout(() => {
        toastProgress.style = `
          width: 100%;
          transition-duration: 5s;
        `;
        
        clearTimeout(progressBarTimeout);
        progressBarTimeout = null;
        progressBarTimeout = setTimeout(() => {
          toastCloseButton.click();
        }, 5000);
      }, 500);
    }
  
  
    // Draggable
    const draggable = toastCloseButton.parentElement;
    let isDragging = false;
    let initialX;
    let initialY;
    let currentX;
    let currentY;
  
    draggable.addEventListener('mousedown', (e) => {
      isDragging = true;
      initialX = e.clientX;
      initialY = e.clientY;
      toastCloseButton.parentElement.style = ``;
    });
    draggable.addEventListener('touchstart', (e) => {
      isDragging = true;
      initialX = e.touches[0].clientX;
      initialY = e.touches[0].clientY;
      toastCloseButton.parentElement.style = ``;
    });
  
    draggable.addEventListener('mouseup', () => {
      isDragging = false;
      if(currentX > 30) {
        toastCloseButton.parentElement.style = `
          transform: translateX(110%);
          transition: transform 0.25s ease-out;
        `;
      }
      else {
        draggable.style.transform = `translateX(${0}px) translateY(${0}px)`;
      }
    });
  
    draggable.addEventListener('touchend', () => {
      isDragging = false;
      if(currentX > 30) {
        toastCloseButton.parentElement.style = `
          transform: translateX(110%);
          transition: transform 0.25s ease-out;
        `;
      }
      else {
        draggable.style.transform = `translateX(${0}px) translateY(${0}px)`;
      }
    });
  
    draggable.addEventListener('mousemove', (e) => {
      if (isDragging) {
        e.preventDefault();
        currentX = e.clientX - initialX;
        currentY = e.clientY - initialY;
        draggable.style.transform = `translateX(${currentX}px) translateY(${0}px)`;
      }
    });
  
    draggable.addEventListener('touchmove', (e) => {
      if (isDragging) {
        e.preventDefault();
        currentX = e.touches[0].clientX - initialX;
        currentY = e.touches[0].clientY - initialY;
        draggable.style.transform = `translateX(${currentX}px) translateY(${0}px)`;
      }
    });
  }
}

if(toastTitle.textContent !== '' && toastContent.textContent !== '') {
  const currentClass = toastTitle.classList[0];
  const level = currentClass.replace("toast-message-", "");
  startToast(toastTitle.textContent, toastContent.textContent, level);
}