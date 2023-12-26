<table class="w-full font-poppins border-collapse   text-md text-left rtl:text-right text-gray-500 table-auto ">
    <thead class="border-b text-[#26386A] border-[#D9DBE3] font-semibold text-center whitespace-nowrap">
        <tr>
            <td class="px-6 py-2">Ranking No.</td>
            <td class="px-6 py-2">Applicant Name</td>
            <td class="px-6 py-2">Interview Average</td>
        </tr>
    </thead>

    <tbody class="text-center ">

        @if ($results->count() == 0)
            <td></td>
            <td class="px-6 py-3">No data found in database</td>
        @else
            @foreach ($results as $index => $result)
                <tr class="{{ $index % 2 == 0 ? 'bg-[#F6F8FF]' : 'bg-white' }} border-b border-gray-100">
                    <td class="px-6 py-2">{{ $index + 1 }}</td>
                    <td class="px-6 py-2">
                        {{ $result->user->last_name . ', ' . $result->user->first_name }}
                    </td>
                    <td class="px-6 py-2">{{ $result->measure_a_score }}</td>
                </tr>
            @endforeach
        @endif




    </tbody>
</table>
