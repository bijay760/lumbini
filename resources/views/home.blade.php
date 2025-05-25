@extends('layouts.app')

@section('title', 'Lumbani Innovate - Home')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <header class="masthead">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-6">
                    <div class="text-left text-white">
                        <h1 class="mb-5">Our first project - a real estate project in Nepalgunj-Kohalpur road.</h1>
                        <form class="form-subscribe" id="contactForm">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('land.booking') }}" class="btn btn-lg" id="submitButton" type="submit">Book Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-7 col-lg-6">
                    <div class="my-3">
                        <a href="{{ asset('backend/assets/images/land%20(1).jpg') }}" data-lightbox="land">
                            <img src="{{ asset('backend/assets/images/landimg.png') }}" class="img-fluid" alt="">
                        </a>
                        <a href="{{ asset('backend/assets/images/land%20(2).jpg') }}" data-lightbox="land"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="showcase">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-lg-4 order-2 order-lg- text-white showcase-img"
                     style="background-image: url('https://www.bflexion.com/themes/custom/bflexion/images/background-home.png')">
                </div>
                <div class="col-lg-7 ms-auto order-1 order-lg- my-auto showcase-text">
                    <h2>About Us</h2>
                    <p class="lead mb-0">
                        <b>Lakshya Capital Ltd.</b> is a subsidiary company of Lakshya Holdings Ltd. established by aiming
                        to invest in share market, derivative market, real estate and other innovative means of investment. Its
                        authorized capital is NPR. 1 Billion.
                        Being a subsidiary company of Lakshya Holdings Ltd. we have provided opportunity to the shareholders
                        of Lakshya Holdings Ltd. to take share ownership at first instance. We will open the opportunities
                        for others as well fulfilling the legal requirements.
                    </p>

                    <div class="abt-img"><img src="{{ asset('backend/assets/images/abt.jpg') }}" class="img-fluid" alt=""></div>

                    <h2>Our Projects</h2>
                    <p class="lead mb-0">
                        Our <b>first project</b> has been developed with a real estate project in Nepalgunj. It is a 44
                        kattha land development project situated in Nepalgunj-Kohalpur road. We are planning to develop 6000 Square feet
                        for vehicle showrooms which can accommodate 4 large showrooms consisting spare parts and servicing
                        areas for the four wheel or two wheeler automobile brands. Then 16,000 square feet area for the godam. All
                        these developed commercial properties will be rented out.
                        From the day of incorporation, we have already started investing into share market. Since the market
                        gone down, it is good time of entry in the share market.
                    </p>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-5 order-lg- text-white showcase-img"
                     style="background-image: url('https://static.wixstatic.com/media/12316e44d26649c69a935420b4dbb784.jpg/v1/fill/w_640,h_500,fp_0.50_0.50,q_80,usm_0.66_1.00_0.01,enc_auto/12316e44d26649c69a935420b4dbb784.jpg')">
                </div>
                <div class="col-lg-6 me-auto my-auto showcase-text">
                    <h2>Super Benefit for Shareholders</h2>
                    <p class="lead mb-0">
                        All the shareholders are owners of the company. Therefore, providing maximum benefit to the
                        shareholders is always in top priority of the company. Therefore both our old shareholders and
                        new coming shareholders will get a direct discount on land purchase. Therefore, we invite people
                        to be our shareholders.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bod">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <h2 class="mb-5">Board of Directors</h2>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>Dr. Keshav Prasad Shrestha</h5>
                                <p class="font-weight-light mb-0">Chairman</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>Kishor Paudel</h5>
                                <p class="font-weight-light mb-0">Director</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>Rajesh Kumar Pathak</h5>
                                <p class="font-weight-light mb-0">Director</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 bg">
                    <div class="row">
                        <h2 class="mb-5">Contact Us</h2>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>Satdobato-15, Lalitpur, Nepal</h5>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5><span class="enem" data-mbx="tcatnoc" data-www="erahsayhskal" data-ext="moc"
                                          style="cursor:pointer;" onclick="sendMail(this)"></span></h5>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>01-5402777</h5>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="bod-item">
                                <h5>www.lakshyashare.com</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landbook bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2>Land Booking</h2>
                    <br><br>
                    <p>We have policy of providing plotted, developed ghaderi land direct 10% discount for our shareholders.
                        Therefore, If you have already made share application amount, you are eligible for pre-booking of the land
                        in 10% discount.</p>

                    <p> There are 4 categories of the land. Being nearer to the highway are bit expensive and vice versa.
                        They are tabulated below. Each ghaderi land piece has more than 10 meter front face so they are enough to
                        build residential houses. Below prices of 10 dhur land but in reality they range from 10 dhur to 13 dhur.
                        Therefore, later depending upon your specific choices of the land, the total price calculation of the land
                        may vary.</p>
                    <p>We also have arrangements with banks, finance and cooperatives to do financing if you are eligible to
                        take loan from the bank. You need to do 30% down payment and we will manage 70% financing for you. Please
                        note that this is not a commitment for making available of land because there is already huge demand of
                        this land. Final booking of the land will be in your name only when you deposit at least 30% of the land
                        price. After depositing 30% price of the land price, you will get 30 days maximum time to make it 100%
                        payment (of course you can apply for loan with our help).</p>
                </div>
                <div class="col-md-5">
                    <div class="border table-responsive p-3">
                        <table class="table  table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>Land Category</th>
                                <th>Price for 10 Dhur for Public</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>A</td>
                                <td>45,00,000</td>
                            </tr>
                            <tr>
                                <td>B</td>
                                <td>40,00,000</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>38,00,000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="border p-2">
                        <a href="{{ asset('backend/assets/images/land2.jpg') }}" data-lightbox="land">
                            <img src="{{ asset('backend/assets/images/land2.jpg') }}" class="img-fluid d-block m-auto" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landbook bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2>NOTICE</h2>
                    <br><br>
                </div>
                <div class="col-md-8 shadow-sm border bg-white p-3">
                    <span class="notice-container">
                        <h5 class="text-center mb-3">
                            <strong><u> गाडीको शोरुम निर्माण तथा संचालन प्रस्ताव आव्हान</u></strong>
                        </h5>
                        <br>
                        <p>
                            यस कम्पनीको हकभोग स्वामित्वमा रहेको नेपालगंज कोहलपुर रोडमा राँझा एअरपोर्ट देखि १.५
                            किलोमीटर उत्तर (कोहलपुर तर्फ) अवस्थित ५ कठ्ठा जमीनमा २ वटा सवारी साधनको शोरुम
                            निर्माण गरि संचालन गर्नुपर्ने भएकोले इच्छुक व्यक्ति, फर्म वा कम्पनीले इमेल मार्फत्
                            प्रस्ताव पेश गर्नुहुन वा तल दिईएको गुगल लिंकमा गै फारम भर्नुहुन अनुरोध गरिन्छ । <br><br>

                            शोरुम निर्माण हुने जग्गाको पूर्ण तयारी भैसकेको र अवलोकन गर्न चाहनुहुने महानुभावहरुले
                            तलको फोनमा सम्पर्क गर्न सक्नुहुनेछ । <br><br>

                            इमेल वा गुगल फर्मबाहेक अन्य फरक माध्यमबाट आएका प्रस्तावहरु स्वीकार गरिनेछैन ।
                            प्रस्ताव स्वीकार गर्ने वा नगर्ने अन्तिम अधिकार कम्पनीमा सुरक्षित रहेको छ । <br><br>

                            <br>
                            <u><b>थप जानकारीको लागि</b></u><br>
                            लक्ष्य क्यापिटल लिमिटेड <br>
                            मोबाइलः ९८५८०२११६६ <br>
                            इमेलः <span class="enem email-link"
                                        data-mbx="tcatnoc"
                                        data-www="erahsayhskal"
                                        data-ext="moc" style="cursor:pointer;" onclick="sendMail(this)"></span> <br>
                            Link: <a href="{{ route('home') }}">www.lakshyashare.com</a>
                        </p>
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection
