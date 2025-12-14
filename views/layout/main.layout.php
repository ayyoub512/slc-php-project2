<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ayyoub Ouakkaha">
    <meta name="generator" content="">
    <title><?= $title ?></title>
    <script src="public/js/tailwindcss.js"></script>
    <!-- <link rel="stylesheet" href="public/css/main.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" /> -->

</head>

<body class="flex flex-col min-h-screen bg-white text-gray-600">

    <main class="flex-1 flex flex-col">
        <?= $content ?>
    </main>

    <!-- I am doing jQuery because I think it will be nice to have some interactivity in the front
        For the form validation instead of relying on the backend soleley.  
    -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="public/js/main.js"></script>

</body>

</html>