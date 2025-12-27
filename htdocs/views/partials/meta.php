<?php
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<title>Wordrift | Word Guessing Game</title>
<meta name="Author" content="Wordrift"> 
<meta name="description" content="Wordrift is the fun word puzzle game that challenges your vocabulary and creativity.">
<meta name="keywords" content="writing, editing, collaboration, Wordrift">
<meta name="expires" content="never"> 
<meta name="language" content="EN"> 
<meta name="distribution" content="Global">  
<meta name="copyright" content="Wordrift"> 
<meta name="robots" content="index,follow,noodp,noydir, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

 <!-- canonical Link -->
<link rel="canonical" href="<?php echo htmlspecialchars($currentUrl); ?>">
<!-- start link -->
<link rel="image_src" href="https://wordrift.org/assets/images/large_logo.png">
<meta property="og:type" content="website">
<meta property="og:title" content="Wordrift | The Word Guessing Game">
<meta property="og:image" content="https://wordrift.org/assets/images/large_logo.png">
<meta property="og:description" content="Wordrift is the fun word puzzle game that challenges your vocabulary and creativity.">
<meta property="og:url" content="<?php echo htmlspecialchars($currentUrl); ?>">
<link href="https://wordrift.org/assets/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
<!-- Twitter Card -->

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@">
<meta name="twitter:title" content="Wordrift | The Word Guessing Game">
<meta name="twitter:description" content="Wordrift is the fun word puzzle game that challenges your vocabulary and creativity.">
<meta name="twitter:image" content="https://wordrift.org/assets/images/large_logo.png">

<!-- Fav Icons -->
<link rel="apple-touch-icon" sizes="180x180" href="https://wordrift.org/assets/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://wordrift.org/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://wordrift.org/assets/images/favicon-16x16.png">