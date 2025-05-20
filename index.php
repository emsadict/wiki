<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "membership_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest news
//Consumer Keys
// twitter API: 5NkUybmUExSFcoVLy2w4RyzLC
// API Key Secret : VIk1PDVa9xqt6RMIHCr1OBEt45YZ1RwDsNlT8SggylzivLMLFo

//Authentication Tokens
//Bearer Token: AAAAAAAAAAAAAAAAAAAAADWxpAEAAAAA6dR1vosC6BUPhPGtv710tm%2F806k%3D3C7wP3pcbLEqCxTaAVc94xECbHXIWL16fPYZg0h6AUh0hrMIXt

//Access Token : 1489219526348660743-SbpKjn3NNZd1wW3AdiT5UthkGLjJag
//Access Token Secret: GzzUcjO3gWSxfZ30UwQFmoN5PZJ0WSpIiuYGv3JOaobga
$sql = "SELECT id, title, image, date,  content, author  FROM news ORDER BY date DESC LIMIT 5";
$result = $conn->query($sql);

// Fetch the latest news
$latest_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 1";
$latest_news_result = $conn->query($latest_news_query);

// Fetch the rest of the news
$other_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4 OFFSET 1";
$other_news_result = $conn->query($other_news_query);


//small Slider code
// Fetch images from the database
$query7 = "SELECT title, image_path FROM images ORDER BY created_at DESC LIMIT 5";
$result7 = $conn->query($query7);

$slides7 = [];

while ($row7 = $result7->fetch_assoc()) {
    $slides7[] = [
        "title" => htmlspecialchars($row7["title"]),
        "image_path" => htmlspecialchars($row7["image_path"])
    ];
}

// Encode data for JavaScript
$slides_json = json_encode($slides7);
// larger slider code
include "db_connect.php";

$query8 = "SELECT title, description, image_path FROM  imagegallery  ORDER BY uploaded_at DESC LIMIT 5";
$result8 = $conn->query($query8);

$slides8 = [];

while ($row8 = $result8->fetch_assoc()) {
    $slides8[] = [
        "title" => htmlspecialchars($row8["title"]),
        "description" => htmlspecialchars($row8["description"]),
        "image_path" => htmlspecialchars($row8["image_path"])
    ];
}

// Encode data for JavaScript
$slides_json1 = json_encode($slides8);
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
   <?php include "head.php"; ?>
   <style>


.swiper-container {
    max-width: 100%;
    height: 600px;
    overflow: hidden; /* Prevent images from escaping */
}

.slider-image-container {
    position: relative;
    text-align: center;
    color: white;
}

.slider-img {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 10px;
}

.slider-description {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 60%;
    transform: translate(-50%, -50%);
    font-size: 24px;
    font-weight: bold;
    background: rgba(58, 136, 181, 0.5);
    padding: 10px;
    border-radius: 5px;
}

.slider-title {
    text-align: Buttom;
    font-size: 22px;
    margin-top: 10px;
    color: white;
    background: rgba(0, 0, 0, 0.7);
    padding: 5px;
    border-radius: 5px;
    position: relative;
    bottom: -20px;
}

</style>

</head>

<body class="home page-template-default page page-id-2039 gdlr-core-body woocommerce-no-js tribe-no-js kingster-body kingster-body-front kingster-full  kingster-with-sticky-navigation  kingster-blockquote-style-1 gdlr-core-link-to-lightbox">
<?php include "mobilemenu.php"; ?>
    <div class="kingster-body-outer-wrapper ">
        <div class="kingster-body-wrapper clearfix  kingster-with-frame">
           <?php include "headermenu.php" ?>
           <?php   include "menu.php";?>

            <div class="kingster-page-wrapper" id="kingster-page-wrapper">
                <div class="gdlr-core-page-builder-body">
                    <div class="gdlr-core-pbf-wrapper " style="padding: 0px 0px 0px 0px;">
                        <div class="gdlr-core-pbf-background-wrap" style="background-color: rgba(26, 112, 182, 0.9) ;"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-revolution-slider-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">

                                        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
                                            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.8">
                                                <ul>
                                                    <li data-index="rs-3" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/slider2.png" alt="" title="slider-1-2" style="overlay: rgb(58, 160, 210);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>  
                                                   <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(30, 155, 204, 0.22);border-radius:3px 3px 3px 3px;"></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-1" data-x="38" data-y="center" data-voffset="-160" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 33px; line-height: 33px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Welcome to</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="-80" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 83px; line-height: 83px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">WIKIMEDIA UG NIGERIA</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="20" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 70px; line-height: 50px; font-weight: 500; color: #ffffff; letter-spacing: 0px;font-family:Poppins;"> (Affiliate of Wikimedia Foundation)</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="100" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Owner of Wikipedia</div>
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/slider.png" alt="" title="slider-2" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(58, 159, 210, 0.22);border-radius:3px 3px 3px 3px;"></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-1" data-x="70" data-y="center" data-voffset="-160" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 33px; line-height: 33px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Welcome to </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="-80" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 83px; line-height: 83px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">WIKIMEDIA UG NIERIA </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-1-layer-2" data-x="33" data-y="center" data-voffset="20" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":370,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 70px; line-height: 50px; font-weight: 500; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">(Affiliate of Wikimedia Foundation)</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="95" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Owner of Wikipedia</div>
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-1-layer-6" data-x="34" data-y="center" data-voffset="160" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":740,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(16, 70, 46, 0.9);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 7; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-4" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/slidermain.jpg" alt="" title="slider-1-2" style="overlay: rgb(58, 160, 210);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(58, 159, 210, 0.22);border-radius:3px 3px 3px 3px;"></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-2" data-x="55" data-y="center" data-voffset="-52" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 88px; line-height: 88px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">WIKIMEDIA UG NIERIA </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="20" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 70px; line-height: 50px; font-weight: 500; color: #ffffff; letter-spacing: 0px;font-family:Poppins;"> (Affiliate of Wikimedia Foundation)</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="100" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">Owner of Wikipedia</div>                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>

                                                    <li data-index="rs-5" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="upload/slider-1-2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description=""> <img src="upload/sliderwikichair.jpg" alt="" title="slider-1-2" style="overlay: rgba(58, 160, 210);" width="1800" height="1119" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-3-layer-4" data-x="-480" data-y="center" data-voffset="80" data-width="['2400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgb(58, 160, 210, 0.22);border-radius:3px 3px 3px 3px;"></div>
                                                    <div class="tp-caption   tp-resizeme" id="slide-3-layer-2" data-x="55" data-y="center" data-voffset="-52" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-size: 88px; line-height: 88px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">WIKIMEDIA UG NIERIA </div>
                                                    <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="20" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap; font-size: 70px; line-height: 50px; font-weight: 500; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;"> (Affiliate of Wikimedia Foundation)</div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-3" data-x="33" data-y="center" data-voffset="100" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":360,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10; white-space: nowrap;font-size: 88px; line-height: 60px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins ;">Join us today</div>
                                                        
                                                        <div class="tp-caption rev-btn rev-hiddenicon " id="slide-3-layer-6" data-x="34" data-y="center" data-voffset="180" data-width="['auto']" data-height="['auto']" data-type="button" data-responsive_offset="on" data-frames='[{"delay":660,"speed":300,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(1, 135, 63);bg:rgba(255,255,255,1);bw:0 0 0 5px;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[19,19,19,19]" data-paddingright="[21,21,21,21]" data-paddingbottom="[19,19,19,19]" data-paddingleft="[21,21,21,21]" style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 16px; font-weight: 600; color: #2d2d2d; letter-spacing: 0px;font-family:Poppins;background-color:rgb(255,255,255);border-color:rgb(61,177,102);border-style:solid;border-width:0px 0px 0px 5px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">Take A Tour</div>
                                                    </li>
                                                </ul>
                                                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper  hp1-col-services"  data-skin="Blue Title" id="gdlr-core-wrapper-1">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
                                <div class=" gdlr-core-pbf-wrapper-container-inner gdlr-core-item-mglr clearfix" id="div_1dd7_0">
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15 gdlr-core-column-first">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_1">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_2">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-1.png" alt="" width="40" height="40" title="icon-1" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_0">GLAM</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_3"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-1">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_4">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_5">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-2.png" alt="" width="44" height="40" title="icon-2" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_1">Education</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_6"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-2">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_7">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_8">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-3.png" alt="" width="44" height="39" title="icon-3" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_2">Advocacy</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_9"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-column gdlr-core-column-15" id="gdlr-core-column-3">
                                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_10">
                                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                                <div class="gdlr-core-pbf-element">
                                                    <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-with-caption gdlr-core-item-pdlr" id="div_1dd7_11">
                                                        <div class="gdlr-core-column-service-media gdlr-core-media-image"><img src="upload/icon-4.png" alt="" width="41" height="41" title="icon-4" /></div>
                                                        <div class="gdlr-core-column-service-content-wrapper">
                                                            <div class="gdlr-core-column-service-title-wrap">
                                                                <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_3">Gender-gap</h3>
                                                                <div class="gdlr-core-column-service-caption gdlr-core-info-font gdlr-core-skin-caption" id="div_1dd7_12"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper "  id="gdlr-core-wrapper-2">
                        <div class="gdlr-core-pbf-background-wrap">
                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_13" data-parallax-speed="0.8"></div>
                        </div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom">
                                <div class="gdlr-core-pbf-column gdlr-core-column-30 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_14" data-sync-height="height-1">
                                        <div class="gdlr-core-pbf-background-wrap">
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_15" data-parallax-speed="0"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content"></div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-30" id="gdlr-core-column-4">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_16" data-sync-height="height-1">
                                        <div class="gdlr-core-pbf-background-wrap">
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_17" data-parallax-speed="0.1"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_18">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_4">THE CHAIRMAN'S WELCOME ADDRESS</h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_0">Welcome Address</span></div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" id="div_1dd7_19">
                                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_20">
                                                        <p>We don’t just give students an education and experiences that set them up for success in a career. We help them succeed in their career—to discover a field they’re passionate about and dare to lead it.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="#" id="a_1dd7_0"><span class="gdlr-core-content" >Apply Now</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_21">
                        <div class="gdlr-core-pbf-background-wrap">
                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_22" data-parallax-speed="0.2"></div>
                        </div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-left-align" id="div_1dd7_23">
                                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" id="div_1dd7_24"><img src="images/logo.png" alt="" width="262" height="35" title="logo-white" /></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_25">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_5">Mission & Vision Statement</h3></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="gdlr-core-pbf-column gdlr-core-column-40">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                          
                                            <div class="swiper-container" style="max-width: 100%; height: 600px;">
                                                    <div class="swiper-wrapper" id="sliderContainer1"></div>
                                                    <!-- Navigation Arrows -->
                                                    <div class="swiper-button-next"></div>
                                                    <div class="swiper-button-prev"></div>
                                                    <!-- Pagination Dots -->
                                                    <div class="swiper-pagination"></div>
                                                </div>

                                                <!-- Include Swiper.js -->
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
                                                <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
<div class="row" style="background:#1781cc; padding-bottom: 20px;" >
<div class="gdlr-core-pbf-wrapper "  id="gdlr-core-wrapper-4">
    <div class="gdlr-core-pbf-background-wrap">

    </div>
     <h3 style="text-align: center; color: white;">Overview of Wikimedia</h3> 

    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js " >
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom" id="div_1dd7_81">
          <a href="">
           <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12">
           <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(71, 152, 98, 0.52); overflow: hidden;transition: border-color 0.3s ease, transform 0.3s ease;" 
        onmouseover="this.style.borderColor='#479862'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='#ddd'; this.style.transform='translateY(0)';">
        <div class="gdlr-core-pbf-background-wrap">
        <div style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.4);">
        </div>
          <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/mission_vision.jpg') no-repeat center center;   background-size: cover; ">
          </div>
        </div>
       
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js gdlr-core-sync-height-content">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                    <div class="gdlr-core-title-item-title-wrap clearfix">
                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title" id="h3_1dd7_30" style="color: white; font-size: 17px;">
                            ADVOCACY
                        </h3>
                    </div>
                </div>
            </div>
        </div>
          </div>
     </div>

          </a>
          <a href="">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; transition: border-color 0.3s ease, transform 0.3s ease;" onmouseover="this.style.borderColor='#479862'; this.style.transform='translateY(-5px)';"  onmouseout="this.style.transform='translateY(0)'";>
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(143, 181, 156, 0.77);">
                    <div class="gdlr-core-pbf-background-wrap">
                    <div style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.4);">
                    </div>
                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/mission_vision.jpg') no-repeat center center; background-size: cover;">

                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">EDUCATION</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>
          <a href="">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; border: 4px solid transparent; transition: border-color 0.3s ease, transform 0.3s ease;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(71, 152, 98, 0.52);">
                    <div class="gdlr-core-pbf-background-wrap">

                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/cat8.jpg') no-repeat center center; background-size: cover;"></div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">GENDER-GAP INITIATIVE</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>
          <a href="">
            <div class="gdlr-core-pbf-column gdlr-core-column-15 col-lg-3 col-md-6 col-sm-12 col-xs-12 " style="border-radius: 20px; border: 4px solid transparent; transition: border-color 0.3s ease, transform 0.3s ease;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_88" data-sync-height="height-column" data-sync-height-center style="background-color:rgba(143, 181, 156, 0.77);">
                    <div class="gdlr-core-pbf-background-wrap">

                        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js faded-background2" id="div_1dd7_89" data-parallax-speed="0" style="background: url('images/cat8.jpg') no-repeat center center; background-size: cover;"></div>
                    </div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_90">
                                <div class="gdlr-core-title-item-title-wrap clearfix">

                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_30" style="color: white; font-size: 17px;">MEMBERSHIP</h3>
                                </div>
                                <!-- <span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" id="span_1dd7_7" style="color: #1c2e51;">Kingster University was established by John Smith in 1920 for the public benefit and it is recognized globally.</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </a>

        </div>
    </div>
</div>
</div>  
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_44">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                                
                            <?php


// Fetch the latest news
$latest_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 1";
$latest_news_result = $conn->query($latest_news_query);

// Fetch the rest of the news
$other_news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 4 OFFSET 1";
$other_news_result = $conn->query($other_news_query);
?>

<div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first">
    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" id="div_1dd7_45" data-sync-height="height-2">
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js gdlr-core-sync-height-content">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix gdlr-core-style-blog-widget">
                    <div class="gdlr-core-block-item-title-wrap gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_46">
                        <div class="gdlr-core-block-item-title-inner clearfix">
                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_10"style="color:#1781cc;">News & Updates</h3>
                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_47"></div>
                        </div>
                        <a class="gdlr-core-block-item-read-more" href="blog.php" target="_self" id="a_1dd7_5">Read All News</a>
                    </div>

                    <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                        
                        <!-- Latest News - Large Thumbnail -->
                        <?php if ($latest_news_result->num_rows > 0) {
                            $latest_news = $latest_news_result->fetch_assoc(); 

                            // Extract first 50 words from content
                            $content_words = explode(' ', strip_tags($latest_news['content']));
                            $short_description = implode(' ', array_slice($content_words, 0, 50)) . '... ';
                        ?>
                            <div class="gdlr-core-item-list-wrap gdlr-core-column-30" >
                                <div class="gdlr-core-item-list-inner gdlr-core-item-mglr" style=" padding-top:20px; padding-left:20px;padding-right:20px;padding-bottom: 20px;">
                                    <div class="gdlr-core-blog-grid">
                                        <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                            <a href="view_news.php?id=<?= $latest_news['id'] ?>">
                                                <img src="./admin/uploads/<?= $latest_news['image']; ?>" width="700" height="430" alt="<?= $latest_news['title'] ?>" />
                                            </a>
                                        </div>
                                        <div class="gdlr-core-blog-grid-content-wrap">
                                            <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                    <a href="#"><?= date('F j, Y', strtotime($latest_news['created_at'])) ?></a>
                                                </span>
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption">
                                                     BY <?= htmlspecialchars($latest_news['author']) ?>
                                                </span>
                                            </div>
                                            <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_11">
                                                <a href="view_news.php?id=<?= $latest_news['id'] ?>"><?= $latest_news['title'] ?></a>
                                            </h3>
                                            <p><?= $short_description ?> <center><button  style="color: #ffffff; border:0px; decoration:none; background-color:#1781cc; width: 100px;; padding:auto; height:40px;"><a style="color: #ffffff; border:0px; decoration:none; background-color:#1781cc; width: 100px; padding:auto; height:40px;" href="view_news.php?id=<?= $latest_news['id'] ?>">Read More</a></button></center></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Other News - Small Thumbnails -->
                        <div class="gdlr-core-item-list-wrap gdlr-core-column-30" style=" padding-top:20px; padding-bottom:85px;">
                            <?php if ($other_news_result->num_rows > 0) {
                                while ($row = $other_news_result->fetch_assoc()) { ?>
                                    <div class="gdlr-core-item-list gdlr-core-blog-widget gdlr-core-item-mglr clearfix gdlr-core-style-small">
                                        <div class="gdlr-core-blog-thumbnail gdlr-core-media-image gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                            <a href="view_news.php?id=<?= $row['id'] ?>">
                                                <img src="./admin/uploads/<?= $row['image']; ?>" alt="<?= $row['title'] ?>" width="150" height="150" />
                                            </a>
                                        </div>
                                        <div class="gdlr-core-blog-widget-content">
                                            <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                    <a href="#"><?= date('F j, Y', strtotime($row['created_at'])) ?></a>
                                                </span>
                                                <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption">
                                                     BY <?= htmlspecialchars($row['author']) ?>
                                                </span>
                                            </div>
                                            <h3 class="gdlr-core-blog-title gdlr-core-skin-title" id="h3_1dd7_12">
                                                <a href="view_news.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                <?php } 
                            } ?>
                            <center><button style="color:#ffffff; border:0px; background-color:#1781cc; width: 100px;; padding:auto; padding: top 40px;;height:40px;"><a style="color: #ffffff;" href="blog.php">Read all News</a></button></center>
                        </div><br />
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Close connection
$conn->close();
?>
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" id="gdlr-core-column-8">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-right" id="div_1dd7_48" data-sync-height="height-2">
                                        <div class="gdlr-core-pbf-background-wrap">
                                    <!--    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"  data-x="-480" data-y="center" data-voffset="80" data-width="['400']" data-height="['1000']" data-type="shape" data-responsive_offset="on" data-frames='[{"delay":330,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(147, 246, 201, 0.84);border-radius:3px 3px 3px 3px;"></div> -->
                                                                    
                                            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_49" data-parallax-speed="0"></div>
                                        </div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" id="div_1dd7_50">
                                                    <div class="gdlr-core-title-item-left-icon" id="div_1dd7_51"><i class="icon_link_alt" id="i_1dd7_1"></i></div>
                                                    <div class="gdlr-core-title-item-left-icon-wrap">
                                                        <div class="gdlr-core-title-item-title-wrap clearfix">
                                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_15">Quick Links</h3></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-66469">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_16"><a href="#" target="_self" style="color:#ffffff">Membership Login</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_52">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_53"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-42777">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_17"><a href="#" target="_self" style="color:#ffffff">Membership Registration</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_54">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_55"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-51281">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_18"><a href="#" target="_self" style="color:#ffffff" >News</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_56">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_57"></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"  id="gdlr-core-title-item-id-78243">
                                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                                        <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " id="h3_1dd7_19"><a href="#" target="_self" style="color:#ffffff">Events</a></h3></div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" id="div_1dd7_58">
                                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" id="div_1dd7_59"></div>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first" data-skin="Blue Title">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-left" id="div_1dd7_64" data-sync-height="height-3" data-sync-height-center>
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_65"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_66">
                                                        <div class="gdlr-core-twitter-item gdlr-core-item-pdb" id="div_1dd7_67">
                                                            
                                                            
                                                            <div class="gdlr-core-twitter-content">
                                                                <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel" data-column="1" data-nav="navigation" data-nav-parent="gdlr-core-twitter-item">
                                                                <div class="gdlr-core-twitter-content">
                                                                    <!-- Marquee Text -->
                                                         <div style="margin-top: 10px; padding: 5px;">
                                                           <marquee behavior="scroll" direction="left" style="color: #ae2c2c; font-weight: 600;font-size: 30px;">
                                                           9-11 Okeiho Street, Dopemu, Lagos-Abeokuta Extra way, Ikeja, Lagos, Nigeria.!
                                                           </marquee>
                                                        </div>
                                                                    </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="White Text">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js  gdlr-core-column-extend-right" id="div_1dd7_68" data-sync-height="height-3">
                                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_69"></div>
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js  gdlr-core-sync-height-content">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-column-service-item gdlr-core-item-pdb  gdlr-core-left-align gdlr-core-column-service-icon-left gdlr-core-no-caption gdlr-core-item-pdlr" id="div_1dd7_70">
                                                    <div class="gdlr-core-column-service-media gdlr-core-media-image" id="div_1dd7_71"><img src="images/logo.png" alt="" width="42" height="39" title="apply-logo" /></div>
                                                    <div class="gdlr-core-column-service-content-wrapper">
                                                        <div class="gdlr-core-column-service-title-wrap">
                                                            <h3 class="gdlr-core-column-service-title gdlr-core-skin-title" id="h3_1dd7_22">Apply To AFUED</h3></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="gdlr-core-pbf-column-link" href="#" target="_self"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- begin of news/facebook tweet -->
                    <div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first" style="background-color:#1781cc; margin-top: 0px;">
    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: 0px 0px 0px 0px;padding: 30px 0px 0px 0px;">
        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-widget">
                    
            <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                
                          <div class="gdlr-core-item-list-wrap gdlr-core-column-30">

                          <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" style="margin-bottom: 35px ;">
                        <div class="gdlr-core-block-item-title-inner clearfix">
                            <h3 class="gdlr-core-block-item-title" style="font-size: 24px ;font-style: normal ;text-transform: none ;letter-spacing: 0px ;color: #600909 ;"> X  POSTS</h3>
                            <div class="gdlr-core-block-item-title-divider" style="font-size: 22px ;border-bottom-color:rgb(42, 8, 4) ;border-bottom-width: 2px ;"></div>
                        </div>
                    </div>
                              <div class="gdlr-core-item-list-inner gdlr-core-item-mglr">
                                  <div class="gdlr-core-blog-grid">
            
                                      <div class="gdlr-core-blog-grid-content-wrap">
                                          <div class="gdlr-core-blog-info-wrapper gdlr-core-skin-divider">
                    
                                          <div class="gdlr-core-twitter-content">
                                                    <!-- Elfsight Instagram Feed | Untitled Instagram Feed -->
                                                   <!-- Elfsight Instagram Feed | Untitled Instagram Feed -->
                                                 <script src="https://static.elfsight.com/platform/platform.js" async></script>
                                                 <div class="elfsight-app-ed162fdb-74bd-48a3-9863-fadc7dccceca" data-elfsight-app-lazy></div>
                                         </div>


                                          </div>
                
                                      </div>
                                  </div>
                              </div>
                          </div>
                          

                          <div class="gdlr-core-item-list-wrap gdlr-core-column-30">
                          <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" style="margin-bottom: 35px ;">
                        <div class="gdlr-core-block-item-title-inner clearfix">
                            <h3 class="gdlr-core-block-item-title" style="font-size: 24px ;font-style: normal ;text-transform: none ;letter-spacing: 0px ;color: #600909 ;">INSTAGRAM  POSTS</h3>
                            <div class="gdlr-core-block-item-title-divider" style="font-size: 22px ;border-bottom-color:rgb(42, 8, 4) ;border-bottom-width: 2px ;"></div>
                        </div>
                    </div>
                                       <div class="gdlr-core-item-list gdlr-core-blog-widget gdlr-core-item-mglr clearfix gdlr-core-style-small">
                                           <div class="gdlr-core-blog-widget-content">
                                               <!-- Elfsight Twitter Feed | Untitled Twitter Feed -->
                                               <!-- Elfsight Twitter Feed | wikimedia -->
                                               <script src="https://static.elfsight.com/platform/platform.js" async></script>
                                               <div class="elfsight-app-a396367d-976d-4a62-9c14-f92895b5b9bb" data-elfsight-app-lazy></div>
                                           </div>
                                       </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- begin of facebook tweet---->

<div class="gdlr-core-pbf-column gdlr-core-column-20" style="margin-top: 35px;">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="margin: 0px 20px 0px 0px;padding: 0px 0px 0px 0px; ">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" style="padding-bottom: 0px ;">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" style="margin-bottom: 8px ; ">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" style="font-size: 22px ;font-style: normal ;text-transform: none ;letter-spacing: 0px ;color:rgb(45, 4, 2) ;">FACEBOOK POSTS</h3>
                                                            <div class="gdlr-core-block-item-title-divider" style="font-size: 22px ;border-bottom-color:rgb(42, 8, 4) ;border-bottom-width: 2px ;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <div id="fb-root">
                                                        <script async defer crossorigin="anonymous" 
                                                            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="XYZ">
                                                        </script>
                                                      <!-- <h4 class="text-white text-center" style="background-color: #1F2B44; color: white; padding: 20px; ">Facebook Feeds</h4> -->
                                                    
                                                        <!-- Facebook Page Plugin -->
                                                        <div  class="fb-page" 
                                                            data-href="https://web.facebook.com/WikimediaNG" 
                                                            data-tabs="timeline" 
                                                            data-width="800" 
                                                            data-height="700" 
                                                            data-small-header="false" 
                                                            data-adapt-container-width="true" 
                                                            data-hide-cover="false" 
                                                            data-show-facepile="true">
                                                            <blockquote cite="https://web.facebook.com/WikimediaNG" class="fb-xfbml-parse-ignore">
                                                                <a href="https://web.facebook.com/WikimediaNG">Visit  Wikimedia POSTS</a>
                                                            </blockquote>
                                                        </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div> <br>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                                                    <center><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" href="https://www.facebook.com/WikimediaNG/" id="a_1dd7_6" target="_blank">
                                                        <i class="gdlr-core-pos-left fa fa-facebook"  ></i>
                                                        <span class="gdlr-core-content" >Visit Our Facebook Page</span>
                                                    </a></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


<!--- end of facebook tweet---->

                   
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_91">
                        <div class="gdlr-core-pbf-background-wrap"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container" id="event" >
                                
                            <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                            <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Photo Slider</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                       <div class="gdlr-core-pbf-column-content-margin gdlr-core-js">
                                           <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                                               <div class="swiper-container">
                                                   <div class="swiper-wrapper" id="sliderContainer">
                                                       <!-- Images will load here dynamically -->
                                                   </div>
                                                   <!-- Navigation Arrows -->
                                                   <div class="swiper-button-next"></div>
                                                   <div class="swiper-button-prev"></div>
                                                   <!-- Pagination Dots -->
                                                   <div class="swiper-pagination"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                <div class="gdlr-core-pbf-column gdlr-core-column-20">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_93">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" id="div_1dd7_94">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Upcoming Events</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <?php                                                
                                                              include "db_connect.php";
                                                              // Fetch upcoming events from the database
                                                                  $query = "SELECT id, title, event_date, event_time, event_venue FROM events ORDER BY event_date ASC LIMIT 4";
                                                                  $result = $conn->query($query);
                                                                  while ($row = $result->fetch_assoc()) {
                                                                 // Extract date and format it for display
                                                                  $eventDate = date("d", strtotime($row['event_date'])); // Extracts the day
                                                                  $eventMonth = date("M", strtotime($row['event_date'])); // Extracts the month
                                                                  $eventTime = htmlspecialchars($row['event_time']);
                                                                  $eventTitle = htmlspecialchars($row['title']);
                                                                  $eventVenue = htmlspecialchars($row['event_venue']);

                                                                  echo '
                                                                  <div class="gdlr-core-event-item-listgdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_97"">
                                                                          <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                            <span class="gdlr-core-date">'.$eventDate.'</span>
                                                                              <span class="gdlr-core-month">'.$eventMonth.'</span>
                                                                          </span>
                                                                          <div class="gdlr-core-event-item-content-wrap">
                                                                              <h3 class="gdlr-core-event-item-title">
                                                                                  <a href="mainevent.php?id='.$row['id'].'">'.$eventTitle.'</a>
                                                                                  
                                                                              </h3>
                                                                                  <div class="gdlr-core-event-item-info-wrap">
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_clock_alt"></i>
                                                                                      </span>
                                                                                      <span class="gdlr-core-tail">'.$eventTime.'</span>
                                                                                  </span>
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_pin_alt"></i>
                                                                                      </span>
                                                                                    <span class="gdlr-core-tail">'.$eventVenue.'</span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>';
                                                              }
                                                              ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-transparent gdlr-core-button-no-border" href="events.php" id="a_1dd7_7"><span class="gdlr-core-content" >View All Events</span><i class="gdlr-core-pos-right fa fa-long-arrow-right" id="i_1dd7_2"  ></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="gdlr-core-pbf-column gdlr-core-column-20" data-skin="Newsletter">
                                <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Location</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                                <div class="gdlr-core-wp-google-map-plugin-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">
                                                    <div style="overflow:hidden;width: 100%;position: relative;">
                                                        <iframe style="width:100%; height:380px; " 
                                                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3963.2936443102662!2d3.3094999999999994!3d6.610388899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMzYnMzcuNCJOIDPCsDE4JzM0LjIiRQ!5e0!3m2!1sen!2sng!4v1746007618526!5m2!1sen!2sng"
                                                        width="600" 
                                                        height="450" 
                                                        frameborder="4px" style="border:4px solid rgba(16, 70, 46, 0.9)" 
                                                        allowfullscreen>
                                                    </iframe>
                                                        <div style="position:  absolute; width: 80%; bottom: 20px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;">
                                                        
                                                        </div>
                                                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                                                    </div>
                                                    <!-- Marquee Text -->
                                                         <div style="margin-top: 10px; padding: 5px;">
                                                           <marquee behavior="scroll" direction="left" style="color: #ae2c2c; font-weight: 600;font-size: 30px;">
                                                           9-11 Okeiho Street, Dopemu, Lagos-Abeokuta Extra way, Ikeja, Lagos, Nigeria.!
                                                           </marquee>
                                                        </div>
                                            </div>      
                                    </div>
                                    </div>
                            
                        </div>
                    </div>
               
                    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_107">
                        <div class="gdlr-core-pbf-background-wrap" id="div_1dd7_108"></div>
                        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom" id="div_1dd7_109">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-gallery-item gdlr-core-item-pdb clearfix  gdlr-core-gallery-item-style-grid" id="div_1dd7_110">
                                        <div class="gdlr-core-gallery-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-column-first gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-1.png" alt="" width="248" height="120" title="banner-1" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-2.png" alt="" width="248" height="120" title="banner-2" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-3.png" alt="" width="248" height="120" title="banner-3" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-4-1.png" alt="" width="248" height="120" title="banner-4" /></div>
                                            </div>
                                            <div class="gdlr-core-item-list gdlr-core-gallery-column  gdlr-core-column-12 gdlr-core-item-pdlr gdlr-core-item-mgb">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image"><img src="upload/banner-5.png" alt="" width="248" height="120" title="banner-5" /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php include "footer.php";?>
        </div>
    </div>


	<script type='text/javascript' src='js/jquery/jquery.js'></script>
    <script type='text/javascript' src='js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='plugins/revslider/public/assets/js/jquery.themepunch.tools.min.js'></script>
    <script type='text/javascript' src='plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js'></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.parallax.min.js"></script>  
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.actions.min.js"></script> 
    <script type="text/javascript" src="plugins/revslider/public/assets/js/extensions/revolution.extension.video.min.js"></script>

    <script type="text/javascript">
        /*<![CDATA[*/
        function setREVStartSize(e) {
            try {
                e.c = jQuery(e.c);
                var i = jQuery(window).width(),
                    t = 9999,
                    r = 0,
                    n = 0,
                    l = 0,
                    f = 0,
                    s = 0,
                    h = 0;
                if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                        f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                    }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                    var u = (e.c.width(), jQuery(window).height());
                    if (void 0 != e.fullScreenOffsetContainer) {
                        var c = e.fullScreenOffsetContainer.split(",");
                        if (c) jQuery.each(c, function(e, i) {
                            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                        }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                    }
                    f = u
                } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                e.c.closest(".rev_slider_wrapper").css({
                    height: f
                })
            } catch (d) {
                console.log("Failure at Presize of Slider:" + d)
            }
        }; /*]]>*/
    </script>
    <script>
        (function(body) {
            'use strict';
            body.className = body.className.replace(/\btribe-no-js\b/, 'tribe-js');
        })(document.body);
    </script>
    <script>
        var tribe_l10n_datatables = {
            "aria": {
                "sort_ascending": ": activate to sort column ascending",
                "sort_descending": ": activate to sort column descending"
            },
            "length_menu": "Show _MENU_ entries",
            "empty_table": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "info_empty": "Showing 0 to 0 of 0 entries",
            "info_filtered": "(filtered from _MAX_ total entries)",
            "zero_records": "No matching records found",
            "search": "Search:",
            "all_selected_text": "All items on this page were selected. ",
            "select_all_link": "Select all pages",
            "clear_selection": "Clear Selection.",
            "pagination": {
                "all": "All",
                "next": "Next",
                "previous": "Previous"
            },
            "select": {
                "rows": {
                    "0": "",
                    "_": ": Selected %d rows",
                    "1": ": Selected 1 row"
                }
            },
            "datepicker": {
                "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
                "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "monthNamesShort": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "monthNamesMin": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                "nextText": "Next",
                "prevText": "Prev",
                "currentText": "Today",
                "closeText": "Done",
                "today": "Today",
                "clear": "Clear"
            }
        };
        var tribe_system_info = {
            "sysinfo_optin_nonce": "a32c675aaa",
            "clipboard_btn_text": "Copy to clipboard",
            "clipboard_copied_text": "System info copied",
            "clipboard_fail_text": "Press \"Cmd + C\" to copy"
        };
    </script>

    <script type="text/javascript">
        /*<![CDATA[*/
        function revslider_showDoubleJqueryError(sliderID) {
            var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
            errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
            errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
            errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
            errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
            jQuery(sliderID).show().html(errorMessage);
        } /*]]>*/
    </script>

    <script type='text/javascript' src='plugins/goodlayers-core/plugins/combine/script.js'></script>
    <script type='text/javascript'>
        var gdlr_core_pbf = {
            "admin": "",
            "video": {
                "width": "640",
                "height": "360"
            },
            "ajax_url": "https:\/\/demo.goodlayers.com\/kingster\/wp-admin\/admin-ajax.php"
        };
    </script>
    <script type='text/javascript' src='plugins/goodlayers-core/include/js/page-builder.js'></script>



    <script type='text/javascript' src='js/jquery/ui/effect.min.js'></script>
    <script type='text/javascript'>
        var kingster_script_core = {
            "home_url": "https:\/\/demo.goodlayers.com\/kingster\/"
        };
    </script>
    <script type='text/javascript' src='js/plugins.min.js'></script>
	<script>
	    /*<![CDATA[*/
	    var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
	    var htmlDivCss = "";
	    if (htmlDiv) {
	        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
	    } else {
	        var htmlDiv = document.createElement("div");
	        htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
	        document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
	    } /*]]>*/
	</script>
	<script type="text/javascript">
	    /*<![CDATA[*/
	    if (setREVStartSize !== undefined) setREVStartSize({
	        c: '#rev_slider_1_1',
	        gridwidth: [1380],
	        gridheight: [713],
	        sliderLayout: 'auto'
	    });
	    var revapi1, tpj;
	    (function() {
	        if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad);
	        else onLoad();

	        function onLoad() {
	            if (tpj === undefined) {
	                tpj = jQuery;
	                if ("off" == "on") tpj.noConflict();
	            }
	            if (tpj("#rev_slider_1_1").revolution == undefined) {
	                revslider_showDoubleJqueryError("#rev_slider_1_1");
	            } else {
	                revapi1 = tpj("#rev_slider_1_1").show().revolution({
	                    sliderType: "standard",
	                    jsFileLocation: "//demo.goodlayers.com/kingster/wp-content/plugins/revslider/public/assets/js/",
	                    sliderLayout: "auto",
	                    dottedOverlay: "none",
	                    delay: 9000,
	                    navigation: {
	                        keyboardNavigation: "off",
	                        keyboard_direction: "horizontal",
	                        mouseScrollNavigation: "off",
	                        mouseScrollReverse: "default",
	                        onHoverStop: "off",
	                        touch: {
	                            touchenabled: "on",
	                            touchOnDesktop: "off",
	                            swipe_threshold: 75,
	                            swipe_min_touches: 1,
	                            swipe_direction: "horizontal",
	                            drag_block_vertical: false
	                        },
	                        arrows: {
	                            style: "uranus",
	                            enable: true,
	                            hide_onmobile: true,
	                            hide_under: 1500,
	                            hide_onleave: true,
	                            hide_delay: 200,
	                            hide_delay_mobile: 1200,
	                            tmp: '',
	                            left: {
	                                h_align: "left",
	                                v_align: "center",
	                                h_offset: 20,
	                                v_offset: 0
	                            },
	                            right: {
	                                h_align: "right",
	                                v_align: "center",
	                                h_offset: 20,
	                                v_offset: 0
	                            }
	                        },
	                        bullets: {
	                            enable: true,
	                            hide_onmobile: false,
	                            hide_over: 1499,
	                            style: "uranus",
	                            hide_onleave: true,
	                            hide_delay: 200,
	                            hide_delay_mobile: 1200,
	                            direction: "horizontal",
	                            h_align: "center",
	                            v_align: "bottom",
	                            h_offset: 0,
	                            v_offset: 30,
	                            space: 7,
	                            tmp: '<span class="tp-bullet-inner"></span>'
	                        }
	                    },
	                    visibilityLevels: [1240, 1024, 778, 480],
	                    gridwidth: 1380,
	                    gridheight: 713,
	                    lazyType: "none",
	                    shadow: 0,
	                    spinner: "off",
	                    stopLoop: "off",
	                    stopAfterLoops: -1,
	                    stopAtSlide: -1,
	                    shuffle: "off",
	                    autoHeight: "off",
	                    disableProgressBar: "on",
	                    hideThumbsOnMobile: "off",
	                    hideSliderAtLimit: 0,
	                    hideCaptionAtLimit: 0,
	                    hideAllCaptionAtLilmit: 0,
	                    debugMode: false,
	                    fallbacks: {
	                        simplifyAll: "off",
	                        nextSlideOnWindowFocus: "off",
	                        disableFocusListener: false,
	                    }
	                });
	            };
	        };
	    }()); /*]]>*/
	</script>
	<script>
	    /*<![CDATA[*/
	    var htmlDivCss = unescape("%23rev_slider_1_1%20.uranus.tparrows%20%7B%0A%20%20width%3A50px%3B%0A%20%20height%3A50px%3B%0A%20%20background%3Argba%28255%2C255%2C255%2C0%29%3B%0A%20%7D%0A%20%23rev_slider_1_1%20.uranus.tparrows%3Abefore%20%7B%0A%20width%3A50px%3B%0A%20height%3A50px%3B%0A%20line-height%3A50px%3B%0A%20font-size%3A40px%3B%0A%20transition%3Aall%200.3s%3B%0A-webkit-transition%3Aall%200.3s%3B%0A%20%7D%0A%20%0A%20%20%23rev_slider_1_1%20.uranus.tparrows%3Ahover%3Abefore%20%7B%0A%20%20%20%20opacity%3A0.75%3B%0A%20%20%7D%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%7B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20box-shadow%3A%200%200%200%202px%20rgba%28255%2C%20255%2C%20255%2C%200%29%3B%0A%20%20-webkit-transition%3A%20box-shadow%200.3s%20ease%3B%0A%20%20transition%3A%20box-shadow%200.3s%20ease%3B%0A%20%20background%3Atransparent%3B%0A%20%20width%3A15px%3B%0A%20%20height%3A15px%3B%0A%7D%0A%23rev_slider_1_1%20.uranus%20.tp-bullet.selected%2C%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%3Ahover%20%7B%0A%20%20box-shadow%3A%200%200%200%202px%20rgba%28255%2C%20255%2C%20255%2C1%29%3B%0A%20%20border%3Anone%3B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20background%3Atransparent%3B%0A%7D%0A%0A%23rev_slider_1_1%20.uranus%20.tp-bullet-inner%20%7B%0A%20%20-webkit-transition%3A%20background-color%200.3s%20ease%2C%20-webkit-transform%200.3s%20ease%3B%0A%20%20transition%3A%20background-color%200.3s%20ease%2C%20transform%200.3s%20ease%3B%0A%20%20top%3A%200%3B%0A%20%20left%3A%200%3B%0A%20%20width%3A%20100%25%3B%0A%20%20height%3A%20100%25%3B%0A%20%20outline%3A%20none%3B%0A%20%20border-radius%3A%2050%25%3B%0A%20%20background-color%3A%20rgb%28255%2C%20255%2C%20255%29%3B%0A%20%20background-color%3A%20rgba%28255%2C%20255%2C%20255%2C%200.3%29%3B%0A%20%20text-indent%3A%20-999em%3B%0A%20%20cursor%3A%20pointer%3B%0A%20%20position%3A%20absolute%3B%0A%7D%0A%0A%23rev_slider_1_1%20.uranus%20.tp-bullet.selected%20.tp-bullet-inner%2C%0A%23rev_slider_1_1%20.uranus%20.tp-bullet%3Ahover%20.tp-bullet-inner%7B%0A%20transform%3A%20scale%280.4%29%3B%0A%20-webkit-transform%3A%20scale%280.4%29%3B%0A%20background-color%3Argb%28255%2C%20255%2C%20255%29%3B%0A%7D%0A");
	    var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
	    if (htmlDiv) {
	        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
	    } else {
	        var htmlDiv = document.createElement('div');
	        htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
	        document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
	    } /*]]>*/
	</script>

    <!-- Include Swiper.js -->
     <!-- small slider script --->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Fetch image data from PHP
    const slides = <?php echo $slides_json; ?>;

    const sliderContainer = document.getElementById("sliderContainer");

    // Generate slides dynamically
    slides.forEach(slide => {
        const slideElement = document.createElement("div");
        slideElement.classList.add("swiper-slide");
        slideElement.innerHTML = `
            <div class="gdlr-core-image-item">
                <img src="./admin/uploads/${slide.image_path}" alt="${slide.title}" style="width:90%; height:auto; border-radius:10px;">
                <h5 style="text-align:center; margin-top:10px;">${slide.title}</h5>
            </div>
        `;
        sliderContainer.appendChild(slideElement);
    });

    // Initialize Swiper.js slider
    new Swiper(".swiper-container", {
        loop: true,
        autoplay: { delay: 3000 },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
});
</script>

<!-- large slider script --->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const slides = <?php echo $slides_json1; ?>;
    const sliderContainer = document.getElementById("sliderContainer1");

    slides.forEach(slide => {
    const slideElement = document.createElement("div");
    slideElement.classList.add("swiper-slide");
    slideElement.innerHTML = `
        <div class="slider-image-container">
            <img src="./admin/uploads/${slide.image_path}" alt="${slide.title}" class="slider-img">
            <div class="slider-description">${slide.description}</div>
            <h3 class="slider-title">${slide.title}</h3>
        </div>
    `;
    sliderContainer.appendChild(slideElement);
});


    new Swiper(".swiper-container", {
        loop: true,
        autoplay: { delay: 3000 },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
});
</script>


</body>
</html>