<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Create Support Ticket</title>

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
                    <h1 class="text-2xl font-bold">Create New Support Ticket</h1>
                    <p class="text-gray-500">Submit a ticket and our team will get back to you.</p>
                </div>
                <a href="/business/tickets" class="bg-indigo-600 text-white py-2 px-4 rounded-md flex items-center">
                    <span class="material-icons-outlined">arrow_back</span>
                    <span class="ml-2">Back to Tickets</span>
                </a>
            </div>

            <!-- Support Ticket Form -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form action="/business/ticket" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Ticket Subject -->
                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="block w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter ticket subject" required>
                    </div>

                    <!-- Ticket Priority -->
                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                        <select id="priority" name="priority" class="block w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <!-- Ticket Message -->
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="block w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Describe your issue or question" required></textarea>
                    </div>

                    <!-- File Attachment -->
                    <div class="mb-4">
                        <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">Attachment (optional)</label>
                        <input type="file" id="attachment" name="attachment" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
