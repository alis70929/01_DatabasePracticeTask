<?php include("topbit.php");

    $name_dev = $_POST['dev_name'];

    $find_sql = "SELECT * FROM `game_details`
    JOIN Genre ON (game_details.GenreID = Genre.GenreID)
    JOIN Developer ON (game_details.DeveloperID = Developer.DeveloperID)
    WHERE `Name` LIKE '%$name_dev%' or `DeveloperName` LIKE '%$name_dev%'
    ";
    $find_query = mysqli_query($dbconnect,$find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);
?>
                       
            
        <div class="box main">
            <h2>Name / Developer Results</h2>
            
            
            <?php include("results.php") ?>
            

            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>