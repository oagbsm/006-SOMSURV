<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Deposit Page</title>

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
                    <h1 class="text-3xl font-bold">Deposit Funds</h1>
                    <p class="text-gray-500 mt-1">Select a deposit method and enter your amount</p>
                </div>
            </div>
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
            <!-- Deposit Form Section -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-semibold mb-4">Choose a Payment Method</h2>
                <form action="/business/deposit" method="POST">
    @csrf
    <!-- Deposit Amount -->
    <div class="mb-6">
        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Deposit Amount (USD):</label>
        <input type="number" id="amount" name="amount" placeholder="Enter amount" class="border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-indigo-500" required>
    </div>

    <!-- Payment Method -->
    <div class="mb-6">
        <label for="payment-method" class="block text-gray-700 text-sm font-bold mb-2">Select Payment Method:</label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="hormuud" name="payment_method" value="premierpay" class="mr-3" required>
                <label for="hormuud" class="text-gray-600 font-semibold">Premier Wallet</label>
            </div>
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="somtel" name="payment_method" value="eDahab" class="mr-3">
                <label for="somtel" class="text-gray-600 font-semibold">Somtel Telecom</label>
            </div>
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="evcplus" name="payment_method" value="EVC PLUS" class="mr-3">
                <label for="evcplus" class="text-gray-600 font-semibold">EVC Plus (Hormuud Mobile Money)</label>
            </div>
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="sahal" name="payment_method" value="mobile-money2" class="mr-3">
                <label for="sahal" class="text-gray-600 font-semibold">Sahal (Somtel Mobile Money)</label>
            </div>
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="dahabshiil" name="payment_method" value="eBesa" class="mr-3">
                <label for="dahabshiil" class="text-gray-600 font-semibold">IBS bank</label>
            </div>
            <div class="flex items-center p-4 border rounded-lg hover:bg-gray-50">
                <input type="radio" id="premier" name="payment_method" value="MyBank" class="mr-3">
                <label for="premier" class="text-gray-600 font-semibold">MyBank</label>
            </div>
        </div>
    </div>

    <!-- Transaction ID -->
    <div class="mb-6">
        <label for="transaction-id" class="block text-gray-700 text-sm font-bold mb-2">Transaction ID (if applicable):</label>
        <input type="text" id="transaction-id" name="transaction_id" placeholder="Enter transaction ID" class="border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:border-indigo-500">
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Submit Deposit</button>
    </div>
</form>
            </div>

            <!-- Additional Information -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Deposit Information</h2>
                <p class="text-gray-600">Please ensure you enter the correct payment details and double-check your transaction ID before submitting the form. Your deposit will be processed within 24 hours.</p>
            </div>

        </div>
    </div>

</body>
</html>
