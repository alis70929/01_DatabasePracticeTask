<?php include("topbit.php");

    $app_name = mysqli_real_escape_string($dbconnect,$_POST['app_name']);
    $developer = mysqli_real_escape_string($dbconnect,$_POST['dev_name']);
    $genre = $_POST['genre'];
    $cost = mysqli_real_escape_string($dbconnect,$_POST['cost']);

    if($cost=="")
    {
        $cost_op = ">=";
        $cost = 0;
    }
    else
    {
        $cost_op = "<=";
    }

    if(isset($_POST['in_app']))
    {
        $in_app = 0;
    }

    else
    {
        $in_app = 1;
    }

    $rating_more_less = mysqli_real_escape_string($dbconnect, $_POST['rate_more_or_less']);
    $rating = mysqli_real_escape_string($dbconnect,$_POST['rating']);

    if($rating == "")
    {
        $rating = 0;
        $rating_more_less = "at least";
    }

    if($rating_more_less == "at least"){
        $rate_op = ">=";
    }
    elseif($rating_more_less == "at most")
    {
        $rate_op = "<=";
    }
    else{
        $rate_op = ">=";
        $rating  = 0;
    }

    $age_more_less = mysqli_real_escape_string($dbconnect, $_POST['age_more_or_less']);
    $age = mysqli_real_escape_string($dbconnect,$_POST['age']);

    if($age == "")
    {
        $age = 0;
        $age_more_less = "at least";
    }

    if($age_more_less == "at least"){
        $age_op = ">=";
    }
    else if($age_more_less == "at most")
    {
        $age_op = "<=";
    }
    else{
        $age_op = ">=";
        $age  = 0;
    }

    $find_sql = "SELECT * FROM `game_details`
    JOIN Genre ON (game_details.GenreID = Genre.GenreID)
    JOIN Developer ON (game_details.DeveloperID = Developer.DeveloperID)
    WHERE `Name` LIKE '%$app_name%' 
    AND `DeveloperName` LIKE '%$developer%'
    AND `GenreName` LIKE '%$genre%'
    AND `Price` $cost_op '$cost'
    AND (`Purchases` = $in_app OR `Purchases` = 0)
    AND `Average User Rating` $rate_op $rating
    AND `Age Rating` $age_op $age
    ";

    $find_query = mysqli_query($dbconnect,$find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);
?>
                       
            
        <div class="box main">
            <h2>Advanced Results</h2>
            
            
            <?php include("results.php") ?>
            

            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>