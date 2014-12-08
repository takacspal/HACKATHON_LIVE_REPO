<?php

$eula = <<<EOT
    {h1}End-User License Agreement for TheTwoPeas Web Application{/h1}
===
    This End-User License Agreement (EULA) is a legal agreement between you (either an individual or a single entity) and the mentioned author (TheTwoPeas) of this Software for the software product identified above, which includes source code, associated media, printed materials, and online or electronic documentation ("web application").
    By using the web application, you agree to be bounded by the terms of this EULA.
    If you do not agree to the terms of this EULA, do not use the web application.
===
    {h2}WEB APPLICATION LICENSE{/h2}
        ===
    TheTwoPeas Web Application is being distributed as free use for personal, non-profit organization, educational purpose. You are NOT allowed to make a charge for distributing this web application (either, for profit or merely to recover your media and distribution costs) whether as a stand-alone product, or as part of a compilation or anthology, nor to use it for supporting your business or customers. It may be distributed freely on any website or through any other distribution mechanism, as long as no part of it is changed in any way.
===
    {h2}DESCRIPTION OF OTHER RIGHTS AND LIMITATIONS.{/h2}
        ===
    Limitations on change (add,delete or modify) the resources in the web application.
===
    {h2}COPYRIGHT{/h2}
        ===
    All title and copyrights in and to the web application (including but not limited to any images, photographs, clipart, libraries, and examples incorporated into the web application), the accompanying printed materials, and any copies of the web application are owned by the Author of this Software. The web application is protected by copyright laws and international treaty provisions. Therefore, you must treat the web application like any other copyrighted material.
===
    {h2}NO WARRANTIES{/h2}
        ===
    The Author of this Software expressly disclaims any warranty for the web application. The web application and any related documentation is provided "as is" without warranty of any kind, either express or implied, including, without limitation, the implied warranties or merchantability, fitness for a particular purpose, or noninfringement. The entire risk arising out of use or performance of the web application remains with you.
===
    {h2}NO LIABILITY FOR DAMAGES{/h2}
        ===
    In no event shall the author of this Software be liable for any special, consequential, incidental or indirect damages whatsoever (including, without limitation, damages for loss of business profits, business interruption, loss of business information, or any other pecuniary loss) arising out of the use of or inability to use this product, even if the Author of this Software is aware of the possibility of such damages and known defects.
EOT;

$paragraphs = explode("===", $eula);
$generated = "";
$shortenThese = array();
$errors = array();

function replaceToTag($match) {
    $tag = $match[1];
    return "<" . $tag . ">";
}

foreach ($paragraphs as &$paragraph) {
    $paragraph = trim($paragraph);
    //$paragraphStripped = strip_tags($paragraph);
    //
    //$pParts = preg_split('/(?<=[.?!,(?:###)])\s+(?=[a-z])/i', $paragraphStripped);
    $pParts = preg_split('/(?<=[.?!,(?:###)])\s+(?=[a-z])/i', $paragraph);
    //
    foreach ($pParts as $i => &$pPart) {
        $pPartParsed = preg_replace("/\{.+?\}/", "", $pPart);
        $pPartParsed = preg_replace("/[^\w\s]+/", "", $pPartParsed);
        if (mb_strlen($pPartParsed) > 98) {
            $shortenThese[] = $pPartParsed;
        }
        $checksum = md5($pPartParsed);

        if (!empty($_GET["parsegoogle"])) {
            $url = "http://translate.google.com/translate_tts?ie=UTF-8&q=";
            $url.=urlencode($pPartParsed);
            $url.="&tl=en-us";
            $content = file_get_contents($url);
            if ($content) {
                file_put_contents("speech/" . $checksum . ".mp3", $content);
            } else {
                $errors[] = $url;
            }
        }

        $pPart = preg_replace_callback("/{(.+?)\}/", "replaceToTag", $pPart);
        $generated.="<span data-checksum='" . $checksum . "' data-length='" . mb_strlen($pPartParsed) . "' class='part'>" . $pPart . "</span> ";
        $pPart = $pPartParsed;
        //http://translate.google.com/translate_tts?ie=UTF-8&q=All%20title%20and%20copyrights%20in%20and%20to%20the%20web%20application%20including%20but%20not%20limited%20to%20any%20images&tl=en-us
    }

    $generated.=PHP_EOL;
    //echo "<hr />";
    //var_dump($paragraph);
    //echo "<hr />";
}

var_dump($errors);
echo "<hr />";

file_put_contents("eula.html", $generated);
echo $generated;
//var_dump($shortenThese);
