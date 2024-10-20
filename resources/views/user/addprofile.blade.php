<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Profile - SomSurvey</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar (Optional) -->
    <header class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="/" class="text-2xl font-bold text-indigo-600">SomSurvey</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Add Profile Form Section -->
    <section class="flex justify-center mt-20 items-center h-[40%]">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-gray-900">Complete Your Profile</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Fill in the details to complete your profile.</p>

            <!-- Add Profile Form -->
            <form method="POST" action="{{ route('saveProfile') }}" class="mt-8 space-y-6">
                @csrf
                
                <!-- Personal Information Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Personal Information</h3>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input id="age" name="age" type="number" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('age')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" name="gender" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Education Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Education</h3>
                <div>
                    <label for="education_level" class="block text-sm font-medium text-gray-700">Education Level</label>
                    <select id="education_level" name="education_level" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your education level</option>
                        <option value="high_school">High School</option>
                        <option value="bachelor_degree">Bachelor's Degree</option>
                        <option value="master_degree">Master's Degree</option>
                        <option value="phd">PhD</option>
                    </select>
                    @error('education_level')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Location Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Location</h3>
<div>
    <label for="city" class="block text-sm font-medium text-gray-700">Region</label>
    <select id="city" name="city" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">Select a region</option>
        <option value="Awdal">Awdal</option>
        <option value="Bakool">Bakool</option>
        <option value="Banaadir">Banaadir</option>
        <option value="Bari">Bari</option>
        <option value="Bay">Bay</option>
        <option value="Galguduud">Galguduud</option>
        <option value="Gedo">Gedo</option>
        <option value="Hiiraan">Hiiraan</option>
        <option value="Jubbada Dhexe">Jubbada Dhexe</option>
        <option value="Jubbada Hoose">Jubbada Hoose</option>
        <option value="Mudug">Mudug</option>
        <option value="Nugaal">Nugaal</option>
        <option value="Sanaag">Sanaag</option>
        <option value="Shabeellaha Dhexe">Shabeellaha Dhexe</option>
        <option value="Shabeellaha Hoose">Shabeellaha Hoose</option>
        <option value="Sool">Sool</option>
        <option value="Togdheer">Togdheer</option>
        <option value="Woqooyi Galbeed">Woqooyi Galbeed</option>
    </select>
    @error('city')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>


                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <input id="country" name="country" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('country')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700">City</label>
                    <input id="region" name="region" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('region')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Telecom Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Telecom Information</h3>
                <div>
                    <label for="telecom1" class="block text-sm font-medium text-gray-700">Telecom Provider 1</label>
                    <select id="telecom1" name="telecom1" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your telecom provider</option>
                        <option value="Hormuud">Hormuud</option>
                        <option value="somtel">Somtel</option>
                        <option value="golis">Golis</option>
                        <option value="nationlink">NationLink</option>
                        <!-- Add more providers as necessary -->
                    </select>
                    @error('telecom1')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="telecom2" class="block text-sm font-medium text-gray-700">Telecom Provider 2</label>
                    <select id="telecom2" name="telecom2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your telecom provider</option>
                        <option value="Hormuud">Hormuud</option>
                        <option value="somtel">Somtel</option>
                        <option value="golis">Golis</option>
                        <option value="nationlink">NationLink</option>
                        <!-- Add more providers as necessary -->
                    </select>
                    @error('telecom2')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mobile Money Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Mobile Money Information</h3>
                <div>
                    <label for="mobile_money1" class="block text-sm font-medium text-gray-700">Mobile Money Provider 1</label>
                    <select id="mobile_money1" name="mobile_money1" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your mobile money provider</option>
                        <option value="EVC">EVC</option>
                        <option value="e-dahab">E-Dahab</option>
                        <option value="epesa">e-Pesa</option>
                        <!-- Add more providers as necessary -->
                    </select>
                    @error('mobile_money1')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="mobile_money2" class="block text-sm font-medium text-gray-700">Mobile Money Provider 2</label>
                    <select id="mobile_money2" name="mobile_money2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your mobile money provider</option>
                        <option value="EVC">EVC</option>
                        <option value="e-dahab">E-Dahab</option>
                        <option value="epesa">e-Pesa</option>
                        <!-- Add more providers as necessary -->
                    </select>
                    @error('mobile_money2')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nationality Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Nationality</h3>
                <div>
                    <label for="nationality1" class="block text-sm font-medium text-gray-700">Nationality 1</label>
                    <input id="nationality1" name="nationality1" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nationality1')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bank1" class="block text-sm font-medium text-gray-700">Bank 1</label>
                    <select id="bank1" name="bank1" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your bank</option>
                        <option value="SALAM BANK">SALAM BANK</option>
                        <option value="PREMIER BANK">PREMIER BANK</option>
                        <option value="IBS Bank">IBS Bank</option>
                        <!-- Add more banks as necessary -->
                    </select>
                    @error('bank1')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bank2" class="block text-sm font-medium text-gray-700">Bank 2</label>
                    <select id="bank2" name="bank2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your bank</option>
                        <option value="SALAM BANK">SALAM BANK</option>
                        <option value="PREMIER BANK">PREMIER BANK</option>
                        <option value="IBS Bank">IBS Bank</option>
                        <!-- Add more banks as necessary -->
                    </select>
                    @error('bank2')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Employment Section -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Employment Status</h3>
                <div>
                    <label for="employment_status" class="block text-sm font-medium text-gray-700">Employment Status</label>
                    <select id="employment_status" name="employment_status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your employment status</option>
                        <option value="employed">Employed</option>
                        <option value="unemployed">Unemployed</option>
                    </select>
                    @error('employment_status')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="salary_range" class="block text-sm font-medium text-gray-700">Salary Range</label>
                    <select id="salary_range" name="salary_range" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select your salary range</option>
                        <option value="A">NO SALARY</option>
                        <option value="B">UNDER $300</option>
                        <option value="C">301 TO 700 USD</option>
                        <option value="C">701+ USD</option>

                    </select>
                    @error('salary_range')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
