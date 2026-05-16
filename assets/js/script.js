
document.addEventListener('DOMContentLoaded', function() {
    const path = window.location.pathname;
    if (path.includes('creature.php') || path.includes('deity.php') || path.includes('object.php')) {
        document.body.classList.add('horror-page');
    }

    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.borderColor = '#8b0000';
        });
        card.addEventListener('mouseleave', () => {
            card.style.borderColor = '#8b5a2b';
        });
    });
});