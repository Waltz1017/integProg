
<form action= "pallete.php" method = "POST"> 
    <label >QUIT NA AKO SIR</label>
    <input type="text" name="bgcolor" placeholder= "Enter Color"><br><br>
    <input type="submit" value="submit"><br><br>
</form>

<?php
$backcolor = $_POST["bgcolor"];
$apiKey = "";
$url = "https://colormagic.app/api/palette/search?q=$backcolor";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode([
        "error" => "API not responding: " . curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

$httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode != 200) {
    echo json_encode([
        "error" => "API returned status code: " . $httpCode
    ]);
    exit;
}

$data = json_decode($response, true);

$c1 = $data[0]["colors"][0];
$c2 = $data[0]["colors"][1];
$c3 = $data[0]["colors"][2];
$c4 = $data[0]["colors"][3];
$c5 = $data[0]["colors"][4];

?>
<div style="
    width: 100%;
    height: 100px;
    background-color: <?php echo $c1;?>;
    border: 1px;
    <?php echo $c1 = $data[0]["colors"][0] ?>
"></div>

<div style="
    width: 100%;
    height: 100px;
    background-color: <?php echo $c2;?>;
    border: 1px;

"></div>

<div style="
    width: 100%;
    height: 100px;
    background-color: <?php echo $c3;?>;
    border: 1px;

"></div>

<div style="
    width: 100%;
    height: 100px;
    background-color: <?php echo $c4;?>;
    border: 1px;

"></div>

<div style="
    width: 100%;
    height: 100px;
    background-color: <?php echo $c5;?>;
    border: 1px;

"></div>
