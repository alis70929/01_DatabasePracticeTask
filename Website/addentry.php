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

        $genre = $genreitem_rs['Genre'];
    }
    $dev_name = mysqli_real_escape_string($dbconnect,$_POST['dev_name']);
    $age = mysqli_real_escape_string($dbconnect,$_POST['age']);
    $rating = mysqli_real_escape_string($dbconnect,$_POST['rating']);
    $rate_count = mysqli_real_escape_string($dbconnect,$_POST['count']);
    $cost = mysqli_real_escape_string($dbconnect,$_POST['price']);
    $in_app = mysqli_real_escape_string($dbconnect,$_POST['in_app']);
    $description = mysqli_real_escape_string($dbconnect,$_POST['description']);


    if($has_errors == "no")
    {
        header('Location: add_success.php');
        $dev_sql="SELECT * FROM `Developer` WHERE `DeveloperName` LIKE '$dev_name'";
        $dev_query=mysqli_query($dbconnect,$dev_sql);
        $dev_rs=mysqli_fetch_assoc($dev_query);
        $dev_count=mysqli_fetch_num_rows($dev_query);

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
?>
                       
            
        <div class="box main">
            <div class="add-entry">
            <h2>Add An Entry</h2>
            
            <form method="post" encttype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <!--- App Name Required -->
            <input class="add-field" type="text" name="app_name" size="40"value="<?php echo $app_name ?>" placeholder="App Name/Title(Required)..." />

            <!-- subtitle optional -->
            <input class="add-field" type="text" name="subtitle" size="40"value="<?php echo $subtitle ?>" placeholder="Subtile..." />

            <!-- URL -->
            <input class="add-field <?php echo $url_field; ?>" type="text" name="url" size="40"value="<?php echo $url ?>" placeholder="URL(Required>" />

            <!-- Genre dropdown -->
            <select class="add-field" name="genre">

            <?php 
            if($genreID == "")
            {
                ?><option value="" selected>Genre...</option><?php
            }
            else
            {
                ?><option value="<?php echo $genreID;?>" selected><?php echo $genre; ?></option>?php
            }
            
            ?>
            
                <?php      
                    do {
                    ?>
                        <option value="<?php echo $genre_rs['GenreID']; ?>">
                        <?php echo $genre_rs['GenreName']; ?></option>
                    <?php
                    }

                    while($genre_rs=mysqli_fetch_assoc($genre_query))
                ?>
            </select>
            
            <!-- Developer Name -->
            <input class="add-field <?php echo $dev_field; ?> " type="text" name="dev_name" size="40"value="<?php echo $dev_name ?>" placeholder="Developer Name..." />

            <!-- Age -->
            <input class="add-field" type="text" name="age" size="40"value="<?php echo $age ?>" placeholder="Age(0 for all ages)..." />

            <!-- Rating -->
            <div>
                <input class="add-field" type="text" name="rating" value="<?php echo $rating; ?>" size="40" step="0.1" min=0 max=5 placeholder="Rating(0-5)">

            </div>

            <!-- # Ratings -->
            <input class="add-field" type="text" name="count" value="<?php echo $rate_count; ?>" size="40" placeholder="# of Ratings">

            <!-- cost -->
            <input class="add-field" type="text" name="price" value="<?php echo $cost; ?>" size="40" placeholder="Cost (Number Only)">
            <br /><br />
            <!-- In App purchases -->
            <div>
                <b>In App Purchases</b>
                <?php 
                
                if($in_app == 1)
                {
                    ?>
                    <input type="radio" name="in_app" value="1" checked="checked">Yes
                    <input type="radio" name="in_app" value="0" >No
                    <?php
                }
                else
                {
                    ?>
                    <input type="radio" name="in_app" value="1" >Yes
                    <input type="radio" name="in_app" value="0" checked="checked" >No
                    <?php
                }
                
                
                
                ?>
                <input type="radio" name="in_app" value="1" checked="checked">Yes
                <input type="radio" name="in_app" value="0" >No
            </div>
            
            <br />
            <textarea class="add-field <?php echo $description_field?>" name="description" placeholder="Description..." rows="6"><?php echo $description; ?></textarea>
            
            <br />
            <input class="submit advanced-button" type="submit" value="Submit" />
            </form>
            

            </div>
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>