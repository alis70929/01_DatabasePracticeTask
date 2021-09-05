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
            <select class="adv" name="genre">

            <option value="" selected>Genre...</option>
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
            </select>
            <!-- Developer Name -->
            <input class="add-field <?php echo $dev_field; ?> " type="text" name="dev_name" size="40"value="<?php echo $dev_name ?>" placeholder="Developer Name..." />

            <!-- Age -->
            <input class="add-field" type="text" name="age" size="40"value="<?php echo $age ?>" placeholder="Age(0 for all ages)..." />

            <!-- Rating -->
            <div>
                <input class="add-field" type="text" name="rating" value="<?php echo $rating; ?>" step="0.1" min=0 max=5 placeholder="Rating(0-5)">

            </div>

            <!-- # Ratings -->
            <input class="add-field" type="text" name="count" value="<?php echo $rate_count; ?>" placeholder="# of Ratings">

            <!-- cost -->
            <input class="add-field" type="text" name="price" value="<?php echo $cost; ?>" placeholder="Cost (Number Only)">
            <br /><br />
            <!-- In App purchases -->
            <div>
                <b>In App Purchases</b>
                <input type="radio" name="in_app" value="1" checked="checked">Yes
                <input type="radio" name="in_app" value="1" >No
            </div>
            
            <br />
            <input class="submit advanced-button" type="submit" value="Submit" />
            </form>
            

            </div>
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>