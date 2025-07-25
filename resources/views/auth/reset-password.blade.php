<x-login.layout>
    <div class="row g-0">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-5 p-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="assets/images/logo-sm.svg" alt="" height="28"> <span
                                    class="logo-txt">Minia</span>
                            </a>
                        </div>
                        <div class="auth-content my-auto">
                            <div class="text-center">
                                <h5 class="mb-0">Reset Password</h5>
                                <p class="text-muted mt-2">Reset Password with Minia.</p>
                            </div>
                            <div class="alert alert-success text-center my-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            <form class="mt-4" action="{{ route('reset-password-proses') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="New Password"required>
                                        <a href="javascript:;" class="input-group-text bg-transparent "><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Confirm Password" required>
                                            <a href="javascript:;" class="input-group-text bg-transparent "><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <button class="btn btn-primary w-100 waves-effect waves-light"
                                       style="background-color: #ff797a; border-color: #ff797a; color: #fff; type="submit">Send</button>
                                </div>
                            </form>

                            <div class="mt-5 text-center">
                                <p class="text-muted mb-0">Remember It ? <a href="{{ route('login') }}"
                                        class="text-primary fw-semibold"> Sign In </a> </p>
                            </div>
                        </div>
                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Minia . Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end auth full page content -->
        </div>
        <!-- end col -->
        <div class="col-xxl-9 col-lg-8 col-md-7">
            <div class="auth-bg pt-md-5 p-4 d-flex">
                <div class="bg-overlay bg-primary"></div>
                <ul class="bg-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <!-- end bubble effect -->
                 <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7">
                        <div class="p-0 p-sm-4 px-xl-0">
                            <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                {{-- <div
                                    class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div> --}}
                                <!-- end carouselIndicators -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Melita Kitchen bukan sekadar
                                                tempat makan, tapi pengalaman kuliner yang memanjakan lidah dan hati.
                                                Menu variatif dan pelayanan ramah membuat saya ingin selalu kembali.”
                                            </h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-1.jpg"
                                                            class="avatar-md img-fluid rounded-circle" alt="...">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">Richard Drews
                                                        </h5>
                                                        <p class="mb-0 text-white-50">Web Designer</p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Sistem penilaian karyawan
                                                berbasis MOORA yang diterapkan di Melita Kitchen sangat adil dan
                                                transparan. Kinerja kami dihargai secara objektif, memotivasi untuk
                                                terus berkembang.”</h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-2.jpg"
                                                            class="avatar-md img-fluid rounded-circle" alt="...">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">M Nurul Amin
                                                        </h5>
                                                        <p class="mb-0 text-white-50">Manager Utama</p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Bekerja di Melita Kitchen
                                                memberikan saya kesempatan untuk bertumbuh. Penilaian berkala dengan
                                                metode MOORA membuat kontribusi setiap karyawan terasa bermakna.”</h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <img src="assets/images/users/avatar-3.jpg"
                                                        class="avatar-md img-fluid rounded-circle" alt="...">
                                                    <div class="flex-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">Rossy</h5>
                                                        <p class="mb-0 text-white-50">Manager
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- end carousel-inner -->
                            </div>
                            <!-- end review carousel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

</x-login.layout>
