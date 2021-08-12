<?php include("topbit.php");

    $find_sql = "SELECT * FROM `game_details`
    JOIN Genre ON (game_details.GenreID = Genre.GenreID)
    JOIN Developer ON (game_details.DeveloperID = Developer.DeveloperID)
    WHERE `Price` = 0 AND `Purchases` = 0
    ";
    $find_query = mysqli_query($dbconnect,$find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);
?>
                       
            
        <div class="box main">
            <h2>Free with No In App Purchases</h2>
            
            
            <?php include("results.php") ?>
            

            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>