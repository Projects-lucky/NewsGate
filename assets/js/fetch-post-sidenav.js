document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.side-navs-main-categories-lst');
    const subcategoriesContainer = document.querySelector('#subcategories-container');
    const postsListContainer = document.querySelector('#posts-list-container');
    const paginationContainer = document.querySelector('#pagination-container');

    let currentCategoryId = null; // Track the current category ID
    let currentPage = 1; // Track the current page for pagination
    let totalPages = 1; // Track the total number of pages

    menuItems.forEach(item => {
        item.addEventListener('mouseover', function () {
            currentCategoryId = this.getAttribute('data-category-id');
            currentPage = 1; // Reset to the first page when hovering over a new category
            fetchPosts(currentCategoryId, currentPage);
        });
    });

    // Function to fetch posts
    function fetchPosts(categoryId, page = 1) {
        let apiUrl = `${siteUrl}wp-json/wp/v2/posts?categories=${categoryId}&per_page=5&page=${page}&_embed`;
        getSize(apiUrl);
        console.log(`Fetching posts from: ${apiUrl}`); // Debugging

        // Show loading animation
        showLoadingAnimation();

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                // Get total pages from headers
                totalPages = parseInt(response.headers.get('X-WP-TotalPages')) || 1;
                return response.json();
            })
            .then(posts => {
                console.log('Fetched posts:', posts); // Debugging
                if (page === 1) {
                    displayPosts(posts); // Display posts for the first page
                } else {
                    appendPosts(posts); // Append posts for subsequent pages
                }

                // Update pagination buttons
                updatePaginationButtons();

                // Fetch subcategories if it's the first page
                if (page === 1) {
                    fetchSubcategories(categoryId);
                }
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
                postsListContainer.innerHTML = `<p>Error: ${error.message}</p>`;
            })
            .finally(() => {
                // Hide loading animation
                hideLoadingAnimation();
            });
    }

    // Function to display posts
    function displayPosts(posts) {
        postsListContainer.innerHTML = ''; // Clear previous posts

        if (posts.length === 0) {
            postsListContainer.innerHTML = '<p>No posts found.</p>';
            return;
        }

        posts.forEach(post => {
            const postElement = createPostElement(post);
            postsListContainer.appendChild(postElement);
        });
    }

    // Function to append additional posts
    function appendPosts(posts) {
        if (posts.length === 0) {
            hideLoadMoreButton(); // Hide the "Load More" button if no more posts are available
            return;
        }

        posts.forEach(post => {
            const postElement = createPostElement(post);
            postsListContainer.appendChild(postElement);
        });
    }

    // Function to create a post element
   function createPostElement(post) {
    const postElement = document.createElement('div');
    postElement.classList.add('post');

    // Fetch the featured image (if available)
    const image = post._embedded['wp:featuredmedia'] ? 
        `<img src="${post._embedded['wp:featuredmedia'][0].source_url}" alt="${post.title.rendered}">` : 
        '<img src="placeholder.jpg" alt="No Image">';

    // Fetch category names from embedded terms
    const categoryNames = post._embedded['wp:term']
        .flat() // Flatten the array of terms
        .filter(term => term.taxonomy === 'category') // Filter only category terms
        .map(term => term.name) // Extract category names
        .join(', '); // Join into a comma-separated string

    // Format the publish date
    const publishDate = formatDate(post.date);

    // Create the post HTML
    postElement.innerHTML = `
        ${image}
        <div class="post-info">
            <h3>${post.title.rendered}</h3>
            <div class="meta-info">
                <p>${categoryNames}</p>
                <p>${publishDate}</p>     
            </div>
        </div>
    `;

    return postElement;
}


// Function to format the date as "2 Jan 25"
function formatDate(dateString) {
    const date = new Date(dateString);

    // Options for formatting the date
    const options = { day: 'numeric', month: 'short', year: '2-digit' };
    return date.toLocaleDateString('en-US', options);
}
    // Function to fetch subcategories
    function fetchSubcategories(categoryId) {
        fetch(`${siteUrl}wp-json/wp/v2/categories?parent=${categoryId}`)
            .then(response => response.json())
            .then(subcategories => {
                if (subcategories.length > 0) {
                    displaySubcategories(subcategories);
                }
            })
            .catch(error => console.error('Error fetching subcategories:', error));
    }

    // Function to display subcategories
    function displaySubcategories(subcategories) {
        subcategoriesContainer.innerHTML = ''; // Clear previous subcategories

        const subcategoryList = document.createElement('ul');
        subcategoryList.classList.add('subcategories');

        subcategories.forEach(subcat => {
            const subcatItem = document.createElement('li');
            subcatItem.classList.add('subcategory-item');
            subcatItem.textContent = subcat.name;
            subcatItem.setAttribute('data-category-id', subcat.id);
            subcatItem.addEventListener('mouseover', function () {
                currentCategoryId = subcat.id; // Update the current category ID
                currentPage = 1; // Reset to the first page
                fetchPosts(subcat.id, currentPage); // Fetch posts for subcategory on hover
            });
            subcategoryList.appendChild(subcatItem);
        });

        subcategoriesContainer.appendChild(subcategoryList); // Add subcategories to the subcategories container
    }

    // Function to show loading animation
    function showLoadingAnimation() {
        const loadingDiv = document.createElement('div');
        loadingDiv.classList.add('loader-container');
        loadingDiv.innerHTML = `
            <div class="loader">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        `; // You can replace this with a spinner or GIF
        postsListContainer.appendChild(loadingDiv);
    }

    // Function to hide loading animation
    function hideLoadingAnimation() {
        const loadingDiv = document.querySelector('.loading-animation');
        if (loadingDiv) {
            loadingDiv.remove();
        }
    }

    // Function to update pagination buttons
    function updatePaginationButtons() {
        paginationContainer.innerHTML = ''; // Clear previous pagination buttons

        const prevButton = document.createElement('button');
        prevButton.textContent = '‹';
        prevButton.classList.add('pagination-button', 'prev-button');
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                postsListContainer.innerHTML = '';
                fetchPosts(currentCategoryId, currentPage);
            }
        });

        const nextButton = document.createElement('button');
        nextButton.textContent = '›';
        nextButton.classList.add('pagination-button', 'next-button');
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                postsListContainer.innerHTML = '';
                fetchPosts(currentCategoryId, currentPage);
            }
        });

        paginationContainer.appendChild(prevButton);
        paginationContainer.appendChild(nextButton);
    }

    let sizeMd = window.matchMedia("(max-width: 768px)")
    let sizeSm = window.matchMedia("(max-width: 576px)")

    let sizes = [sizeMd, sizeSm];

    function getSize(widthSize){
        sizes.forEach(mediaQuery => {
            mediaQuery.addEventListener("change", () =>{
            if (mediaQuery === sizeMd && mediaQuery.matches) {
                widthSize= `${siteUrl}wp-json/wp/v2/posts?categories=${categoryId}&per_page=4&page=${page}&_embed`;
            } else if (mediaQuery === sizeSm && mediaQuery.matches) {
                 widthSize= `${siteUrl}wp-json/wp/v2/posts?categories=${categoryId}&per_page=3&page=${page}&_embed`;
            }else {
                 widthSize= `${siteUrl}wp-json/wp/v2/posts?categories=${categoryId}&per_page=5&page=${page}&_embed`;
            }
            });
        });
    }

    getSize(apiUrl);


});