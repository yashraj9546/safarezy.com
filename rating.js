document.addEventListener('DOMContentLoaded', function() {

    // --- Function to initialize rating functionality for a single card ---
    function initializeCardRating(cardElement) {
        // Find elements *within this specific card*
        const starsContainer = cardElement.querySelector('.stars');
        const starIcons = starsContainer ? starsContainer.querySelectorAll('i') : []; // Handle if starsContainer is null
        const riderId = cardElement.dataset.riderId; // Get rider ID from data attribute
        const ratingMessage = cardElement.querySelector('.rating-message');
        const avgRatingDisplay = cardElement.querySelector('.avg-rating-display');
        const displayStarsContainer = cardElement.querySelector('.display-stars-container');
        const downArrow = cardElement.querySelector('.dwn-arrow');
        const ratingSection = cardElement.querySelector('.rating-section');

        let selectedRating = 0; // Each card needs its own selectedRating state

        // Exit if essential elements for rating are not found in this card
        if (!starsContainer || !ratingMessage || !avgRatingDisplay || !displayStarsContainer || !downArrow || !ratingSection) {
            console.warn('Missing essential rating elements in a card:', cardElement);
            return; // Skip initialization for this card if elements are missing
        }

        // Function to update star appearance for a given set of stars
        function updateStars(rating, targetStarIcons) {
            targetStarIcons.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('fa-regular');
                    star.classList.add('fa-solid', 'filled');
                } else {
                    star.classList.remove('fa-solid', 'filled');
                    star.classList.add('fa-regular');
                }
            });
        }

        // Handle hover effect for this card's stars
        starsContainer.addEventListener('mouseover', (e) => {
            if (e.target.tagName === 'I') {
                const hoverRating = parseInt(e.target.dataset.rating);
                updateStars(hoverRating, starIcons); // Apply hover effect to this card's stars
                starIcons.forEach((star, index) => {
                    if (index < hoverRating) {
                        star.classList.add('hovered');
                    } else {
                        star.classList.remove('hovered');
                    }
                });
            }
        });

        // Reset stars on mouseout for this card's stars
        starsContainer.addEventListener('mouseout', () => {
            starIcons.forEach(star => star.classList.remove('hovered'));
            if (selectedRating === 0) {
                updateStars(0, starIcons);
            } else {
                updateStars(selectedRating, starIcons);
            }
        });

        // Handle click to select rating for this card
        starsContainer.addEventListener('click', (e) => {
            if (e.target.tagName === 'I') {
                selectedRating = parseInt(e.target.dataset.rating);
                updateStars(selectedRating, starIcons); // Update appearance based on selected rating
                ratingMessage.textContent = `You rated: ${selectedRating} star${selectedRating > 1 ? 's' : ''}`;
                // Call submitRating with this card's specific elements
                submitRating(riderId, selectedRating, ratingMessage, avgRatingDisplay, displayStarsContainer);
            }
        });

        // Function to submit rating via AJAX
        function submitRating(riderId, rating, messageElem, avgDisplayElem, displayStarsCont) {
            const formData = new FormData();
            formData.append('rider_id', riderId);
            formData.append('rating', rating);

            fetch('submit_rating.php', { // Ensure correct path to your PHP script
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageElem.textContent = data.message;
                    // Refresh average rating for this specific card
                    fetchAverageRating(riderId, avgDisplayElem, displayStarsCont);
                } else {
                    messageElem.textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error submitting rating:', error);
                messageElem.textContent = 'An error occurred while submitting your rating.';
            });
        }

        // Function to fetch and display average rating for this card
        function fetchAverageRating(riderId, avgDisplayElem, displayStarsCont) {
            fetch(`get_average_rating.php?rider_id=${riderId}`) // Changed from product_id
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const avgRating = parseFloat(data.average_rating);
                        avgDisplayElem.textContent = avgRating.toFixed(1);
                        displayStars(avgRating, displayStarsCont);
                    } else {
                        avgDisplayElem.textContent = 'N/A';
                        displayStars(0, displayStarsCont); // Display no stars if no rating
                    }
                })
                .catch(error => {
                    console.error('Error fetching average rating:', error);
                    avgDisplayElem.textContent = 'Error';
                    displayStars(0, displayStarsCont);
                });
        }

        // Function to display stars based on average rating for this card's display area
        function displayStars(avgRating, displayStarsCont) {
            displayStarsCont.innerHTML = ''; // Clear previous stars
            const fullStars = Math.floor(avgRating);
            const hasHalfStar = avgRating - fullStars >= 0.5;

            for (let i = 0; i < fullStars; i++) {
                const star = document.createElement('i');
                star.classList.add('fa-solid', 'fa-star');
                displayStarsCont.appendChild(star);
            }

            if (hasHalfStar) {
                const halfStar = document.createElement('i');
                halfStar.classList.add('fa-solid', 'fa-star-half-stroke');
                displayStarsCont.appendChild(halfStar);
            }

            const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
            for (let i = 0; i < emptyStars; i++) {
                const star = document.createElement('i');
                star.classList.add('fa-regular', 'fa-star');
                displayStarsCont.appendChild(star);
            }
        }

        // --- Toggle rating section visibility for THIS card ---
        downArrow.addEventListener('click', (event) => {
            event.stopPropagation(); // Stop event propagation
            ratingSection.classList.toggle('hidden'); // Toggle visibility for this specific rating section
        });

        // Initial fetch of average rating when this card's script is initialized
        fetchAverageRating(riderId, avgRatingDisplay, displayStarsContainer);
    } // End of initializeCardRating function

    // --- Main part of the script that runs on DOMContentLoaded ---

    // 1. Get all the card elements on the page
    const allCards = document.querySelectorAll('.card');

    // 2. Iterate over each card and initialize its rating functionality
    allCards.forEach(card => {
        initializeCardRating(card);
    });

    // --- Your existing main dropdown menu logic (this part remains largely the same) ---
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent click from bubbling up and closing other things
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // --- Removed previous global listeners for 'dwn-arrow' and 'rating-section' ---
    // The toggling of rating sections is now handled specifically within each card's
    // `initializeCardRating` function. This avoids the problems of applying collection
    // methods to single elements and provides independent behavior for each card.
});