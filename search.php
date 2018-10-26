<?php
    //ini_set('display_errors', 1); ini_set('log_errors',1); error_reporting(E_ALL);
    $con=mysqli_connect("localhost","root","root","finalsearch");
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/result.css">
        <link rel="stylesheet" type="text/css" href="style/bootstrap/bootstrap-4.1.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style/result.css">
        <title>SimpleSearch - PHP & MYSQL SEARCH ENGINE</title>
        <script src="js/google.js"></script>
    </head>
    <body>
      <header>
             <form id="result-search" method = "get" >
                <ul>
                <a href="index.php"><img id="brand" src="LOGO/logo_dark.png"></a>
                <li><input type="text" name="searchTerm" size="100" 
                           value="<?php echo $_GET['searchTerm'];?>" class="form-control"></li>
                <li><input type="submit" value="search"></li>
               </ul>
            </form>
        </header>    
            <nav>
            <ul id="result-nav">
                <li><a href="result.html" class="visited" >Web</a></li>
                <li><a href="#">Images</a></li>
                <li><a href="#">Videos</a></li>
                <li><a href="#"></a></li>
            </ul>
          </div>
        </nav>
        <?php
            $keyword = $_GET['searchTerm'];
            $createdate= (string)date('Y-m-d H:i:s');
            mysqli_query($con,"insert into keywordsearched values('$keyword','$createdate')");
            
//            $terms   =  explode(" ", $keyword);
            $query= "select * from db where MATCH(title,description)    AGAINST('$keyword')";
//            $i = 0;
//        
//            foreach($terms as $each){
//                $i++;
//                if($i == 1){
//                    $query.=" keywords LIKE '%$each%' ";
//                }
//                else
//                {
//                    $query.=" OR keywords LIKE '%$each%' ";
//                }
//            }
        
            
            //database connection
            mysqli_connect('localhost' , 'root' , 'root');        
            $query = mysqli_query($con ,$query);
            $results = mysqli_num_rows($query);
        ?>
         <span class="no.ofres container"><?php echo "About $results result(s) found"; 
                if($results ==0){ echo " , fetching results from Google..";}
             ?></span>
       

        <?php
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query))
                {
//                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $displayLink = $row['displayLink'];
                    $link = $row['link'];
        ?>            

                    
               <div class="output">
                                  
                    <a class="link" href="<?php echo $link ;?>"><h1><?php echo $title; ?></h1></a>
                    <p><?php echo $description; ?></p>
                    <small><a href="<?php echo $link ; ?>"><?php echo $displayLink ;?></a></small>        
                </div>
            
              <?php      
                }             
            }
            if(mysqli_num_rows($query) < 0 ||mysqli_num_rows($query) < 10){
                        $apiKey = "AIzaSyDdH2szPG1N41W0HL5hTWA4YwC4DffnH1w";
                        $items = array();
                        $i = 0;



                          $ch = curl_init();

                              $request = "https://www.googleapis.com/customsearch/v1?" .
                                "q=" . urlencode( "$keyword" ) . 
                                "&cx=006640053195355193739:mcbapyj749u" .
                                "&key=" . $apiKey;


                          curl_setopt($ch, CURLOPT_URL, $request);
                          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                          $output = curl_exec($ch);

                        //   var_dump(json_decode($output));
                        //   $file = fopen(__DIR__ .'/resultsNew.json','w');
                        //          fwrite($file, $output);
                        //          fclose($file);

                            $b=json_decode($output);
                            $res=$b->{'searchInformation'}->{'totalResults'};
                            $i=0;
                            while($b->{'items'}[$i])
                            {

                        //        print_r($b->{'items'}[$i]->{'title'});
                                $title = $b->{'items'}[$i]->{'htmlTitle'} ;
                                $link = $b->{'items'}[$i]->{'link'} ;
                                $displayLink = $b->{'items'}[$i]->{'displayLink'} ;
                                $description = $b->{'items'}[$i]->{'htmlSnippet'};


                        //        echo "<br />";
                                $i++;
                                ?>

                                <div class="output">
                                        <a class="link" href="<?php echo $link ;?>"><h1><?php echo $title; ?></h1></a>
                                       <p><?php echo $description; ?></p>
                                       <small><a href="<?php echo $link ; ?>"><?php echo $displayLink ;?></a></small>        
                                   </div>
                               
                       <?php    
                                 mysqli_query($con,"insert into db values('$title','$description','$link','$displayLink')");
                            
                             }
                             if($res==0){

                                ?>       
                                   <div class="output">
                                    <ul>
                                      <li>Please try again with relevant keywords .</li>
                                      <li>We fetch results from google if data is not found on our database ,due to some internal error it's not possible right now . :(</li>
                                      <ul>
                                   </div>
                                   <?php
                             }
            }?>

                
               
            
            
                
     
        
          <?php  mysqli_close($con); ?>
            
           
        <footer>
        </footer>
    </body>
</html>