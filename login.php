<?php
    include_once 'header.php'
?>
    <nobr><h3><img src="img/login.png" alt="login" width="50px" height="50px" style="position:relative; top:5px; left:5px">  Accedi</h3></nobr>
    <section>
        <div id="login-form" class="form">
            <form action="includes/login.inc.php" method="post">
                <label for="nome1">*Nome:</label>
                <input type="text" name="nome1" id="nome1" placeholder="Nome...">
                <label for="nome2">Secondo nome:</label>
                <input type="text" name="nome2" id="nome2" placeholder="Secondo nome...">
                <label for="cognome">*Cognome:</label>
                <input type="text" name="cognome" id="cognome" placeholder="Cognome...">
                <p>I campi contrassegnati con (*) sono obbligatori!</p>
                <button type="submit" name="submit">Accedi</button>
            </form>
        </div>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo '<p class="error">Non hai riempito tutti i settori!</p>';
            } else if ($_GET["error"] == "databasefail") {
                echo '<p class="error">C\'è stato un errore con il database! Riprova più tardi.</p>';
            } else if ($_GET["error"] == "notonlist") {
                echo '<p class="error">Non sei nella lista degli invitati o hai inserito male i dati!</p>';
            } else if ($_GET["error"] == "none") {
                echo '<p class="success">Login Completato!</p>';
            }
        }
        ?>
        </section>
<?php
    include_once 'footer.php'
?>