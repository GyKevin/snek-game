<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>snekgame</title>
    <script src="/snek-game/node_modules/jquery/dist/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/snek-game/common_style/fonts.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/snake1.css">
    <link rel="stylesheet" href="styles/snake2.css">
    <script src="snekScript/game.js" defer type="module"></script>

</head>
<?php
$userID = null;
if (isset($_COOKIE['userid'])) {
    $userID = $_COOKIE["userid"];
}
if (isset($_POST["logout"])) {
    unset($_COOKIE['userid']);
    setcookie('userid', null, -1, "/");
    header("Location: index.php");
}
if ($userID === null) {
    //do nothing
} else {
    // session_start();
    $dbc = require "./../database/db.php";
    $res_image = $dbc->query("SELECT * FROM  `profile-images` WHERE `user_iduser` = $userID");
    $image_result = $res_image->fetch_assoc();
    $pfpicture = $image_result['image'];

    $res = $dbc->query("SELECT * FROM  `user` WHERE `iduser` = $userID");
    $row = $res->fetch_assoc();
    $username = $row['username'];

    $res_score = $dbc->query("SELECT * FROM  `scores` WHERE `iduser` = $userID");
    $row_score = $res_score->fetch_assoc();
    $highscore = $res_score['scores']
};
?>

<body>
    <div id="wrapper">
        <div class="header">
            <div class="inner_header">
                <!-- <div>
                    <svg width="350" height="70" viewBox="50% 50% 350 80" class="logo">
                        <defs id="SvgjsDefs1183">
                            <linearGradient id="SvgjsLinearGradient1188">
                                <stop id="SvgjsStop1189" stop-color="#fbb040" offset="0"></stop>
                                <stop id="SvgjsStop1190" stop-color="#f9ed32" offset="1"></stop>
                            </linearGradient>
                        </defs>
                        <g id="SvgjsG1184" featurekey="tOsHRK-0"
                            transform="matrix(0.5023358561098838,0,0,0.5023358561098838,-10.493795727534,-1.0046717122197677)"
                            fill="url(#SvgjsLinearGradient1188)">
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M62.653,97.752H37.887l-6.651-12.998V61.933L19.721,50.247V25.799l4.909-9.368H13.742V0.103l15.239,7.663  v5.382l42.778-0.095V7.663L87,0v16.33H76.108l4.945,9.471v24.458L69.268,61.944v22.807L62.653,97.752z M39.894,94.473h20.747  l4.312-8.475H35.558L39.894,94.473z M34.517,82.718h31.47V68.172l-2.67,5.307l-2.929-1.475l4.578-9.103h-8.237l-6.344,6.44  l-6.307-6.44h-8.49l4.756,9.079l-2.905,1.521l-2.921-5.575V82.718z M34.517,59.623h10.94l4.936,5.038l4.963-5.038h10.631V24.562  h10.722l-4.299-8.231l-44.076,0.1l-4.256,8.122l10.439-0.031V59.623z M69.268,39.394v17.934l8.507-8.437v-9.497H69.268z   M23.002,48.902l8.234,8.356v-17.87l-8.234-0.023V48.902z M69.268,36.113h8.507v-8.271h-8.507V36.113z M23.002,36.085l8.234,0.024  v-8.295l-8.234,0.025V36.085z M17.022,13.152h8.679V9.787l-8.679-4.363V13.152z M75.041,13.049h8.679V5.321l-8.679,4.364V13.049z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M67.344,98.334H55.887v-3.312h3.326l-5.066-15.948l3.862-11.865l-8.113,8.208l-7.747-7.655l3.75,11.317  l-5.283,15.943h3.538v3.312H32.489v-3.312h4.637l5.283-15.943l-5.45-16.445l-0.121-0.118H36.63V62.31l-5.797-5.729V43.218  l5.797-6.104V13.868L50.339,0l12.794,13.902v23.155L69,42.991v13.095l-5.81,5.907l-5.564,17.092l5.063,15.937h4.654V98.334z   M39.943,60.925l9.924,9.808l10.08-10.199l-0.079-6.75l-9.53,10.061L39.943,53.627V60.925z M39.943,48.982l10.311,10.134l9.567-10.1  V27.729H39.943V48.982z M34.146,55.196l2.485,2.455V41.924l-2.485,2.616V55.196z M63.134,49.667l0.088,7.554l2.466-2.495V44.353  l-2.554-2.583V49.667z M45.486,24.416h8.691l-4.302-2.447L45.486,24.416z M56.146,21.724l3.675,2.089v-2.089H56.146z M39.943,21.724  v1.99l3.568-1.99H39.943z M49.89,18.167l4.34,2.468V9.12l-3.978-4.32L45.81,9.294v11.147L49.89,18.167z M57.543,18.411h2.278v-3.217  l-2.278-2.474V18.411z M39.943,18.411h2.554v-5.766l-2.554,2.584V18.411z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M79.359,98H56.263v-3.279h23.097V98z M44.646,98H21.138v-3.279h23.508V98z M68.28,86.246h-35.85  L19.498,73.683V49.139L31.45,37.324l-0.205-22.943L43.955,1.375h13.006l12.496,13.014l-0.206,22.944L81,49.147v24.526L68.28,86.246z   M33.762,82.967h33.169l4.928-4.87v-33.49l-4.693-4.72l-16.814,5.725l-16.824-5.728l-4.788,4.731v33.473L33.762,82.967z   M22.778,72.297l2.682,2.604V47.857l-2.682,2.651V72.297z M75.139,47.906v26.949l2.581-2.549V50.5L75.139,47.906z M36.784,37.527  l13.567,4.619l13.603-4.632l-13.441-9.087L36.784,37.527z M34.65,28.298l0.059,6.669l10.061-6.669H34.65z M56.179,28.298  l9.814,6.636l0.059-6.636H56.179z M36.787,13.403h9.498v13.89l4.246-2.813l4.092,2.766V13.403h9.34l-8.4-8.748H45.335L36.787,13.403  z M57.902,25.018h8.179l0.075-8.335h-8.254V25.018z M34.621,25.018h8.384v-8.335h-8.459L34.621,25.018z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M68.306,98H32.129L7.786,73.731V25.512l12.242-13.139h25.149l5.202,5.504l5.081-5.504h24.724L93,25.489  v48.25L68.306,98z M34.467,94.69h31.506v-3.157l-15.586-5.3l-15.92,5.307V94.69z M69.283,91.039V92.4l20.407-20.05V26.837  L78.791,15.683H56.909l-6.502,7.042l-6.656-7.042H21.468L11.095,26.814v45.543l20.063,20.002v-1.298l-6.205-5.86V59.996l9.423-3.154  H19.093V41.949h15.375v14.862l6.988-2.34l-0.951-0.939h19.776l-0.95,0.939l6.54,2.189V41.949h15.374v14.893H66.41l8.803,2.946V85.18  L69.283,91.039z M28.262,83.774l4.966,4.69l15.51-5.169V61.67l-4.645-4.591l-15.831,5.298V83.774z M52.048,83.303l15.146,5.149  l4.71-4.655V62.169l-15.211-5.09l-4.645,4.591V83.303z M48.561,56.842l1.833,1.81l1.832-1.81H48.561z M69.181,53.532h8.755v-8.274  h-8.755V53.532z M22.402,53.532h8.756v-8.274h-8.756V53.532z M90.162,15.461L78.304,3.326l2.367-2.312l11.858,12.135L90.162,15.461z   M10.639,15.169l-2.396-2.283L19.55,1.028l2.395,2.284L10.639,15.169z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M70.034,97.649H29.229l-14.072-27.5v-12.53L2.637,44.563v-28.68h14.01L49.825,3l32.561,12.884H97v28.669  L83.869,58.523v11.619L70.034,97.649z M32.183,93.985h34.89v-9.467h-34.89V93.985z M18.822,69.266l9.696,18.948V57.323  l-6.643-13.058v-14.41l14.532-14.364l13.217,6.589l13.133-6.586l14.774,14.352v14.428l-6.795,13.057v30.766l9.467-18.823V18.961  L49.812,6.937L18.822,18.97V69.266z M32.183,80.854h34.89V58.202l-17.556-5.875l-17.334,5.869V80.854z M49.51,48.46l18.493,6.188  l5.864-11.271V31.395L62.073,19.938l-12.443,6.24L37.119,19.94L25.541,31.386v12l5.724,11.252L49.51,48.46z M83.869,19.548v33.624  l9.467-10.071V19.548H83.869z M6.301,43.09l8.856,9.234V19.548H6.301V43.09z M41.938,70.985l-6.451-6.644l2.629-2.554l6.451,6.644  L41.938,70.985z M57.568,70.96l-2.674-2.505l6.222-6.643l2.675,2.506L57.568,70.96z M45.085,45.658H28.518v-16.87h16.567V45.658z   M32.183,41.994h9.238v-9.542h-9.238V41.994z M70.737,45.602H54.17V28.731h16.567V45.602z M57.835,41.937h9.237v-9.541h-9.237  V41.937z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg" display="none"
                                d="M67.465,97.047H31.747L19.285,84.4V26.588L7.772,14.681V1h13.425l12.486,11.966l14.58,0.116l1.396-8.393  l1.409,8.414l14.971,0.118L77.718,1h14.01v14.558L80.045,26.629v56.228L67.465,97.047z M33.111,93.787h32.888l10.786-12.166V26.629  l-8.423-7.982v28.881h6.127v14.878H59.683V50.79h-3.218l-6.804,13.65l-6.764-13.65h-3.2v11.617H24.89V47.528h5.909V18.053  l-8.253,8.535v56.477L33.111,93.787z M62.942,59.146h8.287V50.79h-8.287V59.146z M28.15,59.146h8.287V50.79H28.15V59.146z   M45.603,48.907l4.066,8.207l4.09-8.208l-4.09-24.422L45.603,48.907z M59.683,47.528h5.419V16.474l-13.485-0.106l5.22,31.161H59.683  z M39.697,47.528h2.83l5.194-31.19L34.06,16.229v31.299H39.697z M69.04,14.799l9.375,8.882l10.053-9.526V4.261h-9.355L69.04,14.799z   M11.033,13.363l9.883,10.221l9.203-9.518L19.887,4.261h-8.854V13.363z M57.086,77.891h-3.26v-5.705h3.26V77.891z M45.539,77.891  h-3.26v-5.705h3.26V77.891z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="M50.953,97.146L32.553,83.629l0.163-45.12L20.89,26.82V13.992L33.457,2h34.794l12.36,12v12.542L69.253,38.102v45.527  L50.953,97.146z M35.744,82.021l15.204,11.168l15.12-11.168V41.343l-7.885,8.025v28.317l-7.381-14.261l-7.084,14.687V49.382  l-7.827-7.736L35.744,82.021z M52.372,59.532l2.625,5.07V38.96h-2.466L52.372,59.532z M46.902,52.53v11.646l2.286-4.739  l0.158-20.478h-2.444V52.53z M30.555,31.894l13.162,13.01V38.36L30.555,31.894z M58.183,38.342v6.481l12.81-13.037L58.183,38.342z   M46.902,35.775h8.095V25.221l16.22-15.903L66.96,5.186H34.732l-3.839,3.663l16.009,16.392V35.775z M24.075,25.163l19.642,9.648  v-8.273l-4.394-4.499H27.036v-9.51l-2.961,2.825V25.163z M58.183,26.559v8.205l19.244-9.848v-9.568l-2.337-2.269v8.961H62.792  L58.183,26.559z M66.041,18.854h5.863v-5.749L66.041,18.854z M30.221,18.854h5.991l-5.991-6.134V18.854z">
                            </path>
                        </g>
                        <g id="SvgjsG1185" featurekey="dVtZHI-0"
                            transform="matrix(1.448015949033091,0,0,1.448015949033091,49.97106957137084,6.860412707524243)"
                            fill="#ffffff">
                            <path
                                d="M2.08 11.02 l1.78 1.66 c0.56 0.52 1 1.0767 1.32 1.67 s0.48 1.19 0.48 1.79 l0 0.26 c0.01334 0.42666 -0.04 0.80666 -0.16 1.14 l0.74 0 c0.10666 -0.36 0.15332 -0.73334 0.13998 -1.12 l0 -0.28 c0 -0.72 -0.18334 -1.4067 -0.55 -2.06 s-0.87666 -1.2933 -1.53 -1.92 l-1.72 -1.62 c-0.54666 -0.52 -0.99666 -1.0067 -1.35 -1.46 s-0.53 -1.02 -0.53 -1.7 l0 -0.12 c0 -0.70666 0.19666 -1.2767 0.59 -1.71 s0.94334 -0.65 1.65 -0.65 c0.50666 0 0.92 0.07666 1.24 0.23 s0.64666 0.38334 0.98 0.69 l0.46 -0.52 c-0.37334 -0.34666 -0.75668 -0.60666 -1.15 -0.78 s-0.90334 -0.26 -1.53 -0.26 c-0.81334 0 -1.5033 0.26334 -2.07 0.79 s-0.85 1.2567 -0.85 2.19 l0 0.16 c0 0.76 0.19 1.41 0.57 1.95 s0.87666 1.0967 1.49 1.67 z M5.96 18.3 l-0.82002 0 c-0.46666 0.68 -1.2133 1.0267 -2.24 1.04 c-0.34666 0 -0.66 -0.04 -0.94 -0.12 l0 0.7 c0.28 0.05334 0.59334 0.08 0.94 0.08 c0.72 0 1.34 -0.14666 1.86 -0.44 s0.92 -0.71334 1.2 -1.26 z M15.96 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M10.34 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M19.76 14.16 l0 -9.36 l4.8 0 l0 -0.56 l-5.36 0 l0 9.92 l0.56 0 z M24.76 20 l0 -0.54 l-5 0 l0 -4.14 l0.8 0 l0 -0.54 l-1.36 0 l0 5.22 l5.56 0 z M29.92 13.36 l3.96 6.64 l0.78 0 l-4.34 -7.28 z M30.000000000000004 12.14 l4.48 -7.84 l-0.8 0 l-5.64 9.94 l0 -9.98 l-0.68 0 l0 11.24 l0.68 0 l0 -0.02 l1.54 -2.68 z M49.260000000000005 20 c2.2134 0 4.1 -0.78 5.66 -2.34 c0.77334 -0.76 1.3567 -1.58 1.75 -2.46 s0.59 -1.88 0.59 -3 c0 -2.2266 -0.78 -4.1066 -2.34 -5.64 c-1.56 -1.52 -3.4866 -2.2866 -5.78 -2.3 c-1.4133 0.01334 -2.74 0.36668 -3.98 1.06 c-1.2133 0.70666 -2.18 1.6867 -2.9 2.94 l0.58 0.32 c0.65334 -1.16 1.54 -2.06 2.66 -2.7 c1.1067 -0.64 2.32 -0.96666 3.64 -0.98 c2.1334 0.01334 3.9066 0.72668 5.32 2.14 c1.4133 1.3867 2.1266 3.1066 2.14 5.16 c0 1.0267 -0.18 1.9433 -0.54 2.75 s-0.88666 1.5633 -1.58 2.27 c-1.4267 1.4267 -3.1666 2.14 -5.22 2.14 c-1.28 0 -2.44 -0.27334 -3.48 -0.82 l-0.3 0.58 c1.1333 0.58666 2.3934 0.88 3.78 0.88 z M66.84 4.58 l-0.000019531 11.56 c0 0.36 0.0066602 0.76 0.02 1.2 s0.02 0.66666 0.02 0.68 c-0.02666 -0.04 -0.12332 -0.25666 -0.28998 -0.65 s-0.33 -0.74334 -0.49 -1.05 l-0.28 -0.54 l-0.72 0 l2.2 4.22 l0.18 0 l0 -15.42 l-0.64 0 z M61.220000000000006 7.9399999999999995 l0.27998 0.54 l0.72 0 l-2.22 -4.24 l-0.14 0 l0 15.46 l0.62 0 l0 -11.6 c0 -0.33334 -0.0066602 -0.72334 -0.02 -1.17 s-0.02 -0.67666 -0.02 -0.69 c0.01334 0.04 0.10668 0.26 0.28002 0.66 s0.34 0.74666 0.5 1.04 z M82.02000000000001 19.96 l0.039942 -0.63998 c-1.96 -0.13334 -3.52 -0.94668 -4.68 -2.44 c-1.1067 -1.3867 -1.66 -3.06 -1.66 -5.02 c0 -1.0267 0.16666 -1.9167 0.5 -2.67 s0.83334 -1.4833 1.5 -2.19 c1.3333 -1.4 3 -2.1 5 -2.1 c1.2133 0 2.3066 0.26 3.28 0.78 s1.7667 1.2467 2.38 2.18 l0.48 -0.38 c-0.66666 -1.0133 -1.5333 -1.8067 -2.6 -2.38 c-1.0133 -0.54666 -2.16 -0.81332 -3.44 -0.79998 c-1.08 0 -2.0934 0.18334 -3.04 0.55 s-1.78 0.93 -2.5 1.69 c-0.72 0.77334 -1.2633 1.5733 -1.63 2.4 s-0.55 1.8 -0.55 2.92 c0.01334 2.12 0.62 3.9334 1.82 5.44 c1.28 1.6133 2.98 2.5 5.1 2.66 z M83.24000000000001 19.98002 c1.0933 -0.06666 2.0934 -0.32664 3 -0.77998 c1.04 -0.53334 1.9133 -1.2867 2.62 -2.26 l-0.46 -0.4 c-0.64 0.88 -1.4467 1.5733 -2.42 2.08 c-0.84 0.42666 -1.76 0.66666 -2.76 0.72 z M95.86000000000001 15.219999999999999 c0.85334 -0.48 1.5067 -1.1567 1.96 -2.03 s0.68 -1.8633 0.68 -2.97 l0 -0.28 c0 -1.64 -0.49 -3 -1.47 -4.08 s-2.3766 -1.62 -4.19 -1.62 l-1.38 0 l0 6.34 c0.22666 0.01334 0.45332 0.02 0.67998 0.02 l0 -5.72 l0.66 0 c1.64 0 2.88 0.47666 3.72 1.43 s1.26 2.1766 1.26 3.67 l0 0.22 c0 1.48 -0.42 2.6934 -1.26 3.64 s-2.08 1.42 -3.72 1.42 l-0.66 0 l0 0 l-0.68 0 l0 0.64 c0.4 0.01334 0.66666 0.02 0.8 0.02 l0.58 0 c0.92 0 1.7267 -0.14 2.42 -0.42 l2.48 4.5 l0.8 0 z M106.48000000000002 6.140000000000001 c0 0.08 0.23666 0.84334 0.71 2.29 s0.99 3.03 1.55 4.75 s1.3133 3.9934 2.26 6.82 l0.86 0 l-5.3 -15.76 l-0.16 0 l-5.26 15.76 l0.82 0 z M106.12000000000002 15.52 l-0.72 0 l1.2 4.48 l0.72 0 z M121.4 19.96 l0.039942 -0.63998 c-1.96 -0.13334 -3.52 -0.94668 -4.68 -2.44 c-1.1067 -1.3867 -1.66 -3.06 -1.66 -5.02 c0 -1.0267 0.16666 -1.9167 0.5 -2.67 s0.83334 -1.4833 1.5 -2.19 c1.3333 -1.4 3 -2.1 5 -2.1 c1.2133 0 2.3066 0.26 3.28 0.78 s1.7667 1.2467 2.38 2.18 l0.48 -0.38 c-0.66666 -1.0133 -1.5333 -1.8067 -2.6 -2.38 c-1.0133 -0.54666 -2.16 -0.81332 -3.44 -0.79998 c-1.08 0 -2.0934 0.18334 -3.04 0.55 s-1.78 0.93 -2.5 1.69 c-0.72 0.77334 -1.2633 1.5733 -1.63 2.4 s-0.55 1.8 -0.55 2.92 c0.01334 2.12 0.62 3.9334 1.82 5.44 c1.28 1.6133 2.98 2.5 5.1 2.66 z M122.62 19.98002 c1.0933 -0.06666 2.0934 -0.32664 3 -0.77998 c1.04 -0.53334 1.9133 -1.2867 2.62 -2.26 l-0.46 -0.4 c-0.64 0.88 -1.4467 1.5733 -2.42 2.08 c-0.84 0.42666 -1.76 0.66666 -2.76 0.72 z M133.4 13.36 l3.96 6.64 l0.78 0 l-4.34 -7.28 z M133.48 12.14 l4.48 -7.84 l-0.8 0 l-5.64 9.94 l0 -9.98 l-0.68 0 l0 11.24 l0.68 0 l0 -0.02 l1.54 -2.68 z">
                            </path>
                        </g>
                    </svg>
                </div> -->

                <h3>Snek on crack</h3>
                <button id="hamburger" class="hamburger">
                    <span class="burger"></span>
                    <span class="burger"></span>
                    <span class="burger"></span>
                </button>
            </div>
        </div>
        <div class="wrapper2">
            <div class="content">
                <div class="flex">
                    <nav>
                        <ul id="links" class="navigation">
                            <?php if ($pfpicture !== null) {
                                echo "<li><a href=\"/snek-game/accountSystem/userinfo/userinfo.php\"><img src=\"./../$pfpicture\" alt=\"Avatar\" class=\"avatar\"><h1>Welcome $username</h1></a></li>";
                            }; ?>
                            <li><a href="/snek-game/index.php">Home</a></li>
                            <li><a href="/snek-game/docs/gamemode.php">Gamemodes</a></li>
                            <li><a href="leaderboards/leadpage.php">Leaderboard</a></li>
                            <li><a>High Score: <?php echo $highscore;?></a></li>
                            <?php
                            if ($userID !== null) {
                                echo "<li><form action=\"gamemode.php\" method=\"post\" id=\"logout\"><input type=\"hidden\" name=\"logout\" value=\"Gamemodes\"><a href=\"javascript:{}\" onclick=\"document.getElementById('logout').submit(); return false;\">Logout</a></form></li>";
                            } else {
                                echo "<li><a href=\"/snek-game/accountSystem\login\index.php\">Login</a></li>";
                            }
                            ?>
                            <!-- <li><a href="#0">placeholde</a></li>
                            <li><a href="./../contact.php">Our Team</a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="game-board" class="game-board"></div>
        </div>
        <div class="wrapper-footer">
            <footer>
                <div id="footer">
                    <div id="controls">Blue = W,A,S,D & Red = Up,Down,Left,Right </div>

                    <div id="scores">

                    </div>
                </div>
                <!-- <button onclick="">Multiplayer</button> -->
            </footer>
        </div>

</body>

</html>