<?php
include_once 'header.php';

if (isset($_SESSION["nome"]) === FALSE) {
    header("location: ../login");
}
    
?>
<nobr><h3><img src="img/conferma.png" alt="conferma" width="50px" height="50px" style="position:relative; top:5px; left:5px">  Conferma Partecipazione</h3></nobr>
    <section>
        <h4>Segui i passaggi per confermare la tua partecipazione alla cresima.</h4>
        <?php 
            echo '<h5>Gruppo familiare: '.$_SESSION["nome_famiglia"].'</h5>';
            foreach ($_SESSION["lista_famiglia"] as $persona => $stats) {
            echo '
                <h6>'.$persona.'</h6>
                <div id="partecipazione-form" class="form">
                    <form action="includes/update.inc.php" method="post">
                        <label for="partecipa">Partecipa:</label>
                        <select name="partecipa" id="partecipa" required>';
                        if ($stats["partecipa"] == "Si") {
                            echo'<option value="NULL">Seleziona</option>
                                <option value="Si" selected>Si</option>
                                <option value="No">No</option>';
                        } elseif ($stats["partecipa"] == "No") {
                            echo'<option value="NULL">Seleziona</option>
                                <option value="Si">Si</option>
                                <option value="No" selected>No</option>';
                        } else {
                            echo'<option value="NULL" selected>Seleziona</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>';                    
                        }
                        echo '</select>

                        <label for="menu">Menu:</label>
                        <select name="menu" id="menu" required>';
                        if ($stats["partecipa"] == "Si") { 
                            if ($stats["menu"] == "Normale") {
                                echo'<option value="NULL">Seleziona</option>
                                    <option value="Normale" selected>Normale</option>
                                    <option value="Bambino">Bambino</option>
                                    <option value="No">No</option>';
                            } elseif ($stats["menu"] == "Bambino") {
                                echo'<option value="NULL">Seleziona</option>
                                    <option value="Normale">Normale</option>
                                    <option value="Bambino" selected>Bambino</option>
                                    <option value="No">No</option>';
                            } elseif ($stats["menu"] == "No") {
                                echo'<option value="NULL">Seleziona</option>
                                    <option value="Normale">Normale</option>
                                    <option value="Bambino">Bambino</option>
                                    <option value="No" selected>No</option>';                    
                            } else {
                                echo'<option value="NULL" selected>Seleziona</option>
                                    <option value="Normale">Normale</option>
                                    <option value="Bambino">Bambino</option>
                                    <option value="No">No</option>';                    
                            }
                        } else {
                            echo '<option value="NULL" selected>Non partecipa</option>';
                        }
                        echo '</select>';
                        
                        echo '<input type="hidden" name="persona" value="'.$persona.'"/>
                        <input type="hidden" name="famiglia" value="'.$_SESSION["nome_famiglia"].'"/>
                        <button type="submit" name="submit">Salva</button>
                    </form>
                </div>';
            }
        ?>
    </section>
<?php
    include_once 'footer.php'
?>