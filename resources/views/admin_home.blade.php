<!DOCTYPE html>
<html>

<head>

    <title>Home</title>
    @auth
        @if (Auth::user()->role == 'ADMIN')
            @include('layouts/admin_navbar')
        @elseif (Auth::user()->role == 'GURU')
            @include('layouts/guru_navbar')
        @else
            {{-- Add the default behavior for other roles or unassigned roles --}}
            @include('layouts/admin_navbar')
        @endif
    @else
        {{-- Add the default behavior for non-authenticated users --}}
        @include('layouts/admin_navbar')
    @endauth
</head>

<body>
    <main>
        <div>
            <div style="display:block; width: 100%;">
                <div style="position: relative; color: white; font-size: 16px;">
                    <img src="{{ asset('images/home-admin.jpg') }}" style="width: 100%; height:650px; object-fit: cover;">
                </div>
            </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script></script>


<style>

</style>
