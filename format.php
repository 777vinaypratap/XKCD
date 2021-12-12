<?php 
if(!defined('format')) {
    die('Nothing is available');
 }
?>

<?php 
function htmlformat($title,$content,$link, $linktext){
    $format='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>comics</title>
    </head>
    <body><div>
    <div id="logo" >
        <h1>'.$title.'</h1>
    </div>
    <div id="content">
        <p>'.$content.'</p>
        <a href='.$link.' >'.$linktext.'</a>
    </div>
    <style>
        
        #logo{
            background-color: #118ab2;
            border-radius: 5px;
            padding: 30px 0px;
        }
        #logo h1 {
            margin: 0px;
            text-align: center;
        font-size: 22px;
    color: white;
    font-weight: bold;
        }

        #content{
            position: relative;
            border: solid 2px #06D6A0;
            height: 370px;
            margin-top: 10px;
            border-radius:5px;
        }
        #content p{
            padding: 20px 10px;
            color: #06D6A0;
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
        }
        #content a{
            position: absolute;
            left: 50%;
            margin-top: 20%;
            transform: translate(-50%,0%);
            background-color: #118AB2;
            padding: 2px 10px;
            color: white;
            font-size:18px;
            font-weight: 900;
            font-family: Arial, Helvetica, sans-serif;
            text-decoration: none;
            border-radius:5px;

        }
    </style>
</div></body>
</html>';


return $format;
}
?>