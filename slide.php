<?php 

require_once "./classes/crud.php";

$page = $_GET["page"];

$page = ($page == 0) ? 1 : $page ;

$slide = crud::select()::columns(["id","name","topic_id","description","status","ordering"]);
$slide = crud::table("slides")::paging($page, 1)::execute();
$slide = crud::fetch("one");


$topic = crud::select()::columns(["id","name","logo","color","technology","status"]);
$topic = crud::table("topics")::where(["id" => $slide["topic_id"]])::execute();
$topic = crud::fetch("one");


$page = (!$topic) ? $page - 2 : $page ; 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic["name"]; ?> | <?php echo $slide["name"]; ?></title>
    <link rel="stylesheet" href="./assets/css/topic.css">
    <link rel="icon" type="image/png" href="./uploads/topics/<?php echo $topic["logo"]; ?>">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body >


<?php if($slide):?>
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
    <?php endif; ?>

    <div class="content">
        <div class="content-header">
        <?php if($slide):?>
            <a href="topic.php?id=<?php echo $slide["topic_id"]; ?>" class="btn">
                <i class="fa fa-list"></i> Slides
            </a>
            <?php endif; ?>
            <div style="width:100%;text-align:center;">
                <h1 class="heading">
                    Brain<b style="color:<?php echo $topic["color"]; ?>;">breads</b>
                </h1>
                <h3 class="sub-heading">
                    <?php echo $topic["name"]; ?>
                </h3>
            </div>
            <?php if($slide):?>
            <a href="topics.php" class="btn">
                <i class="fa fa-clone"></i> Topics
            </a>
            <?php endif; ?>
        </div>
        <div class="content-body">
            <?php if($slide):?>
            <h1><?php echo $slide["name"]; ?></h1>
            <?php echo $slide["description"]; ?>
            <?php if($page > 1):?>
            <a class="slideBtn next fa fa-angle-left" href="slide.php?page=<?php echo $page - 1; ?>"></a>
            <?php endif; ?>
          
            <a class="slideBtn prev fa fa-angle-right" href="slide.php?page=<?php echo $page + 1; ?>"></a> 
            <?php else: ?>
            <div class="error404">
                <img src="./assets/imgs/error.jpg" class="image" alt="">
                <a class="btn " href="slide.php?page=<?php echo $page + 1; ?>">
                 <i class="fa fa-angle-left"></i> Go Back</a> 
            </div>
            <?php endif; ?>
        </div>
        <?php if($slide):?>
        <div class="content-footer">
            <img src="./uploads/topics/<?php echo $topic["logo"]; ?>" class="tutorial-logo" alt="">
            <h4 class="tutorial-name"><?php echo $topic["technology"]; ?></h4>
        </div>
        <?php endif; ?>
    </div>

</body>

</html>