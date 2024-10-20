<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .input-field {
            padding: 10px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background-color: #FFFFFF;
        }

        .remove-option-btn,
        .remove-question-btn,
        .remove-nested-question-btn {
            color: #E11D48;
            cursor: pointer;
        }

        .add-option-btn,
        .add-question-btn,
        .submit-btn,
        .add-nested-question-btn {
            background-color: #4F46E5;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .add-option-btn:hover,
        .add-question-btn:hover,
        .submit-btn:hover,
        .add-nested-question-btn:hover {
            background-color: #4338CA;
        }

        .back-btn {
            background-color: #E11D48;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #BE123C;
        }

    </style>
</head>
<body class="bg-gray-100 flex flex-col h-screen">
    
<x-navbar />

    <!-- Navbar Component -->

    <!-- Main Container with Sidebar and Form -->
    <div class="flex flex-1">
        
        <!-- Sidebar Component -->
        <x-sidebar />

        <!-- Main Content (Form) -->
        <div class="container max-w-5xl mx-auto p-6 flex-grow">
            <h2 class="text-3xl font-bold text-gray-700 mb-7">Create Your Survey</h2>

            <form id="survey-form" action="{{ route('survey.store') }}" method="POST" onsubmit="return validateSurvey()">
                @csrf
                
                <!-- Survey Name Input -->
                <div class="mb-6">
                    <label for="survey_name" class="block text-lg font-medium text-gray-700 mb-2">Survey Name</label>
                    <input type="text" name="title" required class="input-field w-full focus:outline-none" placeholder="Enter survey name">
                </div>

                <!-- Survey Description Input -->


                <!-- Grid Layout for Credits, Respondent Limit, and Demographics -->
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <!-- Credits and Respondent Limit Box -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Survey Details</h3>
        
        <!-- Credits for Completion Input -->
        <div class="mb-6">
            <label for="credits" class="block text-lg font-medium text-gray-700 mb-2">Credits for Completion</label>
            <input type="number" id="credits" name="credits" required class="input-field w-full focus:outline-none" 
       min="0" step="0.01" placeholder="Enter credits for completing the survey" oninput="calculateCost()">
            </div>

        <!-- Respondent Limit Input -->
        <div class="mb-6">
            <label for="respondent_limit" class="block text-lg font-medium text-gray-700 mb-2">Respondent Limit</label>
            <input type="number" id="respondent_limit" name="respondent_limit" required class="input-field w-full focus:outline-none" min="1" placeholder="Enter maximum number of respondents" oninput="calculateCost()">
        </div>

        <!-- Cost of Campaign Display -->
        <div class="mt-4 hidden" id="campaignCostContainer">
    <h4 class="text-lg font-medium text-gray-700">
        Cost of Campaign: 
        <span id="campaignCost" class="font-bold text-gray-900">$0</span>
    </h4>
    <div id="depositMessage" class="text-red-600 mt-2 hidden">
    <input type="hidden" id="campaign_cost" name="campaign_cost" value="0">

    </div>

</div>


                    </div>

                    <!-- Demographics Box -->
   <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Target Demographics</h3>
        <div class="mb-4">
            <label for="filter_selection" class="block text-md font-medium text-gray-700 mb-2">Add Filter</label>
            <select id="filter_selection" class="input-field w-full focus:outline-none">
                <option value="" disabled selected>Select Filter</option>
                <option value="age">Age</option>
                <option value="gender">Gender</option>
                <option value="education_level">Education Level</option>
                <option value="location">Location</option>
                <option value="employment_status">Employment Status</option>
                <option value="salary_range">Salary Range</option>
            </select>
            <button type="button" id="add_filter_btn" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded shadow-lg hover:bg-blue-600">Add Filter</button>
        </div>

    <!-- Dynamic Filters Section -->
    
    <div id="dynamic_filters" class="space-y-4">
            <!-- Dynamically added filters will appear here -->
        </div>

                    </div>
                </div>

                <!-- Questions Section -->
                <div id="question-container" class="space-y-8">
                    <div class="question p-4 bg-white rounded-lg shadow-lg relative">
                        <label class="block text-lg font-medium text-gray-700">Question 1</label>
                        <input type="text" name="questions[0][question_text]" required class="input-field w-full mt-2" placeholder="Enter your question">
                        
                        <select name="questions[0][question_type]" class="input-field w-full mt-4" onchange="toggleOptions(this)">
                            <option value="dropdown">Dropdown</option>
                            <option value="rating">Rating</option>
                            <option value="checkbox">Checkboxes</option>
                            <option value="true-false">True/False</option>
                        </select>

                        <div class="options mt-4">
                            <label class="block text-md font-medium text-gray-700 mb-2">Options</label>
                            <div class="options-container space-y-2">
                                <div class="option-item flex items-center">
                                    <input type="text" name="questions[0][options][]" class="input-field w-full mt-2" placeholder="Enter option 1">
                                    <span class="remove-option-btn ml-4" onclick="removeOption(this)">Remove</span>
                                </div>
                                <div class="option-item flex items-center">
                                    <input type="text" name="questions[0][options][]" class="input-field w-full mt-2" placeholder="Enter option 2">
                                    <span class="remove-option-btn ml-4" onclick="removeOption(this)">Remove</span>
                                </div>
                            </div>
                            <button type="button" class="add-option-btn mt-4" onclick="addOption(this, 0)">Add Option</button>
                        </div>
                    </div>
                </div>

                <!-- Add Question Button -->
                <div class="flex justify-between mt-8">
                    <button type="button" onclick="addQuestion()" class="add-question-btn">Add Another Question</button>
                    <button type="submit" class="submit-btn">Submit Survey</button>
                </div>
            </form>

            <!-- Back to Dashboard Button -->
            <div class="mt-8 flex justify-center">
                <a href="{{ route('dashboard') }}" class="back-btn">Back to Dashboard</a>
            </div>
        </div>
    </div>


    <script>
        let questionCount = 1;

function addQuestion() {
    const container = document.getElementById('question-container');
    const newQuestion = document.createElement('div');
    newQuestion.classList.add('question', 'p-4', 'bg-white', 'rounded-lg', 'shadow-lg', 'relative');
    newQuestion.innerHTML = `
        <label class="block text-lg font-medium text-gray-700">Question ${questionCount + 1}</label>
        <input type="text" name="questions[${questionCount}][question_text]" required class="input-field w-full mt-2" placeholder="Enter your question">
        <select name="questions[${questionCount}][question_type]" class="input-field w-full mt-4" onchange="toggleOptions(this)">
            <option value="dropdown">Dropdown</option>
            <option value="rating">Rating</option>
            <option value="checkbox">Checkboxes</option>
            <option value="true-false">True/False</option>
        </select>
        <div class="options mt-4">
            <label class="block text-md font-medium text-gray-700 mb-2">Options</label>
            <div class="options-container space-y-2">
                <div class="option-item flex items-center">
                    <input type="text" name="questions[${questionCount}][options][]" class="input-field w-full mt-2" placeholder="Enter option 1">
                    <span class="remove-option-btn ml-4" onclick="removeOption(this)">Remove</span>
                </div>
                <div class="option-item flex items-center">
                    <input type="text" name="questions[${questionCount}][options][]" class="input-field w-full mt-2" placeholder="Enter option 2">
                    <span class="remove-option-btn ml-4" onclick="removeOption(this)">Remove</span>
                </div>
            </div>
            <button type="button" class="add-option-btn mt-4" onclick="addOption(this, ${questionCount})">Add Option</button>
        </div>
    `;
    container.appendChild(newQuestion);
    questionCount++;
}

function removeOption(element) {
    const optionItem = element.parentElement;
    optionItem.remove();
}

function addOption(button, questionIndex) {
    const optionsContainer = button.parentElement.querySelector('.options-container');
    const newOption = document.createElement('div');
    newOption.classList.add('option-item', 'flex', 'items-center');
    newOption.innerHTML = `
        <input type="text" name="questions[${questionIndex}][options][]" class="input-field w-full mt-2" placeholder="Enter option">
        <span class="remove-option-btn ml-4" onclick="removeOption(this)">Remove</span>
    `;
    optionsContainer.appendChild(newOption);
}

// function toggleOptions(selectElement) {
//     // Implement your logic to toggle options based on question type
// }

// function validateSurvey() {
//     // Implement your validation logic if needed
//     return true; // Allow form submission
// }  
    document.addEventListener('DOMContentLoaded', function () {
        const filterDropdown = document.getElementById('filter_selection');
        const addFilterBtn = document.getElementById('add_filter_btn');
        const dynamicFilters = document.getElementById('dynamic_filters');

        // Mapping of filter inputs based on the selected filter
        const filterInputs = {
            'age': `<label for="age" class="block text-md font-medium text-gray-700 mb-2">Target Age</label>
                    <input type="text" name="age" class="input-field w-full focus:outline-none" placeholder="e.g., 18-25">`,
            'gender': `<label for="gender" class="block text-md font-medium text-gray-700 mb-2">Target Gender</label>
                       <select name="gender" class="input-field w-full focus:outline-none">
                           <option value="">Select Gender</option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>
                           <option value="prefer_not_to_say">Prefer not to say</option>
                       </select>`,
            'education_level': `<label for="education_level" class="block text-md font-medium text-gray-700 mb-2">Target Education Level</label>
                               <select name="education_level" class="input-field w-full focus:outline-none">
                                   <option value="">Select Education Level</option>
                                   <option value="primary">Primary</option>
                                   <option value="secondary">Secondary</option>
                                   <option value="bachelor">Bachelor's Degree</option>
                                   <option value="master">Master's Degree</option>
                                   <option value="phd">PhD</option>
                               </select>`,
            'location': `<label for="location" class="block text-md font-medium text-gray-700 mb-2">Target Location (City/Region)</label>
                        <input type="text" name="location" class="input-field w-full focus:outline-none" placeholder="e.g., Mogadishu, Somalia">`,
            'employment_status': `<label for="employment_status" class="block text-md font-medium text-gray-700 mb-2">Employment Status</label>
                                  <select name="employment_status" class="input-field w-full focus:outline-none">
                                      <option value="">Select Employment Status</option>
                                      <option value="employed">Employed</option>
                                      <option value="unemployed">Unemployed</option>
                                  </select>`,
            'salary_range': `<label for="salary_range" class="block text-md font-medium text-gray-700 mb-2">Salary Range</label>
                             <select name="salary_range" class="input-field w-full focus:outline-none">
                                 <option value="">Select Salary Range</option>
                                 <option value="under_300">Under 300 USD</option>
                                 <option value="301_to_700">301 USD to 700 USD</option>
                                 <option value="701_plus">701 USD+</option>
                             </select>`
        };

        // Add event listener to the button to append the selected filter
        addFilterBtn.addEventListener('click', function () {
            const selectedFilter = filterDropdown.value;

            if (selectedFilter && filterInputs[selectedFilter]) {
                // Create a new div for the selected filter input
                const filterDiv = document.createElement('div');
                filterDiv.classList.add('filter-item', 'mb-4');

                // Add filter input with a remove button
                filterDiv.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div class="filter-content w-full">${filterInputs[selectedFilter]}</div>
                        <button type="button" class="remove-filter-btn ml-4 bg-red-500 text-white px-2 py-1 rounded shadow-lg hover:bg-red-600">Remove</button>
                    </div>
                `;

                // Append the filter to the dynamic filters section
                dynamicFilters.appendChild(filterDiv);

                // Add event listener to remove the filter when the "Remove" button is clicked
                filterDiv.querySelector('.remove-filter-btn').addEventListener('click', function () {
                    filterDiv.remove();
                });
            }
        });
    });

    function calculateCost() {
    // Get the values from the input fields
    const credits = parseFloat(document.getElementById('credits').value); // Get credits input
    const respondentLimit = parseInt(document.getElementById('respondent_limit').value); // Get respondent limit input

    // Check if both fields are populated
    if (!isNaN(credits) && !isNaN(respondentLimit)) {
        // Calculate the total cost
        const totalCost = credits * respondentLimit;

        // Show the campaign cost container and display the total cost
        document.getElementById('campaignCost').innerText = `$${totalCost.toFixed(2)}`;
        document.getElementById('campaignCostContainer').classList.remove('hidden');
    } else {
        // Hide the cost display if either field is empty
        document.getElementById('campaignCostContainer').classList.add('hidden');
    }

}
// document.addEventListener('DOMContentLoaded', function() {
//     const creditsInput = document.querySelector('input[name="credits"]');
//     const respondentLimitInput = document.querySelector('input[name="respondent_limit"]');
//     const campaignCostContainer = document.getElementById('campaignCostContainer');
//     const campaignCostElement = document.getElementById('campaignCost');
//     const depositMessage = document.getElementById('depositMessage');
    
//     const balance = {{ number_format($balance->balance ?? 0, 2) }}; // Replace with actual balance

//     function updateCampaignCost() {
//         const credits = parseFloat(creditsInput.value) || 0;
//         const respondentLimit = parseInt(respondentLimitInput.value) || 0;
//         const campaignCost = credits * respondentLimit;

//         // Update the campaign cost display
//         campaignCostElement.textContent = `$${campaignCost.toFixed(2)}`;

//         // Check if campaign cost exceeds balance
//         if (campaignCost > balance) {
//             depositMessage.textContent = `To create please Deposit: $${(campaignCost - balance).toFixed(2)}`;
//             depositMessage.classList.remove('hidden'); // Show the message
//             campaignCostElement.classList.add('text-red-600'); // Change cost to red
//         } else {
//             depositMessage.textContent = ''; // Clear the message
//             depositMessage.classList.add('hidden'); // Hide the message
//             campaignCostElement.classList.remove('text-red-600'); // Reset cost color
//         }

//         // Show campaign cost container
//         campaignCostContainer.classList.remove('hidden');
//     }

//     // Event listeners for inputs
//     creditsInput.addEventListener('input', updateCampaignCost);
//     respondentLimitInput.addEventListener('input', updateCampaignCost);
// });
</script>      

</body>
</html>