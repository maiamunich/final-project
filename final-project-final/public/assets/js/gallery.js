document.addEventListener('DOMContentLoaded', function() {
    // Handle class filter buttons
    const classButtons = document.querySelectorAll('.class-buttons .btn');
    classButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const className = this.textContent;
            filterArtworks('class', className);
        });
    });

    // Filter artworks function
    function filterArtworks(type, value) {
        const artworkCards = document.querySelectorAll('.artwork-card');
        let visibleCount = 0;

        artworkCards.forEach(card => {
            const cardValue = card.getAttribute(`data-${type}`);
            if (value === 'All' || cardValue === value) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show message if no artworks match the filter
        const noResultsMessage = document.getElementById('no-results-message');
        if (visibleCount === 0) {
            if (!noResultsMessage) {
                const message = document.createElement('div');
                message.id = 'no-results-message';
                message.className = 'alert alert-info text-center mt-4';
                message.textContent = 'No artworks found matching the selected filter.';
                document.querySelector('.artworks-grid').appendChild(message);
            }
        } else if (noResultsMessage) {
            noResultsMessage.remove();
        }
    }

    // Handle Etsy links
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