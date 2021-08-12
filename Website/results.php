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

                    <!--- ratings -->
                    <div class="flex-container">
                        
                        <div class="star-ratings-sprite">
                        <span style="width:
                        <?php echo $find_rs['Average User Rating'] / 5 * 100 ?>%" class="star-ratings-sprite-rating">
                        
                        </span>
                        </div>

                        <div class="actual-rating">

                            (<?php echo $find_rs['Average User Rating']; ?> rating based on <?php echo number_format($find_rs['User Rating Count']); ?> user ratings)
                        </div>
                    </div>
                    <!-- Rating end -->

                <p>
                
                    
                    
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
                            <b>Price</b> $<?php echo $find_rs['Price']; ?>
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
                    
                    <b>Age Rating</b>
                    <?php echo $find_rs['Age Rating']; ?>+

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