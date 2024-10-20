<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Surveys</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/cdn.min.js" defer></script>
</head>
<body>

    <!-- Navbar Component -->
    <x-navbar />

    <div class="flex">
        <!-- User Sidebar Component -->
        <x-usersidebar />

        <div class="py-7 flex-1"> <!-- Main Content Area -->
            @if(Session::has('alert'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('alert') }}</span>
                </div>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">

                </div>

                <div class="container mx-auto p-6">
                    <h1 class="text-3xl font-bold mb-6">Available Surveys</h1>
                    
                    @if ($surveys->isEmpty())
                        <p class="text-gray-600">No surveys available at the moment.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach ($surveys as $survey)
                                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                                    <img src="https://picsum.photos/200/300" alt="{{ $survey->title }}" class="w-full h-40 object-cover" /> <!-- Survey Image -->
                                    <div class="p-4">
                                        <h2 class="text-xl font-semibold mb-2">{{ $survey->title }}</h2>
                                        <p class="text-gray-600">Target Age: {{ $survey->target->employment_status ?? 'N/A' }}</p>

                                        <p class="text-gray-600">Target Age: {{ $survey->target->age ?? 'N/A' }}</p>
                                        <p class="text-gray-600">education: {{ $survey->target->education_level ?? 'N/A' }}</p>
                                        <p class="text-gray-600">Gender: {{ $survey->target->gender ?? 'N/A' }}</p>

                                        <!-- Earn Credits Section -->
                                        <div class="mt-4">
                                            <span class="text-lg font-bold text-indigo-600">Earn: {{ $survey->credits }} Credits</span>
                                        </div>


                                        <a href="{{ route('survey.show', $survey->id) }}" class="inline-block bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition-colors duration-300">Take Survey</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>
