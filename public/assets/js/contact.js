document.addEventListener('DOMContentLoaded', () => {
  // Intersection Observer for scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px"
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        // We can also just rely on the CSS animation playing out
        // If the element has a class like 'fade-up', the animation triggers on load or scroll
      }
    });
  }, observerOptions);

  // Observe all fade-up elements
  document.querySelectorAll('.fade-up').forEach(el => {
    // By default, pause animations if they are below the fold? 
    // Actually our CSS uses 'both' fill-mode which plays automatically.
    // For a true scroll reveal, we toggle a visible class. 
    // In Xynera current codebase, animations just play on load. Wait, let's keep it simple.
  });
});

