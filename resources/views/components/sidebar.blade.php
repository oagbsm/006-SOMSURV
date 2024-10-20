<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<aside class="w-64 bg-white shadow-lg">
    <div class="px-6 py-8">
        <div class="flex items-center mb-10">
            <span class="ml-3 text-xl font-semibold">SomSurv</span>
        </div>
        <nav>
            <ul>
                <li class="mb-4">
                    <a href="/business" class="flex items-center p-3 rounded-md {{ request()->is('business') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                        <span class="material-icons-outlined">dashboard</span>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/business/viewsurvey" class="flex items-center p-3 rounded-md {{ request()->is('business/viewsurvey') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                        <span class="material-icons-outlined">confirmation_number</span>
                        <span class="ml-4">Surveys</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/business/analytics" class="flex items-center p-3 rounded-md {{ request()->is('business/analytics') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                        <span class="material-icons-outlined">assessment</span>
                        <span class="ml-4">Reports</span>
                    </a>
                </li>

                <!-- Deposit Section -->
                <ul class="mt-6">
                    <li class="mb-4">
                        <a href="#" onclick="toggleDepositOptions()" class="flex items-center p-3 rounded-md {{ request()->is('business/deposit', 'business/deposithistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                            <span class="material-icons-outlined">people</span>
                            <span class="ml-4">Deposit</span>
                        </a>
                    </li>
                    <div id="deposit-options" class="{{ request()->is('business/deposit', 'business/deposithistory') ? '' : 'hidden' }}">
                        <li class="mb-4 ml-4">
                            <a href="/business/deposit" class="flex items-center p-3 rounded-md {{ request()->is('business/deposit') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">attach_money</span>
                                <span class="ml-4">Deposit Money</span>
                            </a>
                        </li>
                        <li class="mb-4 ml-4">
                            <a href="/business/deposithistory" class="flex items-center p-3 rounded-md {{ request()->is('business/deposithistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">history</span>
                                <span class="ml-4">Deposit History</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <!-- Support Ticket Section -->
                <ul class="mt-6">
                    <li class="mb-4">
                        <a href="#" onclick="toggleSupportOptions()" class="flex items-center p-3 rounded-md {{ request()->is('business/ticket*') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                            <span class="material-icons-outlined">translate</span>
                            <span class="ml-4">Support Ticket</span>
                        </a>
                    </li>
                    <div id="support-options" class="{{ request()->is('business/ticket*') ? '' : 'hidden' }}">
                        <li class="mb-4 ml-4">
                            <a href="/business/ticket" class="flex items-center p-3 rounded-md {{ request()->is('business/ticket/new') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">add_circle_outline</span>
                                <span class="ml-4">Open New Ticket</span>
                            </a>
                        </li>
                        <li class="mb-4 ml-4">
                            <a href="/business/tickethistory" class="flex items-center p-3 rounded-md {{ request()->is('business/tickethistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">history</span>
                                <span class="ml-4">Ticket History</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <li>
                    <a href="#" class="flex items-center p-3 rounded-md text-gray-600 hover:bg-gray-200">
                        <span class="material-icons-outlined">settings</span>
                        <span class="ml-4">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>

<script>
    function toggleDepositOptions() {
        const depositOptions = document.getElementById('deposit-options');
        depositOptions.classList.toggle('hidden');
    }

    function toggleSupportOptions() {
        const supportOptions = document.getElementById('support-options');
        supportOptions.classList.toggle('hidden');
    }
</script>
