document.addEventListener('DOMContentLoaded', function() {
    // Handle class filter buttons
    const classButtons = document.querySelectorAll('.class-buttons .btn');
    const artworksContainer = document.getElementById('artworks-container');
    
    classButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const className = this.getAttribute('data-class');
            console.log('Filtering by class:', className);
            
            // Show loading state
            artworksContainer.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Filter artworks
            filterArtworks('class', className);
            
            // Update active state of buttons
            classButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Filter artworks function
    function filterArtworks(type, value) {
        const artworkCards = document.querySelectorAll('.artwork-card');
        let visibleCount = 0;

        console.log('Filtering with value:', value);

        artworkCards.forEach(card => {
            const cardValue = card.getAttribute(`data-${type}`);
            console.log('Card value:', cardValue);
            
            // Handle empty class names and "All" case
            if (value === 'All' || (cardValue && cardValue === value)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        console.log('Visible count:', visibleCount);

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

    // Initialize the gallery
    function initializeGallery() {
        // Show loading state
        artworksContainer.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        // Fetch artworks and classes
        $.ajax({
            url: '/api/artworks',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    renderGallery(response.data);
                } else {
                    showError('Failed to load artworks: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                showError('Error loading artworks. Please try again later.');
                console.error('Error:', error);
            }
        });
    }

    function renderGallery(data) {
        const { artworks, classes } = data;
        
        // Render class buttons
        const classButtonsContainer = document.getElementById('class-buttons-container');
        classButtonsContainer.innerHTML = '<a href="#" class="btn btn-outline-secondary me-2 mb-2 active" data-class="All">All</a>';
        
        classes.forEach(className => {
            if (className) {
                const button = document.createElement('a');
                button.href = '#';
                button.className = 'btn btn-outline-secondary me-2 mb-2';
                button.setAttribute('data-class', className);
                button.textContent = className;
                classButtonsContainer.appendChild(button);
            }
        });

        // Render artworks
        artworksContainer.innerHTML = '';
        if (artworks.length === 0) {
            artworksContainer.innerHTML = '<div class="alert alert-info">No artworks found.</div>';
            return;
        }

        artworks.forEach(artwork => {
            const artworkCard = document.createElement('div');
            artworkCard.className = 'artwork-card';
            artworkCard.setAttribute('data-class', artwork.class_name || '');

            artworkCard.innerHTML = `
                <div class="artwork-image">
                    <img src="${artwork.image_url}" alt="${artwork.title}">
                </div>
                <div class="artwork-info">
                    <h3>${artwork.title}</h3>
                    ${artwork.class_name ? `<p class="class-tag">${artwork.class_name}</p>` : ''}
                    <p>${artwork.description || ''}</p>
                    <p>
                        <small>
                            Medium: ${artwork.medium || 'Not specified'}<br>
                            Dimensions: ${artwork.dimensions || 'Not specified'}
                        </small>
                    </p>
                    ${artwork.price ? `<p><strong>Price: $${parseFloat(artwork.price).toFixed(2)}</strong></p>` : ''}
                    <div class="artwork-actions">
                        <a href="/artworks/${artwork.id}" class="btn">View Details</a>
                        ${artwork.etsy_url ? `<a href="${artwork.etsy_url}" class="btn ms-2 etsy-link" target="_blank">Buy on Etsy</a>` : ''}
                    </div>
                </div>
            `;

            artworksContainer.appendChild(artworkCard);
        });

        // Reattach event listeners
        attachEventListeners();
    }

    function showError(message) {
        artworksContainer.innerHTML = `
            <div class="alert alert-danger">
                ${message}
                <button class="btn btn-sm btn-outline-danger ms-2" onclick="initializeGallery()">Retry</button>
            </div>
        `;
    }

    function attachEventListeners() {
        // Reattach class filter button listeners
        document.querySelectorAll('.class-buttons .btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const className = this.getAttribute('data-class');
                filterArtworks('class', className);
                
                // Update active state
                document.querySelectorAll('.class-buttons .btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Reattach Etsy link listeners
        document.querySelectorAll('.etsy-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.open(this.href, '_blank');
            });
        });
    }

    // Initialize the gallery when the page loads
    initializeGallery();
}); 