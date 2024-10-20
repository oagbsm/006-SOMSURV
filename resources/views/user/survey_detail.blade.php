<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>{{ $survey->survey_name }}</title>

    <!-- Tailwind setup -->
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-6 bg-gray-100">

            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold">{{ $survey->survey_name }}</h1>
                    <p class="text-gray-500 mt-1">Answer the following questions</p>
                </div>
            </div>

            <!-- Error Handling -->
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

            <!-- Survey Form Section -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Survey Questions</h2>
                <form action="{{ route('survey.submit', $survey->id) }}" method="POST" id="surveyForm">
                    @csrf

                    <!-- Hidden input for the survey ID -->
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                    @foreach ($questions as $index => $question)
                        <div class="mb-6 question-container" data-index="{{ $index }}">
                            <label class="block text-lg font-semibold mb-2">{{ $question->question_text }}</label>

                            {{-- Hidden input for question_id --}}
                            <input type="hidden" name="answers[{{ $index }}][question_id]" value="{{ $question->id }}">

                            {{-- Handle question types --}}
                            @switch($question->question_type)
                                @case('text')
                                    <input type="text" name="answers[{{ $index }}][answer]" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2" placeholder="Your answer" required>
                                    @break

                                @case('rating')
                                    <div class="flex items-center mt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="answers[{{ $index }}][answer]" value="{{ $i }}" id="rating-{{ $index }}-{{ $i }}" class="hidden rating" required>
                                            <label for="rating-{{ $index }}-{{ $i }}" class="star" onclick="highlightStars(this, {{ $i }})">&#9733;</label>
                                        @endfor
                                    </div>
                                    @break

                                @case('dropdown')
                                    <select name="answers[{{ $index }}][option_id]" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2" required>
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($question->options as $option)
                                            <option value="{{ $option->id }}">{{ $option->option_text }}</option>
                                        @endforeach
                                    </select>
                                    @break

                                @case('checkbox')
                                    @foreach ($question->options as $option)
                                        <div class="mt-2">
                                            <input type="checkbox" name="answers[{{ $index }}][option_id][]" value="{{ $option->id }}" id="option-{{ $index }}-{{ $loop->index }}" class="mr-2">
                                            <label for="option-{{ $index }}-{{ $loop->index }}">{{ $option->option_text }}</label>
                                        </div>
                                    @endforeach
                                    @break

                                @case('true-false')
                                    <div class="mt-2">
                                        <input type="radio" name="answers[{{ $index }}][option_id]" value="true" id="true-{{ $index }}" required class="mr-2">
                                        <label for="true-{{ $index }}">True</label>
                                    </div>
                                    <div class="mt-2">
                                        <input type="radio" name="answers[{{ $index }}][option_id]" value="false" id="false-{{ $index }}" required class="mr-2">
                                        <label for="false-{{ $index }}">False</label>
                                    </div>
                                    @break

                                @default
                                    <p class="text-red-600">Invalid question type.</p>
                            @endswitch
                        </div>
                    @endforeach

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Submit Answers</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Script for rating stars -->
    <script>
        function highlightStars(star, count) {
            const stars = star.parentNode.querySelectorAll('.star');
            stars.forEach((s, index) => {
                if (index < count) {
                    s.classList.add('checked');
                } else {
                    s.classList.remove('checked');
                }
            });

            const radioButton = star.parentNode.querySelector(`input[value="${count}"]`);
            radioButton.checked = true;
        }
    </script>
</body>
</html>
