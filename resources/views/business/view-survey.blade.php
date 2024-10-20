<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Surveys</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col h-screen">

    <!-- Navbar Section --><x-navbar />


    <!-- Main Container with Sidebar and Table -->
    <div class="flex h-screen ">
        <!-- Sidebar -->
        <x-sidebar />
        
        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            <div class="container mx-auto">
                <!-- Header with Title and Button -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-700">Your Surveys</h1>
                    <a href="{{ route('survey.store') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700">
                        + New Survey
                    </a>
                </div>

                <!-- Survey Statistics (Styled like Dashboard Cards) -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total Surveys -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-green-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">description</span>
            </div>
            <span class="text-4xl font-medium">{{$totalSurveys}}</span> <!-- Dummy data -->
        </div>
        <span class="text-sm">Total Surveys</span>
    </div>

    <!-- Avg. Response Time -->
    <div class="bg-orange-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-orange-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">timer</span>
            </div>
            <span class="text-4xl font-medium">5 min</span> <!-- Dummy data -->
        </div>
        <span class="text-sm">Avg. Response Time</span>
    </div>

    <!-- Total Responses -->
    <div class="bg-red-500 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-red-400 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">assignment_turned_in</span>
            </div>
            <span class="text-4xl font-medium">{{$totalResponses}}</span> <!-- Dummy data -->
        </div>
        <span class="text-sm">Total Responses</span>
    </div>

    <!-- Avg. Rating -->
    <div class="bg-purple-700 text-white p-6 rounded-lg shadow flex flex-col items-center">
        <div class="flex items-center mb-2">
            <div class="bg-purple-600 p-2 rounded-md mr-4">
                <span class="material-icons-outlined text-4xl">star</span>
            </div>
            <span class="text-4xl font-medium">4.5 / 5</span> <!-- Dummy data -->
        </div>
        <span class="text-sm">Avg. Rating</span>
    </div>
</div>

                <!-- Survey Table Section -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Questions</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">$ per survey</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Respondent Limit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($surveys as $survey)
            <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $survey->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $survey->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $survey->questions->count() }}</td> <!-- Total Questions -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $survey->credits }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $survey->respondent_limit }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-4">
                    <a href="{{ route('business.view-survey-detail', $survey->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">View</a>
                    <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this survey?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



            </div>
        </main>
    </div>
</body>
</html>
