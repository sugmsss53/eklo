const letters = document.querySelectorAll('.animated-letter');

letters.forEach((letter, index) => {
    letter.style.animationDelay = `${index * 0.2}s`;
});
