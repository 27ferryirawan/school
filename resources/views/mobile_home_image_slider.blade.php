<div class="slideshow">
    <div class="slides">
        <img src="{{ asset('images/Slide banner home.jpg') }}" alt="" class="pic">
        <img src="{{ asset('images/Slide banner home 2.jpg') }}" alt="" class="pic">
        <img src="{{ asset('images/Slide banner home 3.jpg') }}" alt="" class="pic">
    </div>
</div>
<style>
    .slideshow {
        width: 100%;
        overflow: hidden;
    }

    .slides {
        display: flex;
        height: 100%;
        animation: slide 10s infinite;
    }

    .slides img {
        width: 100%;
        height: auto;
        object-fit: cover;
        max-width: 100%;
    }

    @keyframes slide {
        0% {
            transform: translateX(0);
        }

        33.33% {
            transform: translateX(-100%);
        }

        66.67% {
            transform: translateX(-200%);
        }

        100% {
            transform: translateX(0);
        }
    }
</style>
