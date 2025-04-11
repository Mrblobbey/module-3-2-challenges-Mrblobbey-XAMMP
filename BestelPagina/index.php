<?php
    include '../includes/header.php';
    include '../includes/nav.php';
?>

    <div id="container">
        <div id="orderFrom">
            <h1>Your Details</h1>
            <h2>What should appear on the invoice? </h2>
            
            <div class="form-group">
                <label for="type">Order Type</label>
                  <label for="part">Private</label>
                  <input type="radio" id="part" name="typebestelling" value="part">
                  <label for="zak">Business</label>
                  <input type="radio" id="zak" name="typebestelling" value="zak">
            </div>

            <div class="form-group">
                <label for="type">Salutation:</label>
                  <label for="dhr">Mr.</label>
                  <input type="radio" id="dhr" name="aanhef" value="dhr">
                  <label for="part">Mrs.</label>
                  <input type="radio" id="Mevr" name="aanhef" value="Mevr.">
            </div>

            <div class="form-group">
                <label for="naam">Name:</label>
                <input type="text" name="naam" placeholder="Firts name">
                <input type="text" name="tussenv" placeholder="between.">
                <input type="text" name="achternaam" placeholder="Last name">
            </div>
            
            <div class="form-group">
                <label for="postcode">Zip Code:</label>
                <input type="text" name="postcode" placeholder="1234AB">
            </div>
            
            <div class="form-group">
                <label for="Huisnummer">House Number:</label>
                <input type="text" name="Huisnummer" placeholder="Nr.">
                <input type="text" name="toev" placeholder="Betw.">
            </div>
            <div class="form-group">
                <form action="/action_page.php">
                <label for="land">Country:</label>
                    <select id="landen" name="landen">
                      <option value="NL">Netherlands</option>
                      <option value="BE">Belgium</option>
                      <option value="DE">Germany</option>
                      <option value="FR">France</option>
                      <option value="UK">United Kingdom</option>
                      <option value="ES">Spain</option>
                    </select>                  
                </form>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" placeholder="Email...">
            </div>
            
            <div class="form-group">
                <label for="telefoon">Phone Number:</label>
                <input type="tel" name="telefoon" placeholder="06-12345678">
            </div>

            <div class="form-group">
                <label for="geboorte">Date of Birth:</label>
                <input type="date" name="Geboortedatum" placeholder="">
            </div>

        </div>
        <div id="shoppingCart">
            <h2>Your cart total</h2>
            <p>€ 52.72</p>
            <a href="../bedanktPagina/index.php" class="checkout-button">Proceed to checkout</a>
        </div>

    </div>

    <?php
    include '../includes/footer.php';
    ?>

</body>
</html>