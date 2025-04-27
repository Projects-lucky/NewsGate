// document.addEventListener("DOMContentLoaded", function () {
//     const categoryItems = document.querySelectorAll(".category-item");
//     const postContainer = document.createElement("div");
//     postContainer.className = "absolute top-full left-0 w-64 bg-white shadow-md hidden";
//     document.body.appendChild(postContainer);

//     categoryItems.forEach(item => {
//         item.addEventListener("mouseover", function () {
//             let categoryId = this.getAttribute("data-category");
//             fetchRecentPosts(categoryId, this);
//             showSubcategories(this);
//         });

//         item.addEventListener("mouseleave", function () {
//             setTimeout(() => postContainer.classList.add("hidden"), 500);
//         });
//     });

//     function fetchRecentPosts(categoryId, element) {
//         fetch(ajaxurl, {
//             method: "POST",
//             headers: { "Content-Type": "application/x-www-form-urlencoded" },
//             body: `action=load_recent_posts&category_id=${categoryId}`
//         })
//         .then(response => response.text())
//         .then(data => {
//             postContainer.innerHTML = data;
//             postContainer.style.left = element.getBoundingClientRect().left + "px";
//             postContainer.style.top = (element.getBoundingClientRect().bottom + window.scrollY) + "px";
//             postContainer.classList.remove("hidden");
//         });
//     }

//     function showSubcategories(categoryElement) {
//         let subMenu = categoryElement.querySelector(".subcategory-menu");
//         if (subMenu) {
//             subMenu.classList.remove("hidden");

//             const subcategoryItems = subMenu.querySelectorAll(".subcategory-item");
//             subcategoryItems.forEach(subItem => {
//                 subItem.addEventListener("mouseover", function () {
//                     let subcategoryId = this.getAttribute("data-subcategory");
//                     fetchRecentPosts(subcategoryId, this);
//                 });
//             });

//             subMenu.addEventListener("mouseleave", function () {
//                 setTimeout(() => subMenu.classList.add("hidden"), 500);
//             });
//         }
//     }
// });
