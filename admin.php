<?php
    include_once 'header.php';

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

    $listaInvitati = getLista($conn);

?>  
    <nobr><h3><img src="img/admin.png" alt="admin" width="50px" height="50px" style="position:relative; top:5px; left:5px">  Pannello di Amministrazione</h3></nobr>
    <section>
        <h4>Famiglie</h4>
        <table>
        <?php
            foreach ($listaInvitati as $famiglia) {
                $nomeFamiglia = $famiglia["nomeFamiglia"];
                $elementiFamiglia = json_decode($famiglia["elementiFamiglia"], TRUE);

                echo '<tr>
                    <td>'.$nomeFamiglia.'</td>
                    <td style="width: 1%; padding: 0">
                        <a class="remove_button button" href="includes/remove_family.inc.php?nomeFamiglia='.$nomeFamiglia.'">Rimuovi</a>
                    </td>
                </tr>';
            }
        ?>
        </table>
        <div id="add_family-form" class="form">
            <form action="includes/add_family.inc.php" method="post">
                <label for="nomeFamiglia">Inserisci nuova famiglia: </label>
                <input type="text" name="nomeFamiglia" id="nomeFamiglia" placeholder="Nome Famiglia...">
                <button type="submit" name="submit">Aggiungi</button>
            </form>
        </div>

        <h4>Persone</h4>
        <table>
            <th>Persona</th>
            <th>Famiglia</th>
            <th>Partecipazione</th>
            <th>Menu</th>
            <th></th>
            <?php
            foreach ($listaInvitati as $famiglia) {
                $nomeFamiglia = $famiglia["nomeFamiglia"];
                $elementiFamiglia = json_decode($famiglia["elementiFamiglia"], TRUE);
                foreach ($elementiFamiglia as $persona => $stats) {
                    echo '<tr>
                        <td>'.$persona.'</td>
                        <td>'.$nomeFamiglia.'</td>
                        <td>'.$stats["partecipa"].'</td>
                        <td>'.$stats["menu"].'</td>
                        <td style="width: 1%; padding: 0">
                            <a class="remove_button button" href="includes/remove_person.inc.php?nomeFamiglia='.$nomeFamiglia.'&nome='.$persona.'">Rimuovi</a>
                        </td>
                    </tr>';
                }
            }
        ?>
        </table>
        <div id="add_person-form" class="form">
            <form action="includes/add_person.inc.php" method="post">
                <h5>Aggiungi Persona</h5>
                <label for="famiglia">Famiglia di appartenenza: </label>
                <select name="famiglia" id="famiglia">
                    <?php
                        foreach ($listaInvitati as $famiglia) {
                            $nomeFamiglia = $famiglia["nomeFamiglia"];
                            echo '<option value="'.$nomeFamiglia.'">'.$nomeFamiglia.'</option>';
                        }
                    ?>
                </select>
                <label for="nome1">Nome: </label>
                <input type="text" name="nome1" id="nome1" placeholder="Nome...">
                <label for="nome2">Secondo nome: </label>
                <input type="text" name="nome2" id="nome2" placeholder="Secondo nome...">
                <label for="cognome">Cognome: </label>
                <input type="text" name="cognome" id="cognome" placeholder="Cognome...">
                <button type="submit" name="submit">Aggiungi</button>
            </form>
        </div>
    </section>
<?php
    include_once 'footer.php'
?>