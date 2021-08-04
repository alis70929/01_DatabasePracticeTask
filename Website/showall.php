<?php include("topbit.php");

    $find_sql = "SELECT * FROM `game_details`
    JOIN Genre ON (game_details.GenreID = Genre.GenreID)
    JOIN Developer ON (game_details.DeveloperID = Developer.DeveloperID)
    
    ";
    $find_query = mysqli_query($dbconnect,$find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);
?>
                       
            
        <div class="box main">
            <h2>All results</h2>
            
            
            <?php
                
                if($count < 1)
                {
                    ?>
                        <div class="error">
                            Sorry! There are no results that match your search.
                            Please use the search box in the side bar to try again.
                        </div> <!-- End Error -->
                    <?php
                }
                else{
                    do{
                        ?>
                            <div class="results">

                                <!-- Heading and subtitle -->
                                <div class="flex-container">

                                    <div>
                                        <span class="sub_heading">
                                            <a href= "<?php echo $find_rs['URL']; ?>">
                                                <?php echo $find_rs['Name']; ?>
                                            </a>
                                        </span> 
                                    </div> <!-- Close Title -->

                                    <?php
                                        if( $find_rs['Subtitle'] != "")
                                        {
                                            ?>
                                            <div>
                                            
                                            &nbsp; &nbsp; | &nbsp; &nbsp;

                                            <?php echo $find_rs['Name']; ?>

                                            </div>
                                            <?php
                                        }
                                    ?>

                                </div> <!-- close Flex Container -->
                            <p>
                                <b>Price</b>
                                
                                <?php 
                                    if($find_rs['Price'] == 0)
                                    {
                                        ?>
                                        Free 
                                            <?php
                                                if( $find_rs['Purchases'] == 1)
                                                {
                                                    ?>
                                                    (In App Purchases)
                                                    <?php
                                                }
                                                
                                            ?>
                                        <?php
                                    } 
                                    else
                                    {
                                        ?>
                                        $<?php echo $find_rs['Price']; ?>
                                        <?php
                                    } 
                                
                                ?>

                                <br />
                                <b>Genre</b>
                                <?php echo $find_rs['GenreName']; ?>

                                <br />

                                <b>Developer</b>
                                <?php echo $find_rs['DeveloperName']; ?>

                                <br />

                                <b>Rating</b>
                                <?php echo $find_rs['Average User Rating']; ?> (based on <?php echo $find_rs['User Rating Count']; ?> votes)
                            </p>
                            <hr />
                            <?php echo $find_rs['Description']; ?>
                            </div>
                            <br />
                        <?php
                    }// end results 'do'
                    while($find_rs=mysqli_fetch_assoc($find_query));
                }// end else
            ?>
            

            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>