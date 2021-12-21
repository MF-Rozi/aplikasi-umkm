@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb-section -->
<div class="breadcrumb-section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Mari Liaht Kontak Kami</p>
                    <h1>Kontak Kami</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="form-title">
                    <a href="#map">
                        <h1>Datangi Tempat Kami</h1>
                    </a>
                    {{-- <h2>Have you any question?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est, assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse natus!</p> --}}
                </div>
                <div id="form_status"></div>
                <div class="contact-form">

                    <a href="#map">
                        <p><span style="color:orange">Klik Disini!!</span></p>
                    </a>

                    {{-- <form type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                        <p>
                            <input type="text" placeholder="Name" name="name" id="name">
                            <input type="email" placeholder="Email" name="email" id="email">
                        </p>
                        <p>
                            <input type="tel" placeholder="Phone" name="phone" id="phone">
                            <input type="text" placeholder="Subject" name="subject" id="subject">
                        </p>
                        <p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
                        <input type="hidden" name="token" value="FsWga4&@f6aw" />
                        <p><input type="submit" value="Submit"></p>
                    </form> --}}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form-wrap">
                    <div class="contact-form-box">
                        <h4><i class="fas fa-map"></i> Alamat Toko</h4>
                        <p>Jl. Sultan Ibrahim,<br> Candirejo,<br> Pasir Penyu,<br> Kabupaten Indragiri Hulu,<br> Riau 29353</p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="far fa-clock"></i> Jam Buka</h4>
                        <p>Setiap Hari: 8 AM to 10 PM</p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="fas fa-address-book"></i> Kontak</h4>
                        <p>Phone: 082284678780 <br> Email: m.fakhrulrozi10@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contact form -->

<!-- find our location -->
<div class="find-location blue-bg " id="map">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p> <i class="fas fa-map-marker-alt"></i>Lokasi Kami</p>
            </div>
        </div>
    </div>
</div>
<!-- end find our location -->

<!-- google map section -->
<div class="embed-responsive embed-responsive-21by9">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7332715216507!2d102.28733101450867!3d-0.3741071354161692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e29918567740ef1%3A0xf6ccc30ee90228eb!2sKedai%20kopi%20qyat!5e0!3m2!1sid!2sid!4v1640018591951!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" class="embed-responsive-item"></iframe>
</div>
<!-- end google map section -->

@endsection
