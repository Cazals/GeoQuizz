<html lang="en">
<head>
    <?php include '../importScript.html' ?>
</head>
<body>

<div class="layoutHolder">
    <?php include_once "../shared/navbar.php" ?>
    <main class="mdl-layout__content">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col ">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Pseudo</th>
                        <th>Places Owned</th>
                        <th>Points earned</th>
                        <th>Riddle answered</th>
                        <th>Number of places sold</th>
                        <th>Time playing(hours)</th>
                        <th>Last time playing</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Ronny</td>
                        <td>12</td>
                        <td>2250</td>
                        <td>68</td>
                        <td>42</td>
                        <td>125</td>
                        <td><?php echo date("Y-m-d H:i:s");?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Freezer</td>
                        <td>10</td>
                        <td>1580</td>
                        <td>76</td>
                        <td>25</td>
                        <td>98</td>
                        <td><?php echo date("Y-m-d H:i:s");?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Ichigo</td>
                        <td>11</td>
                        <td>2020</td>
                        <td>25</td>
                        <td>8</td>
                        <td>68</td>
                        <td><?php echo date("Y-m-d H:i:s");?></td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">Superman</td>
                        <td>8</td>
                        <td>870</td>
                        <td>18</td>
                        <td>2</td>
                        <td>158</td>
                        <td><?php echo date("Y-m-d H:i:s");?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>
