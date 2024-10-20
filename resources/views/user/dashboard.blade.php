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
        <x-usersidebar />
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
    <div class="bg-red-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-red-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">attach_money</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">{{$creditsamount}}</span>
        </div>
        <span class="text-sm">Total Credits</span>
    </div>
    
    <!-- Total Surveys -->
    <div class="bg-orange-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-orange-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">description</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">{{$completedCount}}</span>
        </div>
        <span class="text-sm">Total Surveys</span>
    </div>

    <!-- Active Survey Campaigns -->
    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-yellow-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">campaign</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">${{$totalWithdrawals}}</span>
        </div>
        <span class="text-sm">Total Withdrawn</span>
    </div>

    <!-- Total Responses -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-green-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">assignment_turned_in</span> <!-- Smaller icon size -->
            </div>
            <span class="text-4xl font-medium">{{$totalTransactions}}</span>
        </div>
        <span class="text-sm">Total Transactions</span>
    </div>
</div>
<h1>Total Withdrawals Over Time</h1>
    <canvas id="withdrawalsChart" width="400" height="200"></canvas>




            <!-- Charts Section -->


                <!-- Average Speed of Service -->

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            </div>

            <!-- Action Needed & Tasks Section -->
            

           
        
        
        </div>
        </div>
    </div>

    <!-- Chart.js Setup -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('withdrawalsChart').getContext('2d');
      const withdrawalsChart = new Chart(ctx, {
        type: 'line', // Use 'line' type for area chart
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // Modify this to your specific months or time frames
          datasets: [{
            label: 'Total Withdrawals',
            data: [150, 200, 300, 250, 400, 350, 500], // Example withdrawal amounts
            backgroundColor: 'rgba(0, 0, 255, 0.2)', // Area fill color
            borderColor: 'rgba(0, 20, 255, 1)', // Line color
            borderWidth: 1,
            fill: true, // Fill the area under the line
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true // Start y-axis at 0
            }
          },
          plugins: {
            legend: {
              display: true,
              position: 'top',
            },
            title: {
              display: true,
              text: 'Total Withdrawals Over Time' // Chart title
            }
          }
        }
      });
    </script>
</body>
</html>
