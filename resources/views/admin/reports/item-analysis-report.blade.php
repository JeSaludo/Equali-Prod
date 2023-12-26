<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | Overview </title>
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
        <div class="min-h-screen  bg-[#F7F7F7]">
            @include('layout.danger-alert')
            @include('layout.sidenav', ['active' => 0])

            <nav class="ml-[218px] flex justify-between items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                <h1 class="text-[#26386A] text-[18px]  font-bold font-raleway ">Reports </h1>


                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')


                <div class="flex  mx-4 mt-1 justify-between items-center">
                    <h1 class="text-[#26386A] mx-4 font-bold text-xl  py-2">Item Analysis</h1>
                    <form action="{{ route('export.item-analysis-result') }}" method="post">
                        @csrf
                        <input name="selectedYear" type="hidden" value="{{ $selectedYear }}">


                        <button type="submit"
                            class="bg-[#365EFF] hover:bg-[#384b94] font-poppins text-white py-1 px-4 rounded-lg">
                            Export Report
                        </button>
                    </form>

                </div>
                <div class="mx-5 w-[140px]">
                    <form action="{{ route('admin.dashboard.item-analysis-report') }}" method="GET" id="yearForm">
                        <select id="year" name="selected_year"
                            class="font-poppins bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            onchange="document.getElementById('yearForm').submit()">
                            <option value="" selected>Select Year</option>
                            @foreach ($uniqueYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="flex mx-4 mb-4" id="navLinks">

                    <a href="{{ route('admin.dashboard.item-analysis-chart') }}"
                        class="font-poppins   text-slate-500  nav-link whitespace-nowrap">Question Chart</a>
                    <a href="{{ route('admin.dashboard.item-analysis-report') }}"
                        class="font-poppins active text-slate-500 nav-link   whitespace-nowrap">Summary</a>


                    <a href="#" class="font-poppins  text-slate-500 w-full no-hover-underline"></a>
                </div>



                <div class="flex justify-between mx-4 my-2">






                </div>



                <div class="bg-white mx-4 relative  border   border-[#D9DBE3] shadow-md rounded-lg my-4">
                    <div class="overflow-x-auto overflow-y-auto">
                        <table id="item-analysis-table"
                            class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
                            <thead
                                class="border-b  text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
                                <tr>
                                    <td class="px-6 py-2">Item </td>
                                    <td class="px-6 py-2 text-center">Difficulty Index</td>
                                    <td class="px-6 py-2 text-center">Difficult Level</td>
                                    <td class="px-6 py-2 text-center">Status</td>
                                    <td class="px-6 py-2">Action </td>

                                </tr>
                            </thead>

                            <tbody class="text-left ">

                                @php
                                    $dataFound = false;
                                @endphp

                                @if ($items->count() == 0)
                                    <tr>
                                        <td class="px-6 py-3">
                                            <p>No data found in the database</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($items as $index => $item)
                                        <tr
                                            class="text-center mx-auto {{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                                            <td class="px-6 py-3">
                                                {{ $item->id }}

                                            </td>

                                            <td class="px-6 py-3">

                                                {{ $item->di }}



                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">


                                                @if ($item->di < 0.15)
                                                    Very Difficult
                                                @elseif ($item->di > 0.14 && $item->di < 0.3)
                                                    Difficult
                                                @elseif ($item->di > 0.29 && $item->di < 0.71)
                                                    Moderate
                                                @elseif ($item->di > 0.7 && $item->di < 0.86)
                                                    Easy
                                                @elseif ($item->di > 0.85)
                                                    Very Easy
                                                @endif



                                            </td>


                                            <td class="px-6 py-3 whitespace-nowrap ">


                                                @if ($item->di < 0.15)
                                                    To be discarded
                                                @elseif ($item->di > 0.14 && $item->di < 0.3)
                                                    To be revised
                                                @elseif ($item->di > 0.29 && $item->di < 0.71)
                                                    Very Good Items
                                                @elseif ($item->di > 0.7 && $item->di < 0.86)
                                                    To be revised
                                                @elseif ($item->di > 0.85)
                                                    To be discarded
                                                @endif


                                            </td>



                                            <td class="px-6 py-3 text-center">



                                                @if ($item->di < 0.15)
                                                    <p class=" py-1 px-2">Discard</p>
                                                @elseif ($item->di > 0.14 && $item->di < 0.3)
                                                    <p class=" py-1 px-2 ">Revise</p>
                                                @elseif ($item->di > 0.29 && $item->di < 0.71)
                                                    <p class=" py-1 px-2 ">Retain</p>
                                                @elseif ($item->di > 0.7 && $item->di < 0.86)
                                                    <p class=" py-1 px-2 ">Revise</p>
                                                @elseif ($item->di > 0.85)
                                                    <p class=" py-1 px-2 ">Discard</p>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach


                                @endif

                            </tbody>
                        </table>
                        <nav
                            class="bg-white border-t rounded-b-lg text-[14px] font-poppins border-[#D9DBE3] w-full py-2 flex justify-start pl-2 items-center">




                        </nav>

                    </div>

                </div>



            </section>

        </div>

    </body>

</html>
