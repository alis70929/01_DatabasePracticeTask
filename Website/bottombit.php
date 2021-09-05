<div class="box side">
           
           <h2>Add an App | <a class="side" href="showall.php">Show All</a></h2>
           
           <form class="searchform" method="post" action ="name_dev.php" enctype="multipart/form_data">

                <input class="search" type="text" name="dev_name" size="40"value="" required placeholder="App Name/ Developer Name..." />

                <input class="submit" type="submit" name="find_dev_name" value="&#xf002;" />

           </form>

           <form class="searchform" method="post" action ="free.php" enctype="multipart/form_data">
           
                <input class="submit free" type="submit" name="find_dev_name" value="Free with No In App Purchases &#xf002;" />

           </form>

           <br />
           <hr />
           <br />

            <div class="advanced-frame">
            
            <h2>Advanced Search</h2>
            <form class="searchform" method="post" action="advanced.php" enctype="multipart/form-data">
                
                
                <input class="adv" type="text" name="app_name" size="40"value=""  placeholder="App Name/Title..." />

                <input class="adv" type="text" name="dev_name" size="40"value=""  placeholder="Developer..." />
                
                <!-- Genre Seacrh -->
                <select class="search adv" name="genre">

                <option value="" selected>Genre...</option>
                    <?php 
                     $genre_sql="SELECT * FROM `Genre` ORDER BY `Genre`.`GenreName` ASC";
                     $genre_query=mysqli_query($dbconnect,$genre_sql);
                     $genre_rs=mysqli_fetch_assoc($genre_query);
                    
                     do {
                        ?>
                            <option value="<?php echo $genre_rs['GenreName']; ?>">
                            <?php echo $genre_rs['GenreName']; ?></option>
                        <?php
                     }

                     while($genre_rs=mysqli_fetch_assoc($genre_query))
                    ?>
                </select>

                <!-- Cost -->
                <div class="flex-container">
                
                     <div class="adv-text">
                        Cost&nbsp;(less&nbsp;than):
                     </div>

                     <div>
                        <input class="adv" type="text" name="cost" size="40"value=""  placeholder="$..." />
                     </div>
                
                </div>

                <!-- In App -->
                <input class="adv-text" type="checkbox" name="in_app" value="0"/> No In App Purchases
                
                <div class="flex-container">
                     <div class="adv-text">
                     Rating:
                     </div>
                        
                     <div>
                        <select class="search adv" name="rate_more_or_less">
                            <option value="" disabled selected>Choose...</option>
                            <option value="at least" >At Least</option>
                            <option value="at most">At Most</option>
                        </select>
                    </div>

                     <div>
                        <input class="adv" type="text" name="rating" size="2"value=""  placeholder="" />
                     </div>
                </div>

                <div class="flex-container">
                     <div class="adv-text">
                     Age:
                     </div>
                        
                     <div>
                        <select class="search adv" name="age_more_or_less">
                            <option value="" selected>Choose...</option>
                            <option value="at least" >At Least</option>
                            <option value="at most" >At Most</option>
                        </select>
                    </div>

                     <div>
                        <input class="adv" type="text" name="age" size="2"value=""  placeholder="" />
                     </div>
                </div>

                <input class="submit advanced-button" type="submit" name="advanced" value="Search &nbsp; &#xf002;" />



            </form> <!-- End of Advanced Search -->
            
            
            
            </div> <!-- Advanced Frame End --->
            
        </div> <!-- / side bar -->
        
        <div class="box footer">
            CC Shazeel Ali 2021
        </div> <!-- / footer -->
                
        
    </div> <!-- / wrapper -->
    
            
</body>