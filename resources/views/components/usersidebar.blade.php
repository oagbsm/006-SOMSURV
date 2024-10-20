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
                    <a href="/user" class="flex items-center p-3 rounded-md {{ request()->is('business') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                        <span class="material-icons-outlined">dashboard</span>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/user/surveys" class="flex items-center p-3 rounded-md {{ request()->is('business/viewsurvey') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                        <span class="material-icons-outlined">confirmation_number</span>
                        <span class="ml-4">Surveys</span>
                    </a>
                </li>


                <!-- Deposit Section -->
                <ul class="mt-6">
                    <li class="mb-4">
                        <a href="#" onclick="togglewithdrawOptions()" class="flex items-center p-3 rounded-md {{ request()->is('business/deposit', 'business/deposithistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                            <span class="material-icons-outlined">people</span>
                            <span class="ml-4">Withdraw</span>
                        </a>
                    </li>
                    <div id="withdraw-options" class="{{ request()->is('business/deposit', 'business/deposithistory') ? '' : 'hidden' }}">
                        <li class="mb-4 ml-4">
                            <a href="/user/withdraw" class="flex items-center p-3 rounded-md {{ request()->is('business/deposit') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">attach_money</span>
                                <span class="ml-4">Withdraw Credits</span>
                            </a>
                        </li>
                        <li class="mb-4 ml-4">
                            <a href="/user/withdrawhistory" class="flex items-center p-3 rounded-md {{ request()->is('business/deposithistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">history</span>
                                <span class="ml-4">Withdrawal History</span>
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
                            <a href="/user/ticket" class="flex items-center p-3 rounded-md {{ request()->is('business/ticket/new') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">add_circle_outline</span>
                                <span class="ml-4">Open New Ticket</span>
                            </a>
                        </li>
                        <li class="mb-4 ml-4">
                            <a href="/user/tickethistory" class="flex items-center p-3 rounded-md {{ request()->is('business/tickethistory') ? 'text-indigo-500 bg-indigo-50' : 'text-gray-600 hover:bg-gray-200' }}">
                                <span class="material-icons-outlined">history</span>
                                <span class="ml-4">Ticket History</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <li>
                    <a href="/user/settings" class="flex items-center p-3 rounded-md text-gray-600 hover:bg-gray-200">
                        <span class="material-icons-outlined">settings</span>
                        <span class="ml-4">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>

<script>
    function togglewithdrawOptions() {
        const withdrawOptions = document.getElementById('withdraw-options');
        withdrawOptions.classList.toggle('hidden');
    }

    function toggleSupportOptions() {
        const supportOptions = document.getElementById('support-options');
        supportOptions.classList.toggle('hidden');
    }
</script>
