(() => {
    // Toast
    const toastCloseButton = document.getElementById('toast-close-button');
    if (toastCloseButton) {
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
      });
    
      const toastProgress = document.getElementById('toast-progress');
      if (toastProgress) {
        toastProgress.style.width = '0%';
        setTimeout(() => {
          toastProgress.style.width = '100%';
          setTimeout(() => {
            toastCloseButton.click();
          }, 5000);
        }, 50);
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
    
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
      } else {
        loadingDiv.style.transitionDuration = '0s';
        loadingDiv.style.width = '0%';
        setTimeout(() => {
          loadingDiv.style.width = '0%';
          setTimeout(() => {
            loadingDiv.style.transitionDuration = '1000ms';
          }, 10);
        }, 50); // Just in case
      }
    });
    
})()
    