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
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    fontFamily: {
                        open: '"Open Sans"',
                        poppins: "'Poppins', sans-serif",
                        raleway: "'Raleway', sans-serif",
                    },
                    extend: {},
                }
            }
        </script>



    </head>

    <body>
        <div class="min-h-screen  bg-[#F7F7F7]">

            @include('layout.danger-alert')
            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <diV>
                    <form method="get" action="" class="relative w-[300px]">
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

                <div class="flex-row md:flex justify-evenly my-4 ">

                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg border  border-[#D9DBE3] shadow-sm ">
                        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">No. of Applicants</h1>


                        <div class="flex items-end gap-3 text-[#718297] mb-8">
                            <i class='bx bxs-user-detail text-[30px] pb-2'></i>
                            <p class="text-[36px] py-0">{{ $recentUser->count() }}</p>
                        </div>

                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                        </div>

                    </div>
                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Approve Applicants</h1>


                        <div class="flex items-end gap-3 px-2 text-[#718297] ">
                            <i class='bx bxs-user-check text-[30px] pb-2'></i>
                            <p class="text-[36px] py-0">
                                {{ $recentUser->where('status', 'Ready For Interview')->count() }} </p>
                        </div>
                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                        </div>


                    </div>

                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Pending Applicants</h1>


                        <div class="flex items-end gap-3 px-2 text-[#718297] ">

                            <i class='bx bxs-time text-[30px] pb-2'></i>
                            <p class="text-[36px] py-0">{{ $recentUser->where('status', 'Pending')->count() }} </p>
                        </div>
                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                        </div>


                    </div>

                    <div class="bg-white mx-4 px-6 w-full relative rounded-lg  border  border-[#D9DBE3] shadow-sm">
                        <h1 class="text-[18px] pt-2 font-poppins font-bold text-[#26386A] ">Archive Applicants</h1>


                        <div class="flex items-end gap-3 px-2 text-[#718297]">
                            <i class='bx bxs-archive-in text-[30px] pb-2'></i>
                            <p class="text-[36px] py-0">{{ $recentUser->where('status', 'Archived')->count() }}</p>


                        </div>

                        <div class="bg-[#5587F7] w-full  h-[24px] absolute bottom-0 left-0 px-0 mx-0 rounded-b-lg">
                        </div>

                    </div>
                </div>


                <div class="flex  mx-4 mt-2 justify-between">


                    <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">List of Applicants</h1>

                    <div>
                        <button id="addApplicantBtn"
                            class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                            <i id="icon" class='bx bx-plus pr-1'></i>Add Applicant
                        </button>
                    </div>




                </div>

                <form action="{{ route('admin.dashboard.approve-applicant-multiple') }}" method="POST">
                    @csrf
                    <div class="mx-4 my-2">
                        <button disabled id="approveBtn"
                            class="border border-[#D9DBE3] hover:border-slate-400 flex items-center text-[14px] tezt-poppin hover:text-[#384b94] font-poppins text-slate-600 py-1 px-4 rounded-lg">
                            <i class='bx bx-user-check text-[16px] pr-1'></i></i>Approve
                        </button>
                    </div>

                    <div class="flex mx-4 mb-4" id="navLinks">
                        <a href="{{ route('admin.dashboard.show-applicant') }}"
                            class="font-poppins  text-slate-500 nav-link  ">All</a>
                        <a href="{{ route('admin.dashboard.show-pending-applicant') }}"
                            class="font-poppins  text-slate-500 nav-link active">Pending</a>
                        <a href="{{ route('admin.dashboard.show-approved-applicant') }}"
                            class="font-poppins  text-slate-500 nav-link">Approved</a>
                        <a href="{{ route('admin.dashboard.show-archive-applicant') }}"
                            class="font-poppins  text-slate-500 nav-link">Archived</a>


                        <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>

                    </div>

                    <div class="bg-white mx-4 relative   my-2  border border-[#D9DBE3] shadow-md rounded-lg ">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                                <thead
                                    class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-left whitespace-nowrap">
                                    <tr>
                                        <td class="px-6 py-2 ">
                                            <div class="flex items-center">
                                                <input id="default-checkbox" type="checkbox" value=""
                                                    name="akk"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">

                                            </div>
                                        </td>
                                        <td class="px-6 py-2">ID</td>
                                        <td class="px-6 py-2">Applicant Name</td>
                                        <td class="px-6 py-2">Admission Exam Score</td>
                                        <td class="px-6 py-2">Admission Status</td>
                                        <td class="px-6 py-2">Status</td>
                                        <td class="px-6 py-2">Action</td>
                                    </tr>
                                </thead>

                                <tbody class="text-left ">
                                    @if ($users->count() == 0)
                                        <tr>
                                            <td></td>
                                            <td class="">

                                                <p class="my-3">No Data found in the database</p>

                                            </td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($users as $index => $user)
                                            <tr
                                                class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                                <td class="px-6 py-3">
                                                    <div class="flex items-center">
                                                        <input id="default-checkbox" name="selectedUsers[]"
                                                            type="checkbox" value="{{ $user->id }}"
                                                            class="user-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3">{{ $user->id }}</td>
                                                <td class="px-6 py-3">
                                                    {{ $user->last_name . ', ' . $user->first_name }}</td>
                                                <td class="px-6 py-3">
                                                    {{ $user->admissionExam->score . '/' . $user->admissionExam->total_score }}
                                                </td>

                                                <td class="px-6 py-3">
                                                    @if ($user->admissionExam->status == 'Passed')
                                                        <span
                                                            class="bg-green-100  text-[14px] text-green-700 py-1 px-2 rounded-md ">Passed</span>
                                                    @elseif($user->admissionExam->status == 'Failed')
                                                        <span
                                                            class="bg-red-200  text-[14px] text-red-700 py-1 px-2 rounded-md ">Failed</span>
                                                    @endif

                                                </td>
                                                <td class="px-6 py-3">
                                                    @if ($user->status == 'WaitListed')
                                                        <span
                                                            class="bg-sky-200  text-[14px] text-sky-700 py-1 px-2 rounded-md ">Waitlisted</span>
                                                    @elseif($user->status == 'Qualified')
                                                        <span
                                                            class="bg-blue-200  text-[14px] text-blue-700 py-1 px-2 rounded-md ">Qualified</span>
                                                    @elseif($user->status == 'Approved')
                                                        <span
                                                            class="bg-emerald-200  text-[14px] text-emerald-700 py-1 px-2 rounded-md ">Approved</span>
                                                    @elseif($user->status == 'Unqualified')
                                                        <span
                                                            class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Unqualified</span>
                                                    @elseif($user->status == 'Archived')
                                                        <span
                                                            class="bg-rose-200  text-[14px] text-rose-700 py-1 px-2 rounded-md ">Archived</span>
                                                    @elseif($user->status == 'Pending')
                                                        <span
                                                            class="bg-orange-200  text-[14px] text-orange-700 py-1 px-2 rounded-md ">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 flex items-center justify-start">
                                                    <a class="hover:text-green-400 mx-1" title="Approve"
                                                        href="{{ route('admin.dashboard.approve-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400"
                                                        onclick="return confirm('Are you sure you want to approve this user?')">
                                                        <i class='bx bx-user-check bx-sm'></i>

                                                    </a>
                                                    <a class="hover:text-red-400 mx-1" title="Reject"
                                                        href="{{ route('admin.dashboard.reject-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-red-400"
                                                        onclick="return confirm('Are you sure you want to archive this user?')">
                                                        <i class='bx bx-user-x bx-sm '></i>
                                                    </a>

                                                    <a href="{{ route('admin.dashboard.edit-applicant', $user->id) }}"
                                                        class="mx-1 hover:text-green-400" title="Edit"><i
                                                            class='bx bxs-edit '></i>
                                                    </a>



                                                </td>
                                            </tr>
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

                    </div>
                </form>
                <div class="">
                    <div id="addApplicantContent"
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">

                        <form action="{{ route('admin.dashboard.store-applicant') }}" method="POST">
                            @csrf
                            <div
                                class="bg-white mx-auto text-center rounded-[12px] w-[520px] h-[380px] p-4 border   border-[#D9DBE3]  ">
                                <div
                                    class="relative text-center mx-auto font-poppins text-[24px] font-semibold  text-[#26386A] uppercase">
                                    <h1>Add Applicant</h1>
                                    <button id="closePopup" class="absolute top-0 right-0"><i
                                            class='bx bx-x bx-sm text-[#26386A]'></i></button>
                                </div>

                                <div class=" px-8 flex justify-between gap-4 mt-6 ">
                                    <div class="relative   w-full">
                                        <input type="text" name="firstName"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="First Name" required autocomplete="off">

                                    </div>

                                    <div class="relative  w-full">
                                        <input type="text" name="lastName"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="Last Name" required autocomplete="off">

                                    </div>



                                </div>


                                <div class="relative px-8 my-4 w-full">
                                    <input type="email" name="email"
                                        class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                        placeholder="Email Address" required autocomplete="off">

                                </div>

                                {{-- <div class="relative px-8 my-4 w-full">
                            <input type="text" name="contactNumber"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                placeholder="Contact Number" required autocomplete="off">

                        </div> --}}


                                <div class=" px-8 flex justify-between gap-4 my-4">
                                    <div class="relative  w-full">
                                        <input type="number" name="score"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="Score" required autocomplete="off">

                                    </div>


                                    <div class="relative  w-full">
                                        <input type="number" name="totalScore"
                                            class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[40px] border-2 border-[#D7D8D0] "
                                            placeholder="Full Score" required autocomplete="off" value=60>
                                        {{-- Change for auto  --}}
                                    </div>
                                </div>
                                <div class="px-8 my-6">
                                    <input type="submit" value="Submit"
                                        class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#1E5CD1] hover:bg-[#134197] transition-colors duration-200 text-white">
                                </div>

                            </div>



                        </form>

                    </div>
                </div>
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
        </script>









        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="{{ asset('js/nav-link.js') }}"></script>
        <script src="{{ asset('js/add-applicant.js') }}"></script>
    </body>

</html>
