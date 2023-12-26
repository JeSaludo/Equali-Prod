<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Applicant </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        @vite('resources/css/app.css')

    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')

            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <div class="flex items-center  ">
                    <form method="get" action="{{ route('admin.dashboard.show-applicant') }}"
                        class="relative w-[300px]">
                        @csrf
                        <input type="text" name="searchTerm" placeholder="Search Here"
                            value="{{ request('searchTerm') }}"
                            class="border border-[#D9DBE3] bg-[#F7F7F7] placeholder:text-[#8B8585] px-12 py-2 pl-10 pr-10 w-full rounded-[16px]">
                        <i
                            class='bx bx-search text-[#8B8585] bx-sm absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                    </form>
                </div>

                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                {{-- @include('layout.schedule-interview-count') --}}

                <div class="flex justify-between mx-4 mt-4 mb-4">

                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Scheduled Date</h1>



                </div>



                <form action="{{ route('admin.dashboard.schedule-applicant') }}" method="POST">
                    @csrf


                    <div class="flex mx-4 mb-4" id="navLinks">



                        <a href="{{ route('admin.dashboard.show-schedule-interview') }}"
                            class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Schedule
                            Interview</a>
                        <a href="{{ route('admin.dashboard.show-scheduled-interview') }}"
                            class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Scheduled Interview</a>
                        <a href="{{ route('admin.dashboard.show-scheduled-date') }}"
                            class="font-poppins  active text-slate-500  nav-link whitespace-nowrap">Scheduled
                            Date</a>

                        <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                    </div>

                    <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg ">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full font-poppins border-collapse text-md text-left rtl:text-right text-gray-500 table-auto">
                                <thead
                                    class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                    <tr>
                                        <td class="px-6 py-2">Date</td>

                                        <td class="px-6 py-2">Total Slots</td>
                                    </tr>
                                </thead>
                                <tbody class="text-left">

                                    @php
                                        $scheduledDates = $users->pluck('qualifiedStudent.exam_schedule_date')->unique();

                                        $noSchedule = $scheduledDates->isEmpty();
                                    @endphp

                                    @if ($noSchedule)
                                        <tr>
                                            <td class="px-6 py-3" colspan="3">No Schedule Yet</td>
                                        </tr>
                                    @else
                                        @foreach ($scheduledDates as $index => $date)
                                            @php
                                                $usersForDate = $users->where('qualifiedStudent.exam_schedule_date', $date);
                                                $nonEmptyUsersForDate = $usersForDate->filter(function ($user) {
                                                    return $user->qualifiedStudent->start_time !== null; // Add a condition to check for non-empty data
                                                });
                                                $totalSlots = $nonEmptyUsersForDate->count() * $slotLimit;
                                            @endphp

                                            @if ($nonEmptyUsersForDate->isNotEmpty())
                                                <tr
                                                    class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                                    <!-- Display scheduled date and slot information -->
                                                    <td class="px-6 py-3">
                                                        {{ $date }}
                                                    </td>

                                                    <td class="px-6 py-3">
                                                        {{ $nonEmptyUsersForDate->count() }} / {{ $slotLimit }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach


                                    @endif
                                </tbody>
                            </table>

                            <nav
                                class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">

                                <a href="{{ $users->previousPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->currentPage() > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                                    <span class="">Previous</span>

                                </a>




                                <div class="flex">
                                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                                        <a href="{{ $users->url($i) }}"
                                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#26386A]  {{ $i == $users->currentPage() ? 'bg-slate-100' : '' }}">
                                            {{ $i }}
                                        </a>
                                    @endfor
                                </div>
                                <a href="{{ $users->nextPageUrl() }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-[#26386A] {{ $users->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                    <span class="">Next</span>

                                </a>
                                {{-- Next Page Link --}}


                            </nav>
                        </div>


                        <!-- Create the popup for scheduling -->
                        <div id="popup"
                            class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                            <div class="bg-white rounded-lg p-4">
                                <span class="cursor-pointer absolute top-2 right-2 text-gray-600"
                                    id="closePopup">&times;</span>
                                <h2 class="text-lg font-semibold mb-4">Schedule Exam and Interview</h2>

                                <div>
                                    <div class="mb-4">
                                        <label for="date"
                                            class="block text-sm font-medium text-gray-600">Date:</label>
                                        <input type="date" name="date" class="w-full px-3 py-2 border rounded-md"
                                            required>


                                        <div class="my-2 ">
                                            <label for="start_time">Time:</label>
                                            <input type="time" id="start_time" name="start_time" class="w-full">


                                        </div>

                                        <div class="my-2">
                                            <label for="location">Location:</label>
                                            <input type="text" id="location" name="location" class="w-full"
                                                required>

                                        </div>





                                    </div>
                                    <button type="submit"
                                        class="bg-[#2B6CE6] text-white px-4 py-2 rounded-md hover:bg-[#134197] transition-colors duration-200">Submit</button>
                                    <button type="button" id="cancelSchedule"
                                        class="bg-gray-300 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors duration-200 ml-2">Cancel</button>
                                </div>
                            </div>
                        </div>
                </form>






            </section>

        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get the checkboxes and the button
                const checkboxes = document.querySelectorAll('input[name="selectedUsers[]"]');
                const approveBtn = document.getElementById('approveBtn');

                // Add a change event listener to each checkbox
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        // Check if any checkbox is selected
                        const anyCheckboxSelected = Array.from(checkboxes).some(checkbox => checkbox
                            .checked);

                        // Update the button's disabled state
                        approveBtn.disabled = !anyCheckboxSelected;
                    });
                });

                selectAllCheckbox.addEventListener('click', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;

                    });
                    approveBtn.disabled = !selectAllCheckbox.checked;
                });
            });


            const selectAllCheckbox = document.getElementById('default-checkbox');
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');


            function updateSelectAllCheckbox() {
                selectAllCheckbox.checked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            }



            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function() {
                    updateSelectAllCheckbox();
                });
            });


            document.getElementById("openPopup").addEventListener("click", function() {
                document.getElementById("popup").classList.remove("hidden");
            });

            // Close the popup when the close button is clicked
            document.getElementById("closePopup").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });

            // Close the popup when the cancel button is clicked
            document.getElementById("cancelSchedule").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });

            // Handle the submit button
        </script>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>

    </body>

</html>
