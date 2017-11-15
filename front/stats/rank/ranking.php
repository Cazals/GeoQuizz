<html>
<head>
    <?php include '../../importScript.html' ?>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 14/11/2017
 * Time: 22:33
 */
?>
    <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--4dp">
        <thead>
        <tr>
            <th class="mdl-data-table__cell--non-numeric">Player</th>
            <th>Places Owned</th>
            <th>Point Earned</th>
            <th>Riddle Answered</th>
        </tr>
        </thead>
        <tbody>
<?php
for ($i = 0; $i < 10; $i++){
    echo '<tr>
            <td class="mdl - data - table__cell--non - numeric">Robert Downey Junior</td>
            <td>158</td>
            <td>28805</td>
            <td>142</td>  
        </tr>';
}?>
    </tbody >
</table >
</html>