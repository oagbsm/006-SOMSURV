<!DOCTYPE html>
<html lang="en">
<head>
<style>
    /* Styling for the withdrawal method options */
    .withdraw-method {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .withdraw-method.selected {
        border-left: 4px solid #facc15; /* Yellow left border when selected */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .withdraw-method img {
        margin-right: 1rem;
        height: 1.5rem;
    }

    .withdraw-method span {
        font-size: 1.125rem; /* Text size similar to your image */
        font-weight: 600;
        color: #4a4a4a; /* Darker text */
    }

    /* Hover effect */
    .withdraw-method:hover {
        border-color: #facc15;
    }

    /* Hide radio buttons */
    input[type="radio"] {
        display: none;
    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
    </style>
    <title>Withdraw</title>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Container -->
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <x-usersidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-100">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Withdraw Funds</h1>
                    <p class="text-gray-500">Withdraw your available balance</p>
                </div>
            </div>





            <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto grid grid-cols-2 gap-10">
    <!-- Left Section: Withdrawal Method Options -->
    <div>
        <!-- Withdrawal Methods -->
        <form action="{{ route('user.withdraw.submit') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <!-- Bank Transfer -->
            <label for="bank" class="withdraw-method flex items-center space-x-4 p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-yellow-400" id="bank-method">
                <input type="radio" id="bank" name="method" value="bank" class="hidden withdraw-option">
                <span class="material-icons text-2xl">account_balance</span> <!-- Bank Icon -->
                <span>Bank Transfer</span>
                <span class="ml-auto hidden bank-circle material-icons text-yellow-400">radio_button_checked</span>
            </label>

            <!-- Mobile Money -->
            <label for="mobile_money" class="withdraw-method flex items-center space-x-4 p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-yellow-400" id="mobile-money-method">
                <input type="radio" id="mobile_money" name="method" value="mobile_money" class="hidden withdraw-option">
                <span class="material-icons text-2xl">smartphone</span> <!-- Mobile Money Icon -->
                <span>Mobile Money</span>
                <span class="ml-auto hidden mobile-money-circle material-icons text-yellow-400">radio_button_checked</span>
            </label>
        </div>

        <!-- Error message if no method selected -->
        <span id="method-error" class="text-red-500 text-sm mt-2 hidden">Please select a withdrawal method.</span>
    </div>

    <!-- Right Section: Form Inputs -->
    <div>
        <!-- Amount Input -->
        <div class="mb-6">
            <label for="amount" class="block text-lg font-medium text-indigo-900 mb-2">Amount</label>
            <div class="relative">
                <input type="number" name="amount" id="amount" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 pl-12 text-lg" placeholder="0.00" required min="5" step="0.01">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-lg">$</span>
            </div>
            <!-- Error message (hidden by default) -->
            <span id="amount-error" class="text-red-500 text-sm mt-2 hidden">Amount must be at least $5.</span>
        </div>

        <!-- Limit Display -->
        <div class="mb-4 text-lg text-indigo-900">
            <div class="flex justify-between">
                <span>Limit</span>
                <span>$122.00 USD - $1,000.00 USD</span>
            </div>
        </div>

        <!-- Processing Charge -->
        <div class="mb-4 text-lg text-indigo-900">
            <div class="flex justify-between">
                <span>Processing Charge</span>
                <span>$0.00 USD</span>
            </div>
        </div>

        <!-- Receivable Amount -->
        <div class="mb-4 text-lg text-indigo-900">
            <div class="flex justify-between">
                <span>Receivable</span>
                <span id="receivable-amount">$0.00 USD</span> <!-- Receivable dynamic update -->
            </div>
        </div>

        <!-- Confirm Withdraw Button -->
        <button type="submit" class="w-full bg-yellow-400 text-indigo-900 py-4 rounded-lg font-semibold hover:bg-yellow-500 transition duration-200 text-lg" id="submit-btn" disabled>
            Confirm Withdraw
        </button>

        <!-- Additional Information -->
        <div class="text-sm mt-4 text-gray-500">Safely withdraw your funds using our highly secure process and various withdrawal methods.</div>
    </div>
</div>

<script>
    const amountInput = document.getElementById('amount');
    const receivableAmountDisplay = document.getElementById('receivable-amount');
    const submitButton = document.getElementById('submit-btn');
    const amountError = document.getElementById('amount-error');
    const methodError = document.getElementById('method-error');
    const minAmount = 5;

    const bankMethod = document.getElementById('bank-method');
    const mobileMoneyMethod = document.getElementById('mobile-money-method');

    const bankCircle = document.querySelector('.bank-circle');
    const mobileMoneyCircle = document.querySelector('.mobile-money-circle');

    // Validate amount input and receivable amount display
    amountInput.addEventListener('input', function () {
        const amountValue = parseFloat(amountInput.value);
        const receivableAmount = amountValue ? amountValue.toFixed(2) : '0.00';

        if (amountValue < minAmount) {
            amountError.classList.remove('hidden'); // Show error
            submitButton.disabled = true; // Disable submit button
        } else {
            amountError.classList.add('hidden'); // Hide error
            checkFormValidity(); // Check if the form is valid
        }

        receivableAmountDisplay.textContent = `$${receivableAmount} USD`;
    });

    // Check if a withdrawal method is selected
    const withdrawOptions = document.querySelectorAll('input[name="method"]');
    withdrawOptions.forEach(option => {
        option.addEventListener('change', function () {
            methodError.classList.add('hidden'); // Hide error message
            checkFormValidity(); // Check if the form is valid

            // Show yellow circle next to the selected method
            if (option.value === 'bank') {
                bankCircle.classList.remove('hidden');
                mobileMoneyCircle.classList.add('hidden');
            } else if (option.value === 'mobile_money') {
                mobileMoneyCircle.classList.remove('hidden');
                bankCircle.classList.add('hidden');
            }
        });
    });

    // Function to check if both amount and method are valid
    function checkFormValidity() {
        const amountValue = parseFloat(amountInput.value);
        const isMethodSelected = document.querySelector('input[name="method"]:checked');

        if (amountValue >= minAmount && isMethodSelected) {
            submitButton.disabled = false; // Enable submit button
        } else {
            submitButton.disabled = true; // Disable submit button
        }
    }

    // Form submission validation to check method selection
    document.querySelector('form').addEventListener('submit', function (e) {
        const isMethodSelected = document.querySelector('input[name="method"]:checked');

        if (!isMethodSelected) {
            e.preventDefault();
            methodError.classList.remove('hidden'); // Show error message if no method selected
        }
    });
</script>








</div>
</div>
<script>
       const amountInput = document.getElementById('amount');
    const receivableAmountDisplay = document.getElementById('receivable-amount');
    const submitButton = document.getElementById('submit-btn');
    const amountError = document.getElementById('amount-error');
    const methodError = document.getElementById('method-error');
    const minAmount = 5;

    // Validate amount input and receivable amount display
    amountInput.addEventListener('input', function () {
        const amountValue = parseFloat(amountInput.value);
        const receivableAmount = amountValue ? amountValue.toFixed(2) : '0.00';

        if (amountValue < minAmount) {
            amountError.classList.remove('hidden'); // Show error
            submitButton.disabled = true; // Disable submit button
        } else {
            amountError.classList.add('hidden'); // Hide error
            checkFormValidity(); // Check if the form is valid
        }

        receivableAmountDisplay.textContent = `$${receivableAmount} USD`;
    });

    // Check if a withdrawal method is selected
    const withdrawOptions = document.querySelectorAll('input[name="method"]');
    withdrawOptions.forEach(option => {
        option.addEventListener('change', function () {
            methodError.classList.add('hidden'); // Hide error message
            checkFormValidity(); // Check if the form is valid
        });
    });

    // Function to check if both amount and method are valid
    function checkFormValidity() {
        const amountValue = parseFloat(amountInput.value);
        const isMethodSelected = document.querySelector('input[name="method"]:checked');

        if (amountValue >= minAmount && isMethodSelected) {
            submitButton.disabled = false; // Enable submit button
        } else {
            submitButton.disabled = true; // Disable submit button
        }
    }

    // Form submission validation to check method selection
    document.querySelector('form').addEventListener('submit', function (e) {
        const isMethodSelected = document.querySelector('input[name="method"]:checked');

        if (!isMethodSelected) {
            e.preventDefault();
            methodError.classList.remove('hidden'); // Show error message if no method selected
        }
    });
    </script>
</body>

</html>
