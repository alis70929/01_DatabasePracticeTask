<?php include("topbit.php");

$genre_sql="SELECT * FROM `Genre` ORDER BY `Genre`.`GenreName` ASC";
$genre_query=mysqli_query($dbconnect,$genre_sql);
$genre_rs=mysqli_fetch_assoc($genre_query);
// Initialize Variables

$app_name = "";
$subtitle = "";
$url = "";
$genreID = "";
$dev_name = "";
$age = "";
$rating = "";
$rate_count = "";
$cost = "";
$in_app = 1;
$description = "Please enter a decription";

$has_errors = "no";

$app_error = $url_error = $genre_error = $dev_error = $description_error = $age_error = $rating_error = $count_error = $cost_error =  "no-error";

$app_field = $url_field = $genre_field = $dev_field = $description_field = $age_field = $rating_field = $count_field = $cost_field = "form-ok";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $app_name = mysqli_real_escape_string($dbconnect,$_POST['app_name']);
    $subtitle = mysqli_real_escape_string($dbconnect,$_POST['subtitle']);
    $url = mysqli_real_escape_string($dbconnect,$_POST['url']);
    $genreID = mysqli_real_escape_string($dbconnect,$_POST['genre']);

    if($genreID != "") {
        $genreitem_sql = "SELECT * FROM `Genre` WHERE `GenreID` = $genreID";
        $genreitem_query=mysqli_query($dbconnect,$genreitem_sql);
        $genreitem_rs=mysqli_fetch_assoc($genreitem_query);

        $genre = $genreitem_rs['GenreName'];
    }
    $dev_name = mysqli_real_escape_string($dbconnect,$_POST['dev_name']);
    $age = mysqli_real_escape_string($dbconnect,$_POST['age']);
    $rating = mysqli_real_escape_string($dbconnect,$_POST['rating']);
    $rate_count = mysqli_real_escape_string($dbconnect,$_POST['count']);
    $cost = mysqli_real_escape_string($dbconnect,$_POST['price']);
    $in_app = mysqli_real_escape_string($dbconnect,$_POST['in_app']);
    $description = mysqli_real_escape_string($dbconnect,$_POST['description']);


    if ($app_name == ""){
        $has_errors = "yes";
        $app_error = "error-text";
        $app_field = "form-error";
    }

    $url = filter_var($url, FILTER_SANITIZE_URL);

    if (filter_var($url,FILTER_VALIDATE_URL) == false){
        $has_errors = "yes";
        $url_error = "error-text";
        $url_field = "form-error";
    }

    if ($genreID == ""){
        $has_errors = "yes";
        $genre_error = "error-text";
        $genre_field = "form-error";
    }


    if ($dev_name == ""){
        $has_errors = "yes";
        $dev_error = "error-text";
        $dev_field = "form-error";
    }

    if($age == "" || $age == 0)
    {
        $age = 0;
        $age_message = "The age has been set to zero";
        $age_error = "defaulted";
    }
    else if(!ctype_digit($age) || $age < 0)
    {
        $age_message = "Please enter a number that is 0 or more";
        $has_errors = "yes";
        $age_error = "error-text";
        $age_field = "form-error";
    }

    if (!is_numeric($rating) || $rating > 0 || $rating < 5)
    {
        $has_errors = "yes";
        $rating_error = "error-text";
        $rating_field = "form-error";
    }

    if(!ctype_digit($rate_count) || $rate_count > 1)
    {
        $has_errors = "yes";
        $count_error = "error-text";
        $count_field = "form-error";
    }

    if($cost == "" || $cost == 0)
    {
        $cost = 0;
        $cost_message = "The price has been set to zero";
        $cost_error = "defaulted";
    }
    else if(!is_numeric($cost) || $cost < 0)
    {
        $cost_message = "Please enter a number that is 0 or more";
        $has_errors = "yes";
        $cost_error = "error-text";
        $cost_field = "form-error";
    }

    if ($description == "" || $description == "Please enter a decription"){
        $has_errors = "yes";
        $description_error = "error-text";
        $description_field = "form-error";
        $description = "";
    }


    if($has_errors == "no")
    {
        header('Location: add_success.php');
        
        $dev_sql="SELECT * FROM `Developer` WHERE `DeveloperName` LIKE '$dev_name'";
        $dev_query=mysqli_query($dbconnect,$dev_sql);
        $dev_rs=mysqli_fetch_assoc($dev_query);
        $dev_count=mysqli_num_rows($dev_query);

        if($dev_count > 0)
        {
            $DeveloperID = $dev_rs['DeveloperID'];
        }
        else
        {
            $add_dev_sql = "INSERT INTO `Developer` (`DeveloperID`, `DeveloperName`) VALUES (NULL, '$dev_name')";
            $add_dev_query = mysqli_query($dbconnect, $add_dev_sql);

            $new_dev_sql="SELECT * FROM `Developer` WHERE `DeveloperName` LIKE '$dev_name'";
            $new_dev_query=mysqli_query($dbconnect,$new_dev_sql);
            $new_dev_rs=mysqli_fetch_assoc($new_dev_query);
            
            $DeveloperID = $new_dev_rs['DeveloperID'];
        }
        $addentry_sql = "INSERT INTO `game_details` (`ID`, `Name`, `Subtitle`, `URL`, `GenreID`, `DeveloperID`, `Age Rating`, `Average User Rating`, `User Rating Count`, `Price`, `Purchases`, `Description`) VALUES (NULL, '$app_name', '$subtitle', '$url', $genreID, $DeveloperID, $age, $rating, $rate_count, $cost, $in_app, '$description')";
        $addentry_query=mysqli_query($dbconnect, $addentry_sql);
    }
}
?>
                       
            
        <div class="box main">
            <div class="add-entry">
            <h2>Add An Entry</h2>
            
            <form method="post" encttype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <!--- App Name Required -->

            <div class="<?php echo $app_error ?>">Please Fill in the 'App Name Field'</div>

            <input class="add-field <?php echo $app_field?>" type="text" name="app_name" size="40"value="<?php echo $app_name ?>" placeholder="App Name/Title(Required)..." />

            <!-- subtitle optional -->
            <input class="add-field" type="text" name="subtitle" size="40"value="<?php echo $subtitle ?>" placeholder="Subtile..." />

            <!-- URL -->
            <div class="<?php echo $url_error ?>">Please provide a valid URL (Include the http://</div>
            <input class="add-field <?php echo $url_field; ?>" type="text" name="url" size="40"value="<?php echo $url ?>" placeholder="URL(Required>" />


            
            <!-- Genre dropdown -->
            <div class="<?php echo $genre_error ?>">Please choose a genre</div>
            <select class="add-field <?php echo $genre_field ?>" name="genre">

            <?php 
            if($genreID == "")
            {
                ?><option value="" selected>Genre...</option><?php
            }
            else
            {
                ?><option value="<?php echo $genreID;?>" selected><?php echo $genre; ?></option><?php
            }
                  
            do {
            ?>
                <option value="<?php echo $genre_rs['GenreID']; ?>">
                <?php echo $genre_rs['GenreName']; ?></option>
            <?php
            }

            while($genre_rs=mysqli_fetch_assoc($genre_query));
            ?>

            </select>
            
            <!-- Developer Name -->
            <div class="<?php echo $dev_error ?>">Developer name can not be blank</div>
            <input class="add-field <?php echo $dev_field; ?> " type="text" name="dev_name" size="40"value="<?php echo $dev_name ?>" placeholder="Developer Name..." />


            
            <!-- Age -->
            <div class="<?php echo $age_error ?>"><?php echo $cost_message ?></div>
            <input class="add-field <?php echo $age_field ?>" type="text" name="age" size="40"value="<?php echo $age ?>" placeholder="Age(0 for all ages)..." />

            <!-- Rating -->
            <div class="<?php echo $rating_error ?>">rating can not be blank</div>
            <div>
                <input class="add-field <?php echo $rating_field ?>" type="text" name="rating" value="<?php echo $rating; ?>" size="40" step="0.1" min=0 max=5 placeholder="Rating(0-5)" />

            </div>

            <!-- # Ratings -->
            <div class="<?php echo $count_error ?>">Number of ratings can not be blank</div>
            <input class="add-field <?php echo $count_field ?>" type="text" name="count" value="<?php echo $rate_count; ?>" size="40" placeholder="# of Ratings"/>

            <!-- cost -->
            <div class="<?php echo $cost_error ?>"><?php echo $cost_message ?></div>
            <input class="add-field <?php echo $cost_field ?>" type="text" name="price" value="<?php echo $cost; ?>" size="40" placeholder="Cost (Number Only)"/>
            <br /><br />
            <!-- In App purchases -->
            <div>
                <b>In App Purchases</b>
                <?php 
                
                if($in_app == 1)
                {
                    ?>
                    <input type="radio" name="in_app" value="1" checked="checked"/>Yes
                    <input type="radio" name="in_app" value="0" />No
                    <?php
                }
                else
                {
                    ?>
                    <input type="radio" name="in_app" value="1" />Yes
                    <input type="radio" name="in_app" value="0" checked="checked" />No
                    <?php
                }
                
                
                
                ?>
            </div>
            
            <br />
            <div class="<?php echo $description_error ?>">Description can not be blank</div>
            <textarea class="add-field <?php echo $description_field?>" name="description" placeholder="Description..." rows="6"><?php echo $description; ?></textarea>
            
            <br />
            <input class="submit advanced-button" type="submit" value="Submit" />
            </form>
            
            </div>
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>