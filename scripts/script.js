document.addEventListener("DOMContentLoaded", function () {
    const cartContainer = document.querySelector(".cart-dropdown");

    // Event delegation voor verwijder-knop
    cartContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-btn")) {
            e.preventDefault();

            const productId = e.target.getAttribute("data-product-id");

            const formData = new FormData();
            formData.append("remove_product_id", productId);

            fetch("/includes/add_to_cart.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(html => {
                cartContainer.innerHTML = html; // vervang inhoud van dropdown
            })
            .catch(err => {
                console.error("Fout bij verwijderen uit winkelmand:", err);
            });
        }
    });

    // Toevoegen aan winkelmand 
    const addToCartForm = document.getElementById("add-to-cart-form");
    if (addToCartForm) {
        addToCartForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(addToCartForm);

            fetch("/includes/add_to_cart.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(html => {
                cartContainer.innerHTML = html;
                cartContainer.style.display = "block"; // toon dropdown
            })
            .catch(err => {
                console.error("Fout bij toevoegen aan winkelmand:", err);
            });
        });
    }
});
function openPopup(title, content) {
    document.getElementById('popupTitle').textContent = title;
    document.getElementById('popupContent').textContent = content;
    // eventueel: document.getElementById('popupContent').textContent = content;
    document.getElementById('blogPopup').style.display = 'block';
    
}

function closePopup() {
    document.getElementById('blogPopup').style.display = 'none';
}