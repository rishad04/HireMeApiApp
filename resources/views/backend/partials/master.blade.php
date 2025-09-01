<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



   <title>@yield('title', 'Hire Me')</title>

<meta name="description" content="" />

<link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/Lexend/lexend-fonts.css') }}" />

<!-- Tom Select CSS -->
{{-- <link href="{{ asset('backend/assets/vendor/tomselect/css/tom-select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css"> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css')}}" />

{{-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}

{{-- <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" /> --}}

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

<!-- Tom Font awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- Move SweetAlert2 CSS to be last -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" />

<style>
    /* Custom SweetAlert2 toast styles override */
    /* .swal2-toast .swal2-title {
        color: #333 !important;
        font-size: 1rem !important;
        font-weight: 500;
    } */
</style>

@yield('css')

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('backend/assets/vendor/js/helpers.js')}}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('backend/assets/js/config.js')}}"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Menu -->
      @include('backend.partials.sidebar')
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">

        <!-- Navbar -->
        @include('backend.partials.header')
        <!-- / Navbar -->

        @yield('container')

        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                    document.write(new Date().getFullYear());
                                    </script>
                                    , rishadhossain
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{ asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{ asset('backend/assets/vendor/js/menu.js')}}"></script>


        {{-- ck editor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>


        <script src="https://kit.fontawesome.com/688da3933f.js" crossorigin="anonymous"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- tomselect -->
        {{-- <script src="{{ asset('backend/assets/vendor/tomselect/js/tom-select.complete.min.js') }}"></script> --}}

        <!-- Main JS -->
        <script src="{{ asset('backend/assets/js/main.js')}}"></script>
         {{-- <script src="{{ asset('backend/assets/js/dev_custom.js') }}"></script> --}}
        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

          <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

        @if (session('success'))
        <script>console.log("Session Success Message:", @json(session('success')));
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'center',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
@endif


    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'center',
                icon: 'error',
                title: @json(session('error')),
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            Swal.fire({
                toast: true,
                position: 'center',
                icon: 'warning',
                title: @json(session('warning')),
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif




        {{-- Image Upload view --}}

    <script>
        const selectedFilesMap = {};

        function handleFileSelect(event, inputId, previewContainerId, isMultiple = true) {
            const files = Array.from(event.target.files);
            selectedFilesMap[inputId] = isMultiple ? [...files] : [files[0]];
            updatePreviews(inputId, previewContainerId, isMultiple);

            // Store data URLs for re-render on back
            saveToLocalStorage(inputId);
        }

        function saveToLocalStorage(inputId) {
            const files = selectedFilesMap[inputId];
            const readers = files.map(file => {
                return new Promise(resolve => {
                    const reader = new FileReader();
                    reader.onload = () => resolve(reader.result);
                    reader.readAsDataURL(file);
                });
            });

            Promise.all(readers).then(results => {
                localStorage.setItem(`preview_${inputId}`, JSON.stringify(results));
            });
        }
    </script>

    <script>
        window.addEventListener("DOMContentLoaded", () => {
            ['main_photo', 'banners', 'damage_photos'].forEach(inputId => {
                const previews = JSON.parse(localStorage.getItem(`preview_${inputId}`) || "[]");
                if (previews.length > 0) {
                    const fakeFiles = previews.map(dataUrl => dataURLtoFile(dataUrl, 'image.jpg'));
                    selectedFilesMap[inputId] = fakeFiles;
                    updatePreviews(inputId, `image_preview_${inputId}`, inputId !== 'main_photo');
                }
            });
        });

        // Helper to turn base64 to File object
        function dataURLtoFile(dataUrl, filename) {
            const arr = dataUrl.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);
            for (let i = 0; i < n; i++) u8arr[i] = bstr.charCodeAt(i);
            return new File([u8arr], filename, {
                type: mime
            });
        }
    </script>

    <script>
        function updatePreviews(inputId, previewContainerId, isMultiple) {
            const previewContainer = document.getElementById(previewContainerId);
            const selectedFiles = selectedFilesMap[inputId] || [];

            previewContainer.innerHTML = "";

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement("div");
                    wrapper.classList.add("position-relative", "border", "rounded");
                    wrapper.style.width = "100px";
                    wrapper.style.height = "100px";
                    wrapper.style.backgroundImage = `url('${e.target.result}')`;
                    wrapper.style.backgroundSize = "cover";
                    wrapper.style.backgroundPosition = "center";

                    if (isMultiple) {
                        const closeBtn = document.createElement("span");
                        closeBtn.innerHTML = "✕";
                        closeBtn.classList.add("position-absolute", "top-0", "end-0", "text-danger", "bg-white", "px-1",
                            "rounded");
                        closeBtn.style.cursor = "pointer";
                        closeBtn.style.zIndex = "2";
                        closeBtn.onclick = function() {
                            selectedFilesMap[inputId].splice(index, 1);
                            updatePreviews(inputId, previewContainerId, isMultiple);
                            updateInputFiles(inputId);
                        };
                        wrapper.appendChild(closeBtn);
                    }

                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            updateInputFiles(inputId);
        }
    </script>

    <script>
        function filterOnEnter(event,filterItems) {

            console.log('here');
            console.log(filterItems);

            event.preventDefault();
            var url = new URL(window.location.href);
            
            filterItems.forEach(filterItem => {
            url.searchParams.set(filterItem.param, $('#' + filterItem.input_id).val());
            });

            window.location.href = url.href;
            $('#clearButton').show();
        }

        // Function to clear filters and reset the URL
        function clearFilters(event) {

            event.preventDefault();
            var url = new URL(window.location.href);
            
            // Reset the search params (remove filters)
            filterItems.forEach(filterItem => {
                url.searchParams.delete(filterItem.param);
            });

            window.location.href = url.href;
            // $('#clearButton').show();
        
        }
    </script>

    {{-- charts  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



        @yield('js')
    </body>
</html>
