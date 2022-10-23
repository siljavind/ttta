<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Talenthub Technical Test Assignment</title>

    <!--<link href="{{asset('css/app.css')}}" rel="stylesheet"/>-->
</head>

<body>
<div class="main-container">
    <div class="chart-container" title="such visuals">
        chart
    </div>

    <div class="cardlists" id="app">
        <card-list title="Strengths" subtitle="Your three best-performing questions"></card-list>
        <card-list title="Areas for improvement" subtitle="Your three worst-performing questions"></card-list>
    </div>
</div>

@vite('resources/js/app.js')
<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
</body>
</html>

<style>
    body {
        background-color: #F7F7F7;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
        padding: 30px;
        height: 100%;
        max-height: 100vh;
    }

    .chart-container {
        height: calc(40vh - 90px);
        background-color: white;
        padding: 30px;
        box-shadow: 0 0 15px #0000001F;

        display: flex;
        justify-content: center;
        align-items: center;

    }

    .cardlists {
        display: flex;
        gap: 30px;
        height: calc(60vh - 90px);
        min-height: max-content;
    }


</style>
