<?php
$rota = array("Maurice" => null,
              "Toti" => null,
              "Eliza" => null,
              "Ochieng" => null,
              );
$rota += ["Clement" => null];
$numbers = range(1, count($rota));
shuffle($numbers);
foreach ($numbers as $number) {
    foreach ($rota as $key => $value)
    {
        if(empty($rota[$key]))
        {
            $rota[$key] = $number;  
            break;
        }
    }
}
$duties = array(
    ['Display', 'Chiller'], 
    ['Toilet', 'Aprons'], 
    ['Dishes', 'Surfaces'],
    ['Sweeping', 'Moping', 'Lights', 'Tiles za mbele', 'Door'],
    ['Bonesaw', 'Mincer', 'Weighing scale', 'Counter']
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<table border="1">
            <tr>
                <th>Staff</th>
                <th>Roles</th>
            </tr>
            <?php
            foreach($rota as $key => $value) {
            ?> 
            <tr>
                <td rowspan="<?php echo count($duties[$value - 1]); ?>"><?php echo $key; ?></td>
                <td><?php echo $duties[$value - 1][0]; ?></td>
            </tr>
            <?php
            $i = 1;
            while ($i < count($duties[$value - 1]))
            {
            ?>
            <tr>
                <td><?php echo $duties[$value - 1][$i]; ?></td>
            </tr>
            <?php
            $i++;
            }
            ?>
            <?php
            }
            ?>
        </table>
</body>