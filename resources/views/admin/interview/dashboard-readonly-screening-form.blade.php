<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Screening Form </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@100;300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    </head>

    <body>
        <div class="min-h-screen  bg-[#EEF4F6]">


            @include('layout.sidenav', ['active' => 0])
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">




                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')

                <div class="bg-white mx-4 " id="printSection">
                    <h1 class="text-center text-[#26386A] font-poppins font-bold text-2xl my-3 py-4">Screening Form
                    </h1>
                    <div class="flex mx-4 justify-between l gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="name"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="Applicant Name:" required autocomplete="off"
                                value="{{ $user->first_name }} {{ $user->last_name }}" disabled>
                        </div>

                        <div class="relative px-4 my-2 flex w-full">
                            <div
                                class="h-[50px] py-3 w-3/12 bg-white whitespace-nowrap placeholder:text-[#4E4E4E]  px-[40px] rounded-l   border-x-2 border-y-2 border-r-2 border-[#D7D8D0]">
                                <label for="">Date</label>
                            </div>

                            <input
                                class="h-[50px] w-full  placeholder:text-[#4E4E4E]  px-[40px] rounded-r border-y-2 border-r-2 border-[#D7D8D0]"
                                type="date" name="date" class="" placeholder=":" value="{{ date('Y-m-d') }}"
                                disabled>
                        </div>
                    </div>
                    <div class="flex mx-4 justify-between  gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="home_address" value="{{ $user->studentInfo->address }}"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="Home Address" required autocomplete="off" disabled>
                        </div>

                        <div class="px-4 my-2 w-full">
                            <select
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                required autocomplete="off" name="course" disabled>
                                <option value="IT" {{ $user->studentInfo->course == 'IT' ? 'selected' : '' }}>
                                    Bachelor in Science of Information Technology
                                </option>

                                <option value="IS" {{ $user->studentInfo->course == 'IS' ? 'selected' : '' }}>
                                    Bachelor in Science of Information Systems
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="flex mx-4 justify-between  gap-2 ">
                        <div class=" px-4 my-2  w-full">
                            <input type="text" name="school_last_attended"
                                value="{{ $user->studentInfo->school_last_attended }}"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="School Last Attended:" required autocomplete="off" disabled>
                        </div>

                        <div class=" px-4 my-2 w-full">
                            <input type="text" name="school_address" value="{{ $user->studentInfo->school_address }}"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="School Address:" required autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="flex mx-4 justify-between  gap-2 ">


                        <div class="px-4 my-2 w-full">
                            <input type="text" name="year_graduated" value="{{ $user->studentInfo->year_graduated }}"
                                class="digit-only h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                placeholder="Year Graduated:" required autocomplete="off" maxlength="4" disabled
                                oninput="validateYear(this);">
                            <div id="yearError" class="text-red-500"></div>
                        </div>

                        <div class=" px-4 my-2 w-full">
                            <input type="text" name="gpa" value="{{ $user->studentInfo->gpa }}"
                                class="digit-only h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0] "
                                placeholder="GPA:" required autocomplete="off" min="75" max="100" disabled>
                        </div>
                    </div>

                    <div class="flex mx-4 justify-between  gap-2 ">


                        <div class="px-4 my-2 w-full">
                            <select
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                required autocomplete="off" name="academic_track" id="academic-track" disabled>

                                <option value="ABM"
                                    {{ $user->studentInfo->academic_track == 'ABM' ? 'selected' : '' }}>
                                    Accountancy, Business, and Management</option>
                                <option value="HUMSS"
                                    {{ $user->studentInfo->academic_track == 'HUMSS' ? 'selected' : '' }}>
                                    Humanities and Social Sciences</option>
                                <option value="STEM"
                                    {{ $user->studentInfo->academic_track == 'STEM' ? 'selected' : '' }}>Science,
                                    Technology, Engineering, and Mathematics</option>
                                <option value="GAS"
                                    {{ $user->studentInfo->academic_track == 'GAS' ? 'selected' : '' }}>General
                                    Academic Strand</option>
                                <option value="TVL"
                                    {{ $user->studentInfo->academic_track == 'TVL' ? 'selected' : '' }}>Technical
                                    Vocational Livelihood (TVL) Track</option>
                                <option value="ST"
                                    {{ $user->studentInfo->academic_track == 'ST' ? 'selected' : '' }}>Sports Track
                                </option>
                                <option value="ADT"
                                    {{ $user->studentInfo->academic_track == 'ADT' ? 'selected' : '' }}>Arts and
                                    Design Track</option>
                                <option value="other"
                                    {{ $user->studentInfo->academic_track == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>



                        <div class="px-4 my-2 w-full" id="otherTrackInput" style="display:none;">
                            <input type="text"
                                class="h-[50px] w-full rounded placeholder:text-[#4E4E4E] placeholder:font-poppins placeholder:text-[16px] px-[20px] border-2 border-[#D7D8D0]"
                                placeholder="Specify Academic Track" name="other_academic_track"
                                id="other-academic-track" disabled>
                        </div>

                        <script>
                            const academicTrackSelect = document.getElementById('academic-track');
                            const otherTrackInput = document.getElementById('otherTrackInput');

                            academicTrackSelect.addEventListener('change', function() {
                                if (academicTrackSelect.value === 'other') {
                                    otherTrackInput.style.display = 'block';
                                } else {
                                    otherTrackInput.style.display = 'none';
                                }
                            });
                        </script>

                    </div>
                    <div class="mx-8 my-2 font-poppins">
                        <h1 class="text-[18px]">Do you have any of the Following:</h1>
                        <div class="flex gap-2 justify-between w-9/12">
                            <div class="mt-3">
                                <label for="" class="text-[16px]">Computers:</label>
                                <div>
                                    <input type="checkbox" name="hasDesktop" id="" disabled
                                        {{ $user->studentInfo->has_computer ? 'checked' : '' }}>
                                    <label for="hasDesktop">Desktop</label>
                                </div>

                                <div>
                                    <input type="checkbox" name="hasLaptop" id=""disabled
                                        {{ $user->studentInfo->has_laptop ? 'checked' : '' }}>
                                    <label for="hasLaptop">Laptop</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="" class="text-[16px]">Mobiles:</label>
                                <div>
                                    <input type="checkbox" name="hasSmartphone" id=""
                                        value="1"disabled
                                        {{ $user->studentInfo->has_smartphone ? 'checked' : '' }}>
                                    <label for="hasSmartphone">Smartphone</label>
                                </div>

                                <div>
                                    <input type="checkbox" name="hasTablet" id=""disabled
                                        {{ $user->studentInfo->has_tablet ? 'checked' : '' }}>
                                    <label for="hasTablet">Tablet</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="text-[16px] whitespace-nowrap">Status of Internet
                                    Connectivity:</label>

                                <div>
                                    <input type="radio" required name="connectivity" id="stable"disabled
                                        value="Stable"
                                        {{ $user->studentInfo->internet_status == 'Stable' ? 'checked' : '' }}>
                                    <label for="stable">Stable</label>
                                </div>

                                <div>
                                    <input type="radio" required name="connectivity" id="not_stable"disabled
                                        value="Not Stable"
                                        {{ $user->studentInfo->internet_status == 'Not Stable' ? 'checked' : '' }}>
                                    <label for="not_stable">Not Stable</label>
                                </div>

                                <div>
                                    <input type="radio" required name="connectivity" id="none"disabled
                                        value="None"
                                        {{ $user->studentInfo->internet_status == 'None' ? 'checked' : '' }}>
                                    <label for="none">None</label>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="mx-8 text-lg">
                        <h1>Interview Guide:</h1>
                        <div class="flex justify-end my-1 ">
                            <h1 class="text-center w-[220px] ">Score</h1>
                        </div>
                        <div class="flex justify-between my-2">
                            <p>1. Background and Interest to the program</p>
                            <input type="text" name="interview1" id="interview1" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center "
                                value="{{ $user->studentInfo->interviewNo1 }}" required disabled>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>2. Ability to express one self</p>
                            <input type="text" name="interview2" id="interview2"
                                class="score border-2 border-[#D7D8D0] text-center "
                                value="{{ $user->studentInfo->interviewNo2 }}" required disabled>
                        </div>
                        <div class="flex justify-between my-2">
                            <p>3. Academic Potential</p>
                            <input type="text" name="interview3" id="interview3" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center "
                                value="{{ $user->studentInfo->interviewNo3 }}" required disabled>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>4. Extra Curricular Potential</p>
                            <input type="text" name="interview4" id="interview4" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center "
                                value="{{ $user->studentInfo->interviewNo4 }}" required disabled>
                        </div>

                        <div class="flex justify-between my-2">
                            <p>5. Potential to support learning</p>
                            <input type="text" name="interview5" id="interview5" placeholder=""
                                class="score border-2 border-[#D7D8D0] text-center "
                                value="{{ $user->studentInfo->interviewNo5 }}" required disabled>
                        </div>
                        <div class="flex justify-end">
                            <h1 class="text-center w-[200px]" id="averageScore">Average Score:</h1>
                            <h1 id="averageScoreValue" class="w-[208px] border-2 border-[#D7D8D0] text-center">
                                {{ ($user->studentInfo->interviewNo1 +
                                    $user->studentInfo->interviewNo2 +
                                    $user->studentInfo->interviewNo3 +
                                    $user->studentInfo->interviewNo4 +
                                    $user->studentInfo->interviewNo5) /
                                    5 }}




                            </h1>
                        </div>

                    </div>

                    <div class="mt-8 mx-8">
                        <table class="table-auto border border-solid border-black w-full">
                            <thead>
                                <tr class="justify-between">
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">5
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">4
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">3
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">2
                                    </th>
                                    <th class="border border-solid border-black text-center font-poppins w-1/5">1
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="justify-between">
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Excellent</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Very Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Less Satisfactory</td>
                                    <td class="border border-solid border-black text-center font-poppins w-1/5">
                                        Limited Potential</td>
                                </tr>
                            </tbody>
                        </table>

                        <div>
                            <h1 class="font-poppins text-lg mt-8">Remarks</h1>
                        </div>
                        <div class="flex">
                            <textarea class="p-4 w-full border border-solid border-black text-left font-poppins" name="remarks" id=""
                                cols="30" disabled rows="5" style="resize: none;">{{ $user->studentInfo->remarks }}</textarea>
                        </div>


                        <input type="text" hidden value="{{ $user->id }}" name="user_id">




                    </div>

                </div>
                <div class="flex items-center justify-end gap-3 mt-4">

                    <div>
                        <button onclick="printDiv()"
                            class="font-bold text-white bg-[#2B6CE6] hover:bg-[#134197] rounded-[8px] font-poppins text-lg py-3 px-12 transition-colors duration-200">Print</button>


                    </div>
                    <div class="">
                        <a href="{{ route('admin.dashboard.show-review') }}"
                            class="font-bold text-white bg-[#2B6CE6] hover:bg-[#134197] rounded-[8px] font-poppins text-lg py-3 px-12 transition-colors duration-200">Back</a>
                    </div>
                </div>

            </section>
        </div>


        <script>
            const inputDigits = document.querySelectorAll('.digit-only');

            inputDigits.forEach(element => {
                element.addEventListener("input", function(e) {
                    e.target.value = e.target.value.replace(/[^0-9.]/g, '');
                })
            });



            const inputElements = document.querySelectorAll('.score');
            inputElements.forEach((inputElement) => {
                inputElement.addEventListener("input", function(e) {
                    // Remove non-numeric characters from the input
                    e.target.value = e.target.value.replace(/[^1-5]/g, '').substring(0, 1);;
                    // Allows decimals as well
                    calculateAverage();
                });
            });


            function calculateAverage() {
                // Get all input values, convert to numbers, and filter out any NaN values
                const values = Array.from(inputElements)
                    .map((inputElement) => parseFloat(inputElement.value))
                    .filter((value) => !isNaN(value));

                // Calculate the average
                const average = values.length > 0 ? values.reduce((a, b) => a + b) / values.length : 0;

                // Update the average score display
                const averageScoreValue = document.getElementById("averageScoreValue");
                averageScoreValue.textContent = average.toFixed(2); // Display with 2 decimal places
            }
        </script>

        <script>
            function validateGPA(input) {
                var gpaError = document.getElementById('gpaError');
                var gpaValue = parseFloat(input.value);

                if (isNaN(gpaValue) || gpaValue < 75 || gpaValue > 100) {
                    input.setCustomValidity(''); // Clear the browser's built-in error message

                    if (isNaN(gpaValue)) {
                        gpaError.textContent = 'Please enter a valid number.';
                    } else if (gpaValue < 75) {
                        gpaError.textContent = 'GPA cannot be lower than 75.';
                    } else {
                        gpaError.textContent = 'GPA cannot be higher than 100.';
                    }
                } else {
                    input.setCustomValidity('');
                    gpaError.textContent = '';
                }
            }
        </script>

        <script>
            function validateYear(input) {
                var yearError = document.getElementById('yearError');
                var yearValue = parseInt(input.value);

                if (isNaN(yearValue) || input.value.length !== 4 || yearValue < 1900 || yearValue > 2099) {
                    input.setCustomValidity('');

                    if (isNaN(yearValue) || input.value.length !== 4) {
                        yearError.textContent = 'Please enter a valid four-digit year.';
                    } else if (yearValue < 1900) {
                        yearError.textContent = 'Year cannot be earlier than 1900.';
                    } else {
                        yearError.textContent = 'Year cannot be later than 2099.';
                    }
                } else {
                    input.setCustomValidity('');
                    yearError.textContent = '';
                }
            }

            function printDiv() {
                var printContents = document.getElementById('printSection').innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>




    </body>

</html>
