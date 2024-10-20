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

    <!-- Sidebar (Dynamic) -->            <x-navbar/>

    <div class="flex">
        <x-usersidebar/>

        <div class="flex-grow">
            <!-- Navbar (Dynamic) -->


            <!-- Add Profile Form Section -->
            <section class="flex justify-center mt-10 items-center">
                <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-3xl font-bold text-center text-gray-900">Complete Your Profile</h2>
                    <p class="mt-2 text-center text-sm text-gray-600">Fill in the details to complete your profile.</p>

                    <!-- Add Profile Form -->
                    <form method="POST" action="{{ route('saveProfile') }}" class="mt-8 space-y-6">
                        @csrf

                        <!-- Personal Information Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Personal Information</h3>
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                            <input id="age" name="age" type="number" value="{{ old('age', $userprofile->age ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('age')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" name="gender" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male" {{ old('gender', $userprofile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $userprofile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $userprofile->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Location Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Location</h3>
                        <div>
    <label for="city" class="block text-sm font-medium text-gray-700">Region</label>
    <select id="city" name="city" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">{{ old('city', $userprofile->city ?? '') }}</option>
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
                            <input id="country" name="country" type="text" value="{{ old('country', $userprofile->country ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('country')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                            <input id="region" name="region" type="text" value="{{ old('region', $userprofile->region ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('region')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Education Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Education</h3>
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-gray-700">Education Level</label>
                            <select id="education_level" name="education_level" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select your education level</option>
                                <option value="high_school" {{ old('education_level', $userprofile->education_level ?? '') == 'high_school' ? 'selected' : '' }}>High School</option>
                                <option value="bachelor_degree" {{ old('education_level', $userprofile->education_level ?? '') == 'bachelor_degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                                <option value="master_degree" {{ old('education_level', $userprofile->education_level ?? '') == 'master_degree' ? 'selected' : '' }}>Master's Degree</option>
                                <option value="phd" {{ old('education_level', $userprofile->education_level ?? '') == 'phd' ? 'selected' : '' }}>PhD</option>
                            </select>
                            @error('education_level')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Telecom Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Telecom Information</h3>
                        <div>
                            <label for="telecom1" class="block text-sm font-medium text-gray-700">Telecom Provider 1</label>
                            <input id="telecom1" name="telecom1" type="text" value="{{ old('telecom1', $userprofile->telecom1 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('telecom1')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="telecom2" class="block text-sm font-medium text-gray-700">Telecom Provider 2</label>
                            <input id="telecom2" name="telecom2" type="text" value="{{ old('telecom2', $userprofile->telecom2 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('telecom2')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Mobile Money Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Mobile Money Information</h3>
                        <div>
                            <label for="mobile_money1" class="block text-sm font-medium text-gray-700">Mobile Money 1</label>
                            <input id="mobile_money1" name="mobile_money1" type="text" value="{{ old('mobile_money1', $userprofile->mobile_money1 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('mobile_money1')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="mobile_money2" class="block text-sm font-medium text-gray-700">Mobile Money 2</label>
                            <input id="mobile_money2" name="mobile_money2" type="text" value="{{ old('mobile_money2', $userprofile->mobile_money2 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('mobile_money2')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nationality Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Nationality</h3>
                        <div>
                            <label for="nationality1" class="block text-sm font-medium text-gray-700">Nationality 1</label>
                            <input id="nationality1" name="nationality1" type="text" value="{{ old('nationality1', $userprofile->nationality1 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('nationality1')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bank Information Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Bank Information</h3>
                        <div>
                            <label for="bank1" class="block text-sm font-medium text-gray-700">Bank 1</label>
                            <input id="bank1" name="bank1" type="text" value="{{ old('bank1', $userprofile->bank1 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('bank1')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="bank2" class="block text-sm font-medium text-gray-700">Bank 2</label>
                            <input id="bank2" name="bank2" type="text" value="{{ old('bank2', $userprofile->bank2 ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('bank2')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Employment Status Section -->
                        <h3 class="text-lg font-semibold text-gray-800 mt-4">Employment Status</h3>
                        <div>
                            <label for="employment_status" class="block text-sm font-medium text-gray-700">Employment Status</label>
                            <select id="employment_status" name="employment_status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select your employment status</option>
                                <option value="employed" {{ old('employment_status', $userprofile->employment_status ?? '') == 'employed' ? 'selected' : '' }}>Employed</option>
                                <option value="unemployed" {{ old('employment_status', $userprofile->employment_status ?? '') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                            </select>
                            @error('employment_status')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="salary_range" class="block text-sm font-medium text-gray-700">Salary Range</label>
                            <select id="salary_range" name="salary_range" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select your salary range</option>
                                <option value="A" {{ old('salary_range', $userprofile->salary_range ?? '') == 'A' ? 'selected' : '' }}>Under $300</option>
                                <option value="B" {{ old('salary_range', $userprofile->salary_range ?? '') == 'B' ? 'selected' : '' }}>$301 to $700</option>
                                <option value="C" {{ old('salary_range', $userprofile->salary_range ?? '') == 'C' ? 'selected' : '' }}>Above $700</option>
                            </select>
                            @error('salary_range')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">Save Profile</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

</body>
</html>
