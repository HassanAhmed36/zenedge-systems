<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Secure 2 Pay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        
<link href="https://terminal.zenedgesystems.co/assets/logo/Zenedge-Systems-logo-04.png" rel="icon" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            font-family: "Exo 2", sans-serif;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: none;
        }

        .is-invalid + .invalid-feedback {
            display: block;
        }
        
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height:99vh">
    <div class="container shadow-lg mt-3 border rounded-4 bg-white p-5">
        <div class="row">
            <div class="col-lg-6 col-12 col-md-12 col-sm-12 pt-5">
                <div class="container">
                    @if (isset($data['data']['brand']['image']))
                        <img src="https://secured2pay.com/{{ $data['data']['brand']['image'] }}" alt="" class="w-25">
                    @endif
                    <div class="my-4">
                        <h4>Package Name</h4>
                        <p>{{ $data['data']['service']['name'] }}</p>
                        @php
                            $amount = $data['data']['amount'];
                            $taxPercentage = $data['data']['tax'];
                            $taxAmount = ($amount * $taxPercentage) / 100;
                            $totalAmount = $amount + $taxAmount;
                        @endphp

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Services Charges</td>
                                    <td>{{ number_format($amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Tax {{ $taxPercentage }}%</td>
                                    <td>{{ number_format($taxAmount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ number_format($totalAmount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif

                    @session('error')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                </div>
            </div>
            <div class="col-lg-6 col-12 col-md-12 col-sm-12 pt-5">
                <div class="container">
                    <h4 class="mb-4">Contact Information</h4>
                    <div class="my-3">
                        <form id="contactForm" action="{{ route('process.payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ number_format($totalAmount, 2) }}">
                            <div class="row">
                                @php
                                    if ($data['data']['merchant']['payment_gateway_type'] == 'Paypal') {
                                        $val = 1;
                                    } else {
                                        $val = 2;
                                    }
                                @endphp
                                <input type="hidden" name="payment_method" value="{{ $val }}">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12  mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control"
                                        placeholder="Enter your Name" name="name" value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid name.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12  mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control"
                                        placeholder="Enter your email" name="email" value="{{ old('email') }}" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12  mb-4">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" id="phone" class="form-control"
                                        placeholder="Enter your phone number" name="number" value="{{ old('number') }}" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid phone number.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12  mb-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" class="form-control"
                                        placeholder="Enter your address" name="address" value="{{ old('address') }}" required>
                                    <div class="invalid-feedback">
                                        Please enter your address.
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12  mb-4">
                                    <label for="country" class="form-label">Country</label>
                                    <select name="country" id="country" class="form-select">
                                        <option value="">Select a Country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cabo Verde">Cabo Verde</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
                                        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Eswatini (fmr. "Swaziland")">Eswatini (fmr. "Swaziland")</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Holy See">Holy See</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="North Macedonia (formerly Macedonia)">North Macedonia (formerly Macedonia)</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestine State">Palestine State</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="South Sudan">South Sudan</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States of America">United States of America</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>

                                    <div class="invalid-feedback">
                                        Please enter your country.
                                    </div>
                                </div>
                            </div>

                            <h4 class="mb-4">Card Information</h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                    <div id="card-element" class="py-2 form-control mb-4">
                                    </div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitBtn" class="btn btn-dark">Pay Now</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    var stripe = Stripe('pk_live_51Mqq0JB7aKskVG8xbdfBQGZg2TV26tTmUwQxy20UFVt36N7Lq0fiBHECxhdMraJJ0FwT4miCdNmju1hgpodDTTEN00JvUroHfy');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('contactForm');
    var submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(event) {
     let editBtn = document.getElementById('submitBtn');
      
     editBtn.setAttribute('disabled', true);

    editBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            proccessing...
    `;
        
        
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                var formData = new FormData(form);

                fetch('/process-payment', {
                    method: 'POST',
                    body: formData,
                }).then(function(response) {
                    return response.json();
                }).then(function(result) {
                    console.log(result);
                    if (result.success) {
                        window.location.href = '/success';
                    } else {
                    var cardErrors = document.getElementById('card-errors');
                    cardErrors.style.color = 'red';
                    cardErrors.textContent = result.error;
                    
                    let editBtn = document.getElementById('submitBtn');
      
                    editBtn.setAttribute('disabled', true);
                
                    editBtn.innerHTML = 'Pay now';
                    editBtn.removeAttribute('disabled');
                    }
                }).catch(function(error) {
                    console.error('Error:', error);
                });
            }
        });
    });

    // Simulate form submission status
    if ({{ session('errors') ? 'true' : 'false' }}) {
        // Add invalid class to inputs
        var inputs = form.querySelectorAll('input');
        inputs.forEach(function(input) {
            if (input.value === '') {
                input.classList.add('is-invalid');
            }
        });
    }
});
    </script>
</body>

</html>
