<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Survey Results</title>

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
    <div class="flex-1 p-6 bg-gray-100">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold">Survey Results</h1>
                <p class="text-gray-500 mt-1">Overview of survey responses.</p>
            </div>
        </div>

        <!-- Error Message (if any) -->
        @if ($errors->any())
        <div class="bg-red-600 text-white p-6 rounded-lg mb-4 shadow-lg">
            <strong class="text-xl font-semibold">Error!</strong>
            <p class="mt-2 text-lg">Please check the following:</p>
            <ul class="list-disc pl-6 mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-lg">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Survey Results Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Results Overview</h2>

            @if(empty($results))
                <p class="text-gray-600">No responses available for this survey.</p>
            @else
                @foreach ($results as $questionId => $data)
                    <div class="mb-4 border-b pb-4">
                        <h3 class="text-lg font-semibold mb-2">Question: {{ $data['question_text'] }}</h3>
                        <p class="text-gray-600">Total Responses: {{ $data['response_count'] }}</p>

                        <div class="grid grid-cols-3 gap-6">
                        @foreach ($data['options'] as $option)
                        @php
                                $percentage = ($option['response_count'] / $data['response_count']) * 100;
                            @endphp
                                <div class="bg-white border rounded-lg shadow p-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center text-lg font-bold">1</div>
                        <div>
                            <p class="text-lg font-semibold">{{ $option['option_text'] }}</p>
                            <p class="text-gray-600">{{$percentage}}%</p>
                            <p class="text-gray-400 text-sm">{{ $option['response_count'] }} Responses</p>
                        </div>
                    </div>
                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Additional Information -->


    </div>
</div>

</body>
</html>
