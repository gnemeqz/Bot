<?php

$link = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
if($link){
	echo "Database connected...<br/>";
}else{
	print pg_last_error($link);
}
$result = pg_query($link, "SELECT * FROM locat WHERE loc_id = 3");
if (!$result) {
    echo "An error occurred.\n";
    exit;
  }
  
while ($row = pg_fetch_assoc($result)) {
    echo $row['lat'].'  ';
    echo $row['lng'] .'  ' ;
    echo $row['loc_name'];
  }

// // $link = new mysqli("localhost", "id3526659_emaenggg", "123456", "id3526659_temptest"); 
//     $query = "SELECT * FROM Location"; 
//         $sth = mysqli_query($link,$query);
//         $rows = array();
//     while($rs = mysqli_fetch_array($sth)) { 
//         $rows = $rs['LOC_NAME'].' - ';
//         $rows = $rs['LAT'].' - ';
//         $rows = $rs['LNG'].' | ';
//     }
//     echo ($rows);
//     mysqli_close($link);

// $query = "SELECT * FROM Carlist";
//     $sth = mysqli_query($link,$query);
//     $rows = array();
//     while($r = mysqli_fetch_array($sth)) {
//         $rows[] = $r;
//     }
//     echo json_encode($rows);
//     mysqli_close($link);

// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// include composer autoload
require_once './vendor/autoload.php';
 
// การตั้งเกี่ยวกับ bot
require_once 'bot_settings.php';
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
// use LINE\LINEBot\Event;
// use LINE\LINEBot\Event\BaseEvent;
// use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
 
// เชื่อมต่อกับ LINE Messaging API
$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));
 
// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');
 
// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
if(! is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $typeMessage = $events['events'][0]['message']['type'];
    $userMessage = $events['events'][0]['message']['text'];
    $userMessage = strtolower($userMessage);
    switch ($typeMessage){
        case 'text':
            switch ($userMessage) {
                case "a":
                    $textReplyMessage = "คุณพิมพ์ A";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                break;
                case "b":
                    $textReplyMessage = "คุณพิมพ์ B";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                break;
                case "p":
                    $picFullSize = 'https://emaeng.000webhostapp.com/images/1-31-1.jpg';
                    $picThumbnail = 'https://emaeng.000webhostapp.com/images/1-31-1.jpg';
                    $replyData = new ImageMessageBuilder($picFullSize,$picThumbnail);
                break;
                case "s1":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55"); 
                $result = pg_query($conn, "SELECT brand,gen,type FROM car"); 
                $outp = ""; 
                while($rs = pg_fetch_array($result)) { 
                    if ($outp != "[") {$outp .= " ";} 
                        $outp .= 'ยี่ห้อรถ :' . $rs["brand"] . ','; 
                        $outp .= 'รุ่นของรถ :' . $rs["gen"] . ','; 
                        $outp .= 'ประเภทรถ :'.  $rs["type"] . '  '; } 
                        $outp .=""; 
                    echo($outp); 
                    pg_close($conn);

                    $textReplyMessage = "ค่าที่ได้";
                    $replyData = new TextMessageBuilder($textReplyMessage,$outp);
                    mysqli_close($link);
                break;
                case "brand":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
                $result = pg_query($conn, "SELECT brand FROM car"); 
                    $outp = ""; 
                while($rs = pg_fetch_array($result)) { 
                    if ($outp != "[") {$outp .= " ";} 
                        $outp .= 'ยี่ห้อรถ  : ' . $rs["brand"] . ' ';} 
                        $outp .=""; 

                    echo($outp); 

                    $dbdata = json_encode($outp);
                    $textReplyMessage = "ค่าที่ได้";
                    $replyData = new TextMessageBuilder($textReplyMessage,$outp);
                    mysqli_close($link);
                break;
                case "gen":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55"); 
                $result = pg_query($conn, "SELECT gen FROM car"); 
                $outp = ""; 
                while($rs = pg_fetch_array($result)) { 
                    if ($outp != "[") {$outp .= " ";} 
                        $outp .= 'รุ่นของรถ :' . $rs["gen"] . '  '; } 
                        $outp .=""; 
                    echo($outp); 
                    pg_close($conn);

                   
                    $textReplyMessage = "ค่าที่ได้";
                    $replyData = new TextMessageBuilder($textReplyMessage,$outp);
                    mysqli_close($link);
                break;
                case "ประเภท":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55"); 
                $result = pg_query($conn, "SELECT type FROM car"); 
                $outp = ""; 
                while($rs = pg_fetch_array($result)) { 
                    if ($outp != "[") {$outp .= " ";}
                        $outp .= 'ประเภทรถ :'.  $rs["type"] . '  '; } 
                        $outp .=""; 
                    echo($outp); 
                    pg_close($conn);

                    
                    $textReplyMessage = "ค่าที่ได้";
                    $replyData = new TextMessageBuilder($textReplyMessage,$outp);
                    
                break;
                case "mapnumber1":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='1'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;
                case "mapnumber2":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='2'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;
                case "mapnumber3":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='3'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;
                case "mapnumber4":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55"); 
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='4'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;
                case "mapnumber5":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55"); 
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='5'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;
                case "mapnumber6":
                $conn = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
                $result = pg_query($conn, "SELECT lat,lng FROM locat WHERE loc_id ='6'");
                
                while ($row = pg_fetch_assoc($result)) {
                $latitudee = $row['lat'];
                $longitudee = $row['lng'];}

                $lati = floatval($latitudee);
                $longti = floatval($longitudee);
                pg_close($conn);
               
                $placeName = "ตำแหน่งที่ตั้ง";
                $placeAddress = "ตำแหน่งที่ตั้ง";
                $latitude = $lati;
                $longitude = $longti;
                $replyData = new LocationMessageBuilder ($placeName,$placeAddress,$latitude,$longitude);
                
                break;

                case "maps" :
                $placeName = "ที่ตั้งร้าน";
                $placeAddress = "แขวง พลับพลา เขต วังทองหลาง กรุงเทพมหานคร ประเทศไทย";
                $latitude = 13.780401863217657;
                $longitude = 100.61141967773438;
                $replyData = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude); 
                break;
                case 'temp':
                    $actionBuilder = array (
                        new  MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber1'  
                       
                        ),
                    );
                    $actionBuilder1 = array (
                        new MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber2'
                        ),
                    );
                    $actionBuilder2 = array (
                        new MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber3'
                        ),
                    );
                    $actionBuilder3 = array (
                        new MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber4'
                        ),
                    );
                    $actionBuilder4 = array (
                        new MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber5'
                        ),
                    );
                    $actionBuilder5 = array (
                        new MessageTemplateActionBuilder (
                            'เลือก',
                            'MapNumber6'
                        ),
                    );

                    $actionBuilderUri = array (
                        new  UriTemplateActionBuilder(
                            'Url Template',
                            'http://www.eastinnovation.com'
                        ),
                    );
                    $replyData = new TemplateMessageBuilder('Carousel',
                        new CarouselTemplateBuilder(
                            array(
                                new CarouselColumnTemplateBuilder(
                                    '1.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng-bot.herokuapp.com/1-31.jpg',
                                    $actionBuilder
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '2.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng-bot.herokuapp.com/1-31.jpg',
                                    $actionBuilder1
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '3.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder2
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '4.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder3
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '5.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder4
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '6.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder5
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '7.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '8.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '9.รถคุณสุชาติ',
                                    'ทะเบียนรถ เช่น ฆช 8063 กทม.',
                                    'https://emaeng.000webhostapp.com/images/1-31.jpg',
                                    $actionBuilder
                                ),
                                new CarouselColumnTemplateBuilder(
                                    '10.Title Carousel',
                                    'Description Carousel',
                                    'https://emaeng.000webhostapp.com/images/1-31-1.jpg',
                                    $actionBuilderUri
                                ),
                            )
                        )
                    );
                    break;

                default:
                    $textReplyMessage = " คุณไม่ได้พิมพ์ตามเงื่อนไข";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                break;                                      
            }
            break;
        default:
            $textReplyMessage = "ข้อมูลไม่ถูกต้อง กรุณาลองใหม่";
            $replyData = new TextMessageBuilder($textReplyMessage);
            break;  
    }
}
// ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
 $textMessageBuilder = new TextMessageBuilder($replyData);
 
//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $bot->replyMessage($replyToken,$replyData);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
// JSON php

?>