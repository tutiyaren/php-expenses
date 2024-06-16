
document.addEventListener('scroll', function () {
  const scrollPosition = window.scrollY;
  const documentHeight =
    document.documentElement.scrollHeight - window.innerHeight;
  const scrollPercentage = scrollPosition / documentHeight;

  const r = Math.min(255, Math.floor(scrollPercentage));
  const g = Math.min(255, 100 + Math.floor(scrollPercentage));
  const b = Math.min(255, 200 + Math.floor(scrollPercentage));
  const a = 0.5;

  document.body.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${a})`;
});
