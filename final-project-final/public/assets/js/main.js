document.addEventListener('DOMContentLoaded', function() {
    // Handle class filter
    const classFilter = document.getElementById('classFilter');
    if (classFilter) {
        classFilter.addEventListener('submit', function(e) {
            e.preventDefault();
            const className = document.getElementById('class').value;
            if (className) {
                window.location.href = `/artworks/class/${encodeURIComponent(className)}`;
            } else {
                window.location.href = '/artworks';
            }
        });
    }

    // Handle artwork details modal
    const artworkCards = document.querySelectorAll('.artwork-card');
    artworkCards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (!e.target.closest('.view-details')) {
                const artworkId = this.dataset.id;
                if (artworkId) {
                    window.location.href = `/artworks/${artworkId}`;
                }
            }
        });
    });

    // Handle Etsy integration
    const etsyLinks = document.querySelectorAll('.etsy-link');
    etsyLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const etsyUrl = this.href;
            window.open(etsyUrl, '_blank');
        });
    });

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}); 