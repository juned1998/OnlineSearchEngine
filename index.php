<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/bootstrap/bootstrap-4.1.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>SimpleSearch - PHP & MYSQL SEARCH ENGINE</title>
        <script src="js/google.js"></script>
    </head>
    <body>
        <nav class="navbar-nav container-fluid">
        
            <ul>
                <li><a href="#">Images</a></li>
                <li><a href="#">Videos</a></li>
                <li><a href="#">News</a></li>
            </ul>
        </nav>
        <div class="container">
            <center>
            <img id="logo" src="LOGO/logo_dark.png">
            </center>
            <div class="form-row align-items-center container-fluid">
            <form action = './search.php' method = "get">
                <ul>
                <li><input type="text" name="searchTerm" size="100" class="form-control" id="keyword" placeholder = "Example : youtube , facebook , etc ">
                </li>

                    <li><input type="submit" value="s" id="searchValue" ></li>
               </ul>
            </form>
           </div>
        </div>
        <footer>
            <nav class="clearfix">
                <ul class="left-links">
                <li><span>&copy; 2018 - </span><a href="https://github.com/juned1998">Simple Search</a></li>
                 </ul>    
                
                <ul class="right-links">
                <li><a href="">About us</a></li>
                <li><a href="">Buisness</a></li>
                <li><a href="">Privacy</a></li>
                 </ul>    
              
            </nav>
        </footer>
    </body>
</html>