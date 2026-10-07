

// Animate stats on scroll
const statNums = document.querySelectorAll('.stat-num');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.animation = 'fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) both';
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.3 });
statNums.forEach(el => observer.observe(el));
