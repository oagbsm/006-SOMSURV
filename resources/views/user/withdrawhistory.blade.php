<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Withdrawal History</title>

    <!-- Tailwind setup -->
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Main Container -->
    <x-navbar />

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <x-usersidebar />
        
        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-100">
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Withdrawal History</h1>
                    <p class="text-gray-500">Overview of your withdrawal transactions</p>
                </div>
                <a href="/business/withdraw" class="bg-indigo-600 text-white py-2 px-4 rounded-md">
                    <span class="material-icons-outlined">attach_money</span>
                    <span class="ml-2">Withdraw Money</span>
                </a>
            </div>

            <!-- Withdrawal History Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <h2 class="font-bold text-lg">Your Recent Withdrawals</h2>
                </div>

                <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Date</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Method</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Amount</th>
            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($withdrawals as $withdrawal)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b border-gray-200">{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                <td class="py-2 px-4 border-b border-gray-200">{{ ucfirst($withdrawal->method) }}</td>
                <td class="py-2 px-4 border-b border-gray-200">${{ number_format($withdrawal->amount, 2) }}</td>
                <td class="py-2 px-4 border-b border-gray-200">
                    <span class="text-green-600 bg-green-100 py-1 px-2 rounded-full text-sm">
Completed                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="py-2 px-4 border-b border-gray-200 text-center text-sm text-gray-600">
                    No withdrawal history available.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


                </div>
            </div>
        </div>
    </div>
</body>
</html>
