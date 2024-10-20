<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Include Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind setup -->
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
    </style>
</head>
<body class="bg-gray-100 font-sans">
<x-navbar />

    <!-- Main Container -->
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-100">
        @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Welcome {{ auth()->user()->name }}</h1>
                    <p class="text-gray-500">This month • October</p>
                </div>
                <!-- <div class="flex items-center space-x-4">
                    <button class="bg-gray-100 p-2 rounded-md text-gray-700">Groups (2 selected)</button>
                    <button class="bg-indigo-600 text-white p-2 px-4 rounded-md">Generate report</button>
                </div> -->
            </div>

            <!-- Rating Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Balance -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-green-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">attach_money</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">${{ $balance->balance ?? 0 }} </span>
        </div>
        <span class="text-sm">Total Balance</span>
    </div>
    
    <!-- Total Surveys -->
    <div class="bg-orange-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-orange-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">description</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">{{$totalSurveys}}</span>
        </div>
        <span class="text-sm">Total Surveys</span>
    </div>

    <!-- Active Survey Campaigns -->
    <div class="bg-red-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-red-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">campaign</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">5</span>
        </div>
        <span class="text-sm">Active Campaigns</span>
    </div>

    <!-- Total Responses -->
    <div class="bg-purple-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-purple-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">assignment_turned_in</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">{{$totalResponses}}</span>
        </div>
        <span class="text-sm">Total Responses</span>
    </div>
</div>




            <!-- Charts Section -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Average Scores Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-bold mb-4">Responses by Hour</h2>
        <canvas id="responsesByHourChart"></canvas>
    </div>

                <!-- Average Speed of Service -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="font-bold mb-4">Average speed of service</h2>
                    <canvas id="speedOfServiceChart"></canvas>
                </div>
            </div>

            <!-- Action Needed & Tasks Section -->
            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Action Needed -->
                <div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4"> <!-- Flex container for alignment -->
        <h2 class="font-bold">Active Surveys</h2>
        <a href="{{ route('business.viewsurvey') }}" class="text-blue-500 hover:underline">View All Surveys</a> <!-- Link to view all surveys -->
    </div>
    
    @foreach($surveys as $survey)
    @if($survey->status == 'active') <!-- Only show active surveys -->
        @php
            // Calculate responses count and percentage completed
            $responsesCount = $survey->responses()->count();
            $respondentLimit = $survey->respondent_limit;
            $percentageCompleted = $respondentLimit > 0 ? ($responsesCount / $respondentLimit) * 100 : 0;
        @endphp
        
        @if($percentageCompleted < 100) <!-- Show only if completion is less than 100% -->
            <div class="flex items-center mb-4">
                <span class="text-xs bg-green-100 text-green-600 p-1 rounded-md">
                    Active
                </span>
                <span class="ml-4 text-gray-600 flex-1">
                    {{ $survey->title }} 
                </span>
                <span class="ml-4 text-gray-500 text-sm">
                    {{ number_format($percentageCompleted, 2) }}% complete
                </span>
                
                <!-- Visual Representation (Progress Bar) -->
                <div class="w-32 bg-gray-200 rounded-full h-2 ml-4">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ number_format($percentageCompleted, 2) }}%;"></div>
                </div>
            </div>
        @endif
    @endif
@endforeach

</div>
















                

                <!-- Tasks -->
                <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="font-bold mb-4 flex items-center">
    <!-- Flashing green circle -->
    <span class="h-3 w-3 bg-green-500 rounded-full mr-2 animate-pulse"></span>
    <span class="animate-pulse">Live Responses</span> <!-- Add the animation here -->
</h2>

    @foreach($latestResponses as $response)
        <div class="flex items-center mb-4">
            <!-- Time ago (e.g., "2 hours ago") -->
            <span class="text-xs bg-yellow-100 text-yellow-600 p-1 rounded-md">
                {{ $response->timeAgo }}
            </span>

            <!-- Response information -->
            <span class="ml-4 text-gray-600 flex-1">
                <strong>{{ $response->survey->title }}</strong> 
                <span class="text-gray-500"> - Response by 
                    <span class="font-semibold">{{ $response->user->name }}</span> from 
                    <span class="font-semibold">{{ $response->city ?? 'N/A' }}</span>
                </span>
            </span>
            
            <!-- Display age and gender with icons -->
            <span class="ml-4 text-gray-500 flex items-center">
                @if($response->gender && $response->gender == 'male')
                    <span class="text-blue-500 mr-1">👨</span> <!-- Male Icon -->
                @elseif($response->gender == 'female')
                    <span class="text-pink-500 mr-1">👩</span> <!-- Female Icon -->
                @else
                    <span class="text-gray-500 mr-1">🔍</span> <!-- Unknown Gender Icon -->
                @endif
                <span>{{ $response->age }} years </span>
            </span>
        </div>
    @endforeach


    <!-- If there are no responses, show a message -->
    @if($latestResponses->isEmpty())
        <p class="text-gray-500">No responses yet.</p>
    @endif
</div>

            </div>
        </div>
    </div>

    <!-- Chart.js Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart 1: Average Scores
        const ctx = document.getElementById('responsesByHourChart').getContext('2d');
const responsesByHourChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [...Array(24).keys()], // 0 to 23 for hours of the day
        datasets: [{
            label: 'Responses by Hour',
            data: @json($responseData), // Dynamically passing the response data
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

        // Chart 2: Average Speed of Service
        const speedOfServiceCtx = document.getElementById('speedOfServiceChart').getContext('2d');
        new Chart(speedOfServiceCtx, {
            type: 'line',
            data: {
                labels: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: '2021',
                    data: [4, 3, 5, 4, 3],
                    borderColor: '#F59E0B',
                    backgroundColor: '#F59E0B',
                    fill: false,
                }, {
                    label: '2020',
                    data: [2, 4, 3, 5, 2],
                    borderColor: '#3B82F6',
                    backgroundColor: '#3B82F6',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    </script>
</body>
</html>
