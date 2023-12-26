<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equali | AddQuestion </title>
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
            <nav class="ml-[218px] flex justify-end items-center border-b border-[#D9DBE3] h-[60px] bg-white px-4">

                @include('layout.user-popup')
            </nav>
            <section class="ml-[218px] main ">

                @include('layout.popup')
                <form action="{{ route('admin.dashboard.update-question', $question) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="bg-white mx-4 rounded-[12px]  h-[587px] p-4">
                        <div class="absolute  z-80 m-2">
                            @if ($question->image_path != null)
                                <a id="openPopup" class="hover:cursor-pointer"><i
                                        class='bx bx-image-add bx-sm text-white '></i></a>
                            @endif
                        </div>

                        <div class="bg-[#4c4a67] h-[250px]  rounded-[8px] flex justify-between p-4">

                            @if ($question->image_path != null)
                                <div id="preview"
                                    class="w-1/4  py-4 ml-[16px] rounded-xl items-center bg-[#28273a] mt-8">
                                    <img id="imagePreview"
                                        src="{{ asset('storage/questions/' . $question->image_path) }}"
                                        class=" mx-auto text-center" alt="Image Preview"
                                        style="max-width: 100%; max-height: 160px;">

                                </div>
                            @endif


                            <div class="w-full m-4 mt-12 flex items-center">
                                <input
                                    class="bg-transparent text-[28px] mx-auto text-center  flex items-center  py-8 w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                    placeholder="Type Question Here" name="question_text" required autocomplete="off"
                                    value="{{ $question->question_text }}">
                            </div>

                        </div>

                        <div>
                            <div class="h-[163px] my-7 flex justify-evenly gap-4 ">
                                @foreach ($question->choices->where('choice_text', '!=', 'No Answer') as $key => $choice)
                                    <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                        <input type="text"
                                            class="bg-transparent text-[16px] placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                            placeholder="Type Question Here" name="choice_text[]"
                                            value="{{ $choice->choice_text }}" required>

                                        <input
                                            class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 "
                                            type="radio" id="choice" name="correct_choice"
                                            value="{{ $key + 1 }}"
                                            @if ($choice->is_correct) checked @endif />
                                    </div>
                                @endforeach

                                {{-- @foreach ($question->choices as $key => $choice)
                            
                                <div class="w-full bg-[#4c4a67] rounded-lg relative">
                                    <input type="text"
                                        class="bg-transparent text-[16px]  placeholder:font-poppins mx-auto text-center w-full h-full placeholder:text-[#EBEFF9] caret-white text-white"
                                        placeholder="Type Question Here" name="choice_text[]"
                                        value="{{ $choice->choice_text }}" required>

                                    <input
                                        class="absolute top-0 right-0 m-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 "
                                        type="radio" id="choice" name="correct_choice" value="{{ $key + 1 }}"
                                        @if ($choice->is_correct) checked @endif />
                                </div>
                            @endforeach --}}

                            </div>
                            <div class="flex justify-end w-full">


                                <div class="w-2/12 mb-8">
                                    <input type="submit" value="Save Question"
                                        class="text-lg font-poppins font-normal mr-2 w-full h-[50px] rounded-[18px] bg-[#2B6CE6] hover:bg-[#134197] transition-colors duration-200 text-white">

                                </div>


                            </div>


                        </div>

                </form>



                <div id="popup"
                    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div class="bg-white rounded-lg p-4 w-4/12 relative">
                        <button type="button" id="back"
                            class="absolute top-2 right-2  text-gray-600 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors duration-200 ml-2"><i
                                class='bx bx-x'></i>
                        </button>
                        <h2 class="text-lg font-semibold mb-8">Upload a Image</h2>

                        <div>
                            <div class="h-[200px]">
                                <div class="my-4 flex justify-center py-12" id="dragContainer">
                                    <label for="imageInput"
                                        class="cursor-pointer bg-[#e4eaf5] text-[#2B6CE6] px-4 py-2 rounded">
                                        <span class="font-medium">Upload from Device</span>
                                        <input type="file" name="img" id="imageInput" accept="image/*"
                                            class="hidden">
                                    </label>

                                    <img id="previewImage" class="hidden max-w-full max-h-36 mb-2" alt="Preview"
                                        draggable="true" ondragstart="handleDragStart(event)">
                                </div>


                            </div>
                        </div>


            </section>

        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('imageInput');
                const imagePreview = document.getElementById('imagePreview');

                imageInput.addEventListener('change', function() {
                    const file = imageInput.files[0];

                    if (file) {
                        const reader = new FileReader();


                        const fileSizeLimit = 10 * 1024 * 1024; // 10MB in bytes
                        if (file.size > fileSizeLimit) {
                            alert('File size exceeds the limit. Please choose a smaller file.');
                            document.getElementById('form').reset();
                            return;
                        }

                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            document.getElementById("preview").classList.remove("hidden");
                            document.getElementById("preview").classList.add("flex");

                            document.getElementById("popup").classList.add("hidden");
                        };

                        reader.readAsDataURL(file);
                    } else {

                        imagePreview.src = '';
                        imagePreview.classList.add('hidden');
                    }
                });

            });



            let imgPreview = document.getElementById("preview")

            document.getElementById('openPopup').onclick = () => {
                document.getElementById("popup").classList.remove("hidden");
            }
            document.getElementById("back").addEventListener("click", function() {
                document.getElementById("popup").classList.add("hidden");
            });
        </script>
    </body>

</html>
