<?php 

require_once "./classes/crud.php";

$page = 1;

$topic = crud::select()::columns(["id","name","logo","color","technology","status"]);
$topic = crud::table("topics")::where(["id" => $_GET["id"]])::execute();
$topic = crud::fetch("one");


$slides = crud::select()::columns(["id","name"]);
$slides = crud::table("slides")::where(["topic_id" => $topic["id"], "status" => 1])::execute();
$slides = crud::fetch("all");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic["name"]; ?></title>
    <link rel="stylesheet" href="./assets/css/topic.css">
    <!-- Icon fonts-->
    <link rel="icon" type="image/png" href="./uploads/topics/<?php echo $topic["logo"]; ?>">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main-bg">
        <svg id="visual" viewBox="0 0 900 450"  xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
        <rect x="0" y="0" width="900" height="450" fill="#FFFFFF"></rect>
        <defs>
            <linearGradient id="grad1_0" x1="50%" y1="100%" x2="100%" y2="0%">
                <stop offset="10%" stop-color="#ffffff" stop-opacity="1"></stop>
                <stop offset="90%" stop-color="#ffffff" stop-opacity="1"></stop>
            </linearGradient>
        </defs>
        <defs>
            <linearGradient id="grad2_0" x1="0%" y1="100%" x2="50%" y2="0%">
                <stop offset="10%" stop-color="#ffffff" stop-opacity="1"></stop>
                <stop offset="90%" stop-color="#ffffff" stop-opacity="1"></stop>
            </linearGradient>
        </defs>
        <g transform="translate(900, 450)">
            <path
                d="M-225 0C-218.4 -45 -211.8 -90.1 -182.7 -105.5C-153.7 -120.9 -102.2 -106.8 -68 -117.8C-33.8 -128.8 -16.9 -164.9 0 -201L0 0Z"
                fill="<?php echo $topic["color"]; ?>"></path>
        </g>
        <g transform="translate(0, 0)">
            <path
                d="M131 0C168.7 45.6 206.5 91.3 194.9 112.5C183.2 133.7 122.2 130.5 81.5 141.2C40.8 151.8 20.4 176.4 0 201L0 0Z"
                fill="<?php echo $topic["color"]; ?>"></path>
        </g>
    </svg>
    </div>

   
    <div class="content">
    <div class="content-header">
            <a href="topics.php" class="btn"><i class="fa fa-list"></i> Topics</a>
            <div>
                <h1 class="heading">Brain<b style="color:<?php echo $topic["color"]; ?>;">breads</b></h1>
                <h3 class="sub-heading"><?php echo $topic["name"]; ?></h3>
            </div>
            <a href="slides.php" class="btn"><i class="fa fa-clone"></i> Slides</a>
        </div>
        <div class="content-body">
        <h1>All topics</h1>
        <ol>
            <?php foreach ($slides as $slide): ?>
                <li><a href="slide.php?id=<?php echo $slide["id"]; ?>&page=<?php echo $page++; ?>"><?php echo ucfirst($slide["name"]); ?></a></li>  
            <?php endforeach; ?>
        </ol>
        </div>
        <div class="content-footer">
            <img src="./uploads/topics/<?php echo $topic["logo"]; ?>" class="tutorial-logo" alt="">
            <h4 class="tutorial-name"><?php echo $topic["technology"]; ?></h4>
        </div>
    </div>

</body>

</html>