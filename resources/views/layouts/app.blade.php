<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('/images/icon.png') }}" type="image/x-icon">
    <title>Memory Game</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: radial-gradient(ellipse at bottom, #1e0b25 0%, #280744 100%);
            background-repeat: no-repeat;
        }

        body {}

        .header {
            text-align: center;
            font-size: 30px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        @media(max-width:458px) {
            .header {
                margin-top: 40px;
            }
        }

        .header a {
            color: #fff;
            text-decoration: none;
        }

        #stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            background-color: transparent;
        }
    </style>
</head>

<body>
    <canvas id="stars"></canvas>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="/images/icon.png" alt="Logo.png" width="50px">
            </div>
            <div class="name">
                <h1><a href="{{ route('home') }}"> Memory Game </a></h1>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

<script>
    const canvas = document.getElementById('stars')
    const ctx = canvas.getContext('2d');

    let width, height;

    function resize() {
        width = window.innerWidth;
        height = document.documentElement.scrollHeight;

        canvas.width = width;
        canvas.height = height;
    }

    resize();
    window.addEventListener('resize', resize);

    const starsQuantity = 250;
    const stars = [];

    for (let i = 0; i < starsQuantity; i++) {
        stars.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 1.2 + 0.3,
            speed: Math.random() * 0.5 + 0.1,
        })
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        ctx.fillStyle = 'white';

        stars.forEach(star => {
            ctx.beginPath();
            ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
            ctx.fill();

            star.y += star.speed;

            if (star.y > height) {
                star.y = 0;
                star.x = Math.random() * width;
                star.radius = Math.random() * 1.2 + 0.3;
                star.speed = Math.random() * 0.5 + 0.1;
            }
        });

        requestAnimationFrame(animate);
    }

    animate();

</script>

</html>