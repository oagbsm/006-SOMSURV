<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Support Ticket History</title>

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
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Support Ticket History</h1>
                    <p class="text-gray-500">View all your submitted support tickets.</p>
                </div>
                <a href="/business/ticket" class="bg-indigo-600 text-white py-2 px-4 rounded-md">
                    <span class="material-icons-outlined">add</span>
                    <span class="ml-2">Create New Ticket</span>
                </a>
            </div>

            <!-- Ticket History Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-3 px-6 text-left">Subject</th>
                            <th class="py-3 px-6 text-left">Priority</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Created At</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-4 px-6">{{ $ticket->subject }}</td>
                            <td class="py-4 px-6">{{ ucfirst($ticket->priority) }}</td>
                            <td class="py-4 px-6">{{ $ticket->status }}</td>
                            <td class="py-4 px-6">{{ $ticket->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-6">
                                <a href="/business/ticket/{{ $ticket->id }}" class="text-indigo-600 hover:underline">View</a>
                                <a href="/business/ticket/delete/{{ $ticket->id }}" class="text-red-600 hover:underline ml-4">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
