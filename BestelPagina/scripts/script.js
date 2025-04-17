document.addEventListener("DOMContentLoaded", function () {
    const cartContainer = document.querySelector(".cart-dropdown");

    // Event delegation voor verwijder-knop
    cartContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-btn")) {
            e.preventDefault();

            const productId = e.target.getAttribute("data-product-id");

            const formData = new FormData();
            formData.append("remove_product_id", productId);

            fetch("/rodygamestore/includes/add_to_cart.php", {
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

    // Toevoegen aan winkelmand via AJAX (optioneel als je dit nog niet had)
    const addToCartForm = document.getElementById("add-to-cart-form");
    if (addToCartForm) {
        addToCartForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(addToCartForm);

            fetch("/rodygamestore/includes/add_to_cart.php", {
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
