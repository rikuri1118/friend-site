<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <!-- vim: set sts sw=4 expandtab : -->
        <title>finalkadai-2-2</title>
    </head>
    <body>
<?php
    $dbname="finaldatabase";
    $tablename="finaltable";
        $link = mysqli_connect('127.0.0.1','root','dbpass',$dbname);
    if(! $link){ exit("Connect error!"); }

    echo "<pre>";

  
    $result = mysqli_query($link,"select * from $tablename");
    if(!$result){ exit("Select error on table ($tablename)!"); } 

    $ary_of_fieldinfo = mysqli_fetch_fields($result);

     while($row = mysqli_fetch_row($result))
    {
         foreach($row as $key => $value)
        {
            echo '    '
                  . htmlspecialchars($ary_of_fieldinfo[$key]->name) . "  : ";
            echo htmlspecialchars($value) . "\n";
        }
    }
   

    mysqli_free_result($result);

    mysqli_close($link);

    echo "</pre>";
?>
        <form method="post" action="finalkadai-1.php">   
	<button type="submit" name="submit" value="">back</button>
        <?form>
    </body>
</html>
