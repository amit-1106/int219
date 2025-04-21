<?php
$servername = "127.0.0.1";
$username = "root";
$password_db = "";
$database = "int219";

$conn = new mysqli($servername, $username, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize user data variables
$fname = "";
$lname = "";
$email = "";
$phone = "";
$street_address = "";
$address_line2 = "";
$city = "";
$state = "";
$zip = "";
$country = "IN"; // Default to India

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Retrieve user data
    $user_sql = "SELECT u.first_name, u.last_name, u.email, 
                       ua.address_line1, ua.address_line2, ua.city, 
                       ua.postal_code, ua.country, ua.telephone 
                FROM user u 
                LEFT JOIN user_address ua ON u.id = ua.user_id 
                WHERE u.id = ?";
    
    $stmt = $conn->prepare($user_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        
        // Populate form fields with user data
        $fname = $user_data['first_name'];
        $lname = $user_data['last_name'];
        $email = $user_data['email'];
        $phone = $user_data['telephone'] ?? "";
        $street_address = $user_data['address_line1'] ?? "";
        $address_line2 = $user_data['address_line2'] ?? "";
        $city = $user_data['city'] ?? "";
        $state = ""; // State not in original database schema, but we'll keep the field
        $zip = $user_data['postal_code'] ?? "";
        $country = $user_data['country'] ?? "IN";
    }
    $stmt->close();
}

// Check if cart data was sent via POST
if (isset($_POST['cart_data'])) {
    $cart_data = json_decode($_POST['cart_data'], true);
    
    // Store cart data in session
    $_SESSION['cart'] = $cart_data;
}

// Initialize variables
$total = 0;
$subtotal = 0;
$shipping = 50; // ₹50 shipping fee
$items = [];
$item_count = 0;
$error_message = "";
$success_message = "";
$order_id = null;

// Check if cart exists in session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // For testing only - remove in production
    $_SESSION['cart'] = [
        ['id' => 1, 'name' => 'Organic Tomatoes', 'price' => 120, 'quantity' => 2, 'image' => 'images/products/tomatoes.jpg'],
        ['id' => 2, 'name' => 'Fresh Carrots', 'price' => 80, 'quantity' => 1, 'image' => 'images/products/carrots.jpg']
    ];
}

// Calculate totals from session cart
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
    $item_count += $item['quantity'];
    $items[] = $item;
}

$tax_rate = 0.18;
$tax = $subtotal * $tax_rate;

// Calculate total
$total = $subtotal + $shipping + $tax;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $street_address = $_POST['street-address'];
    $address_line2 = $_POST['address'] ?? "";
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    
    // If user is logged in, update their address information
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        // Check if user already has an address
        $check_sql = "SELECT id FROM user_address WHERE user_id = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            // Update existing address
            $address_id = $check_result->fetch_assoc()['id'];
            $update_sql = "UPDATE user_address SET 
                           address_line1 = ?, 
                           address_line2 = ?,
                           city = ?,
                           postal_code = ?,
                           country = ?,
                           telephone = ?
                           WHERE id = ?";
                           
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssssssi", $street_address, $address_line2, $city, $zip, $country, $phone, $address_id);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            // Insert new address
            $insert_sql = "INSERT INTO user_address (user_id, address_line1, address_line2, city, postal_code, country, telephone)
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
                           
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("issssss", $user_id, $street_address, $address_line2, $city, $zip, $country, $phone);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
        $check_stmt->close();
    }
    
    // Here you would add code to create order in the database
    // For now, just show success message
    $success_message = "Order processed successfully!";
    
    // Optionally, clear the cart after successful order
    // $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart & Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include("../header.php");?>

    <?php if (!empty($success_message)): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-[100px] mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"><?php echo $success_message; ?></span>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($error_message)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-[100px] mb-4" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline"><?php echo $error_message; ?></span>
    </div>
    <?php endif; ?>


    <h2 class="text-center w-full mt-[50px] text-[40px]">Checkout</h2>
    <div class="flex p-[100px] pt-[30px] gap-[50px]" id="container">
        <div class="w-50 flex-auto " id="left">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <span class="text-[20px] text-gray-600">Customer Details:</span>
                <div class="mb-4 flex gap-[10px] mt-5">
                    <input type="text" name="fname" id="fname" class="border-gray-500 rounded-xl shadow border
                    -2 w-full p-2 flex-1/2 focus:border-green-500 focus:outline-none" required placeholder="First Name" value="<?php echo $fname;?>"/>
                    <input type="text" name="lname" id="lname" class="border-gray-500 rounded-xl shadow border
                    -2 w-full p-2 flex-1/2 focus:border-green-500 focus:outline-none" required placeholder="Last Name" />
                </div>
                <div class="mb-4 gap-[10px]">
                    <input type="email" name="email" id="email" class="border-gray-500 rounded-xl shadow border
                    -2 w-full p-2 focus:border-green-500 focus:outline-none" required placeholder="Email" />
                </div>
                <div class="mb-4 gap-[10px]">
                    <input type="text" name="phone" id="phone" class="border-gray-500 rounded-xl shadow border
                    -2 w-full p-2 focus:border-green-500 focus:outline-none" required placeholder="Phone Number" />
                </div>

                <span class="text-[20px] text-gray-600">Address: </span>
                <div class="mb-4 gap-[50px] mt-[20px]">
                    <input type="text" name="street-address" id="street-address" class="border-gray-500 rounded-xl shadow-sm focus:shadow-md border
                    -2 w-full p-2 focus:border-green-500 focus:outline-none" required placeholder="Street, Apartment" />
                    <input type="text" name="address" id="address" class="border-gray-500 rounded-xl shadow-sm focus:shadow-md border
                    -2 w-full p-2 focus:border-green-500 focus:outline-none mt-[10px]" required placeholder="Address" />

                    <div class="mb-4 flex gap-[10px] mt-[10px]">
                    <input type="text" name="city" id="city" class="border-gray-500 rounded-xl shadow-sm focus:shadow-md border
                    -2 w-full p-2 flex-1/2 focus:border-green-500 focus:outline-none" required placeholder="City" />
                    <input type="text" name="state" id="state" class="border-gray-500 rounded-xl shadow-sm focus:shadow-md border
                    -2 w-full p-2 flex-1/2 focus:border-green-500 focus:outline-none" required placeholder="State" />
                    </div>

                    <div class="mb-4 flex gap-[10px]">
                    <input type="text" name="zip" id="zip" class="border-gray-500 rounded-xl shadow border
                    -2 w-full p-2 flex-1/2 focus:border-green-500 focus:outline-none focus:shadow-md" required placeholder="Zip Code" />
                    <select name="country" class="bg-transparent border-gray-500 rounded-xl border
                    -2 w-full p-2 flex-1/2 transition duration-300 ease appearance-none cursor-pointer shadow-sm focus:border-green-500 focus:outline-none focus:shadow-md" id="country">
                        <option value="0" label="Select a country ... " selected="selected">Select a country ... </option>
                        <optgroup id="country-optgroup-Africa" label="Africa">
                            <option value="DZ" label="Algeria">Algeria</option>
                            <option value="AO" label="Angola">Angola</option>
                            <option value="BJ" label="Benin">Benin</option>
                            <option value="BW" label="Botswana">Botswana</option>
                            <option value="BF" label="Burkina Faso">Burkina Faso</option>
                            <option value="BI" label="Burundi">Burundi</option>
                            <option value="CM" label="Cameroon">Cameroon</option>
                            <option value="CV" label="Cape Verde">Cape Verde</option>
                            <option value="CF" label="Central African Republic">Central African Republic</option>
                            <option value="TD" label="Chad">Chad</option>
                            <option value="KM" label="Comoros">Comoros</option>
                            <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                            <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                            <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                            <option value="DJ" label="Djibouti">Djibouti</option>
                            <option value="EG" label="Egypt">Egypt</option>
                            <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="ER" label="Eritrea">Eritrea</option>
                            <option value="ET" label="Ethiopia">Ethiopia</option>
                            <option value="GA" label="Gabon">Gabon</option>
                            <option value="GM" label="Gambia">Gambia</option>
                            <option value="GH" label="Ghana">Ghana</option>
                            <option value="GN" label="Guinea">Guinea</option>
                            <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="KE" label="Kenya">Kenya</option>
                            <option value="LS" label="Lesotho">Lesotho</option>
                            <option value="LR" label="Liberia">Liberia</option>
                            <option value="LY" label="Libya">Libya</option>
                            <option value="MG" label="Madagascar">Madagascar</option>
                            <option value="MW" label="Malawi">Malawi</option>
                            <option value="ML" label="Mali">Mali</option>
                            <option value="MR" label="Mauritania">Mauritania</option>
                            <option value="MU" label="Mauritius">Mauritius</option>
                            <option value="YT" label="Mayotte">Mayotte</option>
                            <option value="MA" label="Morocco">Morocco</option>
                            <option value="MZ" label="Mozambique">Mozambique</option>
                            <option value="NA" label="Namibia">Namibia</option>
                            <option value="NE" label="Niger">Niger</option>
                            <option value="NG" label="Nigeria">Nigeria</option>
                            <option value="RW" label="Rwanda">Rwanda</option>
                            <option value="RE" label="Réunion">Réunion</option>
                            <option value="SH" label="Saint Helena">Saint Helena</option>
                            <option value="SN" label="Senegal">Senegal</option>
                            <option value="SC" label="Seychelles">Seychelles</option>
                            <option value="SL" label="Sierra Leone">Sierra Leone</option>
                            <option value="SO" label="Somalia">Somalia</option>
                            <option value="ZA" label="South Africa">South Africa</option>
                            <option value="SD" label="Sudan">Sudan</option>
                            <option value="SZ" label="Swaziland">Swaziland</option>
                            <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                            <option value="TZ" label="Tanzania">Tanzania</option>
                            <option value="TG" label="Togo">Togo</option>
                            <option value="TN" label="Tunisia">Tunisia</option>
                            <option value="UG" label="Uganda">Uganda</option>
                            <option value="EH" label="Western Sahara">Western Sahara</option>
                            <option value="ZM" label="Zambia">Zambia</option>
                            <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                        </optgroup>
                        <optgroup id="country-optgroup-Americas" label="Americas">
                            <option value="AI" label="Anguilla">Anguilla</option>
                            <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="AR" label="Argentina">Argentina</option>
                            <option value="AW" label="Aruba">Aruba</option>
                            <option value="BS" label="Bahamas">Bahamas</option>
                            <option value="BB" label="Barbados">Barbados</option>
                            <option value="BZ" label="Belize">Belize</option>
                            <option value="BM" label="Bermuda">Bermuda</option>
                            <option value="BO" label="Bolivia">Bolivia</option>
                            <option value="BR" label="Brazil">Brazil</option>
                            <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                            <option value="CA" label="Canada">Canada</option>
                            <option value="KY" label="Cayman Islands">Cayman Islands</option>
                            <option value="CL" label="Chile">Chile</option>
                            <option value="CO" label="Colombia">Colombia</option>
                            <option value="CR" label="Costa Rica">Costa Rica</option>
                            <option value="CU" label="Cuba">Cuba</option>
                            <option value="DM" label="Dominica">Dominica</option>
                            <option value="DO" label="Dominican Republic">Dominican Republic</option>
                            <option value="EC" label="Ecuador">Ecuador</option>
                            <option value="SV" label="El Salvador">El Salvador</option>
                            <option value="FK" label="Falkland Islands">Falkland Islands</option>
                            <option value="GF" label="French Guiana">French Guiana</option>
                            <option value="GL" label="Greenland">Greenland</option>
                            <option value="GD" label="Grenada">Grenada</option>
                            <option value="GP" label="Guadeloupe">Guadeloupe</option>
                            <option value="GT" label="Guatemala">Guatemala</option>
                            <option value="GY" label="Guyana">Guyana</option>
                            <option value="HT" label="Haiti">Haiti</option>
                            <option value="HN" label="Honduras">Honduras</option>
                            <option value="JM" label="Jamaica">Jamaica</option>
                            <option value="MQ" label="Martinique">Martinique</option>
                            <option value="MX" label="Mexico">Mexico</option>
                            <option value="MS" label="Montserrat">Montserrat</option>
                            <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="NI" label="Nicaragua">Nicaragua</option>
                            <option value="PA" label="Panama">Panama</option>
                            <option value="PY" label="Paraguay">Paraguay</option>
                            <option value="PE" label="Peru">Peru</option>
                            <option value="PR" label="Puerto Rico">Puerto Rico</option>
                            <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                            <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="LC" label="Saint Lucia">Saint Lucia</option>
                            <option value="MF" label="Saint Martin">Saint Martin</option>
                            <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="SR" label="Suriname">Suriname</option>
                            <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                            <option value="US" label="United States">United States</option>
                            <option value="UY" label="Uruguay">Uruguay</option>
                            <option value="VE" label="Venezuela">Venezuela</option>
                        </optgroup>
                        <optgroup id="country-optgroup-Asia" label="Asia">
                            <option value="AF" label="Afghanistan">Afghanistan</option>
                            <option value="AM" label="Armenia">Armenia</option>
                            <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                            <option value="BH" label="Bahrain">Bahrain</option>
                            <option value="BD" label="Bangladesh">Bangladesh</option>
                            <option value="BT" label="Bhutan">Bhutan</option>
                            <option value="BN" label="Brunei">Brunei</option>
                            <option value="KH" label="Cambodia">Cambodia</option>
                            <option value="CN" label="China">China</option>
                            <option value="GE" label="Georgia">Georgia</option>
                            <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                            <option value="IN" label="India" selected>India</option>
                            <option value="ID" label="Indonesia">Indonesia</option>
                            <option value="IR" label="Iran">Iran</option>
                            <option value="IQ" label="Iraq">Iraq</option>
                            <option value="IL" label="Israel">Israel</option>
                            <option value="JP" label="Japan">Japan</option>
                            <option value="JO" label="Jordan">Jordan</option>
                            <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                            <option value="KW" label="Kuwait">Kuwait</option>
                            <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="LA" label="Laos">Laos</option>
                            <option value="LB" label="Lebanon">Lebanon</option>
                            <option value="MO" label="Macau SAR China">Macau SAR China</option>
                            <option value="MY" label="Malaysia">Malaysia</option>
                            <option value="MV" label="Maldives">Maldives</option>
                            <option value="MN" label="Mongolia">Mongolia</option>
                            <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                            <option value="NP" label="Nepal">Nepal</option>
                            <option value="NT" label="Neutral Zone">Neutral Zone</option>
                            <option value="KP" label="North Korea">North Korea</option>
                            <option value="OM" label="Oman">Oman</option>
                            <option value="PK" label="Pakistan">Pakistan</option>
                            <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                            <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                            <option value="PH" label="Philippines">Philippines</option>
                            <option value="QA" label="Qatar">Qatar</option>
                            <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                            <option value="SG" label="Singapore">Singapore</option>
                            <option value="KR" label="South Korea">South Korea</option>
                            <option value="LK" label="Sri Lanka">Sri Lanka</option>
                            <option value="SY" label="Syria">Syria</option>
                            <option value="TW" label="Taiwan">Taiwan</option>
                            <option value="TJ" label="Tajikistan">Tajikistan</option>
                            <option value="TH" label="Thailand">Thailand</option>
                            <option value="TL" label="Timor-Leste">Timor-Leste</option>
                            <option value="TR" label="Turkey">Turkey</option>
                            <option value="TM" label="Turkmenistan">Turkmenistan</option>
                            <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                            <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                            <option value="VN" label="Vietnam">Vietnam</option>
                            <option value="YE" label="Yemen">Yemen</option>
                        </optgroup>
                        <optgroup id="country-optgroup-Europe" label="Europe">
                            <option value="AL" label="Albania">Albania</option>
                            <option value="AD" label="Andorra">Andorra</option>
                            <option value="AT" label="Austria">Austria</option>
                            <option value="BY" label="Belarus">Belarus</option>
                            <option value="BE" label="Belgium">Belgium</option>
                            <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="BG" label="Bulgaria">Bulgaria</option>
                            <option value="HR" label="Croatia">Croatia</option>
                            <option value="CY" label="Cyprus">Cyprus</option>
                            <option value="CZ" label="Czech Republic">Czech Republic</option>
                            <option value="DK" label="Denmark">Denmark</option>
                            <option value="DD" label="East Germany">East Germany</option>
                            <option value="EE" label="Estonia">Estonia</option>
                            <option value="FO" label="Faroe Islands">Faroe Islands</option>
                            <option value="FI" label="Finland">Finland</option>
                            <option value="FR" label="France">France</option>
                            <option value="DE" label="Germany">Germany</option>
                            <option value="GI" label="Gibraltar">Gibraltar</option>
                            <option value="GR" label="Greece">Greece</option>
                            <option value="GG" label="Guernsey">Guernsey</option>
                            <option value="HU" label="Hungary">Hungary</option>
                            <option value="IS" label="Iceland">Iceland</option>
                            <option value="IE" label="Ireland">Ireland</option>
                            <option value="IM" label="Isle of Man">Isle of Man</option>
                            <option value="IT" label="Italy">Italy</option>
                            <option value="JE" label="Jersey">Jersey</option>
                            <option value="LV" label="Latvia">Latvia</option>
                            <option value="LI" label="Liechtenstein">Liechtenstein</option>
                            <option value="LT" label="Lithuania">Lithuania</option>
                            <option value="LU" label="Luxembourg">Luxembourg</option>
                            <option value="MK" label="Macedonia">Macedonia</option>
                            <option value="MT" label="Malta">Malta</option>
                            <option value="FX" label="Metropolitan France">Metropolitan France</option>
                            <option value="MD" label="Moldova">Moldova</option>
                            <option value="MC" label="Monaco">Monaco</option>
                            <option value="ME" label="Montenegro">Montenegro</option>
                            <option value="NL" label="Netherlands">Netherlands</option>
                            <option value="NO" label="Norway">Norway</option>
                            <option value="PL" label="Poland">Poland</option>
                            <option value="PT" label="Portugal">Portugal</option>
                            <option value="RO" label="Romania">Romania</option>
                            <option value="RU" label="Russia">Russia</option>
                            <option value="SM" label="San Marino">San Marino</option>
                            <option value="RS" label="Serbia">Serbia</option>
                            <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                            <option value="SK" label="Slovakia">Slovakia</option>
                            <option value="SI" label="Slovenia">Slovenia</option>
                            <option value="ES" label="Spain">Spain</option>
                            <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="SE" label="Sweden">Sweden</option>
                            <option value="CH" label="Switzerland">Switzerland</option>
                            <option value="UA" label="Ukraine">Ukraine</option>
                            <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                            <option value="GB" label="United Kingdom">United Kingdom</option>
                            <option value="VA" label="Vatican City">Vatican City</option>
                            <option value="AX" label="Åland Islands">Åland Islands</option>
                        </optgroup>
                        <optgroup id="country-optgroup-Oceania" label="Oceania">
                            <option value="AS" label="American Samoa">American Samoa</option>
                            <option value="AQ" label="Antarctica">Antarctica</option>
                            <option value="AU" label="Australia">Australia</option>
                            <option value="BV" label="Bouvet Island">Bouvet Island</option>
                            <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="CX" label="Christmas Island">Christmas Island</option>
                            <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                            <option value="CK" label="Cook Islands">Cook Islands</option>
                            <option value="FJ" label="Fiji">Fiji</option>
                            <option value="PF" label="French Polynesia">French Polynesia</option>
                            <option value="TF" label="French Southern Territories">French Southern Territories</option>
                            <option value="GU" label="Guam">Guam</option>
                            <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                            <option value="KI" label="Kiribati">Kiribati</option>
                            <option value="MH" label="Marshall Islands">Marshall Islands</option>
                            <option value="FM" label="Micronesia">Micronesia</option>
                            <option value="NR" label="Nauru">Nauru</option>
                            <option value="NC" label="New Caledonia">New Caledonia</option>
                            <option value="NZ" label="New Zealand">New Zealand</option>
                            <option value="NU" label="Niue">Niue</option>
                            <option value="NF" label="Norfolk Island">Norfolk Island</option>
                            <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="PW" label="Palau">Palau</option>
                            <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                            <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                            <option value="WS" label="Samoa">Samoa</option>
                            <option value="SB" label="Solomon Islands">Solomon Islands</option>
                            <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                            <option value="TK" label="Tokelau">Tokelau</option>
                            <option value="TO" label="Tonga">Tonga</option>
                            <option value="TV" label="Tuvalu">Tuvalu</option>
                            <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                            <option value="VU" label="Vanuatu">Vanuatu</option>
                            <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                        </optgroup>
                    </select>
                    </div>
                </div>

                <button type="submit" class="bg-green-950 text-white p-3 shadow-green-600 rounded-xl flex gap-2.5">Checkout
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z"/></svg>
                </button>
            </form>


        </div>
        <div class="w-50 flex-auto rounded-2xl bg-green-100 p-[20px]" id="right">
            <span class="text-[20px] text-gray-600">Order Details:</span>
            
            <div class="flex flex-col space-y-4 mt-4" id="item-list">
                <?php foreach ($items as $item): ?>
                <div class="flex justify-between items-center border-b pb-2" id="item">
                    <div id="item-info" class="flex items-center">
                        <div id="item-quantity" class="bg-green-950 text-white rounded-full w-6 h-6 flex items-center justify-center mr-2"><?php echo $item['quantity']; ?></div>
                        <strong><?php echo $item['name']; ?></strong>
                    </div>
                    <div>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <input type="checkbox" name="Cash On Delivery" id="Cash On Delivery">
            <label for="Cash On Delivery">Cash On Delivery</label>


            <div id="price-summary" class="mt-6 space-y-2">
                <div id="price-row" class="flex justify-between">
                    <div>Subtotal:</div>
                    <div>₹<?php echo number_format($subtotal, 2); ?></div>
                </div>
                <div id="price-row" class="flex justify-between">
                    <div>Shipping:</div>
                    <div>₹<?php echo number_format($shipping, 2); ?></div>
                </div>
                <div id="price-row" class="flex justify-between">
                    <div>Tax (<?php echo $tax_rate * 100; ?>%):</div>
                    <div>₹<?php echo number_format($tax, 2); ?></div>
                </div>
                
                <div id="total" class="flex justify-between font-bold text-lg pt-2 border-t">
                    <div>Total:</div>
                    <div>₹<?php echo number_format($total, 2); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../footer.php");?>
</body>
</html>


