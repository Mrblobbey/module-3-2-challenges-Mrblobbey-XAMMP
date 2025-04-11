<?php
    include '../includes/productArray.php';
    include '../includes/header.php';
    include '../includes/nav.php';
?>

<body>
    <div class="container">
        <button type="submit" class="btn" onclick="openPopup()">Submit</button>
        <div class="popup" id="popup">
            <img src="../assets/img/vinkje.png">
            <h2>Thank you!</h2>
            <p>Your details has been succesfully sbmutted. Thanks!</p>
            <button type="button" onclick="closePopup()">OK</button>
        </div>
    </div>
 
    <script src="script.js" defer></script>
<script>
    let popup = document.getElementById("popup");
 
    function openPopup() {
        popup.classList.add("open-popup");
    }
    function closePopup() {
        popup.classList.remove("open-popup");
    }
</script>
 
</body>
<?php
    include '../includes/footer.php';
?>