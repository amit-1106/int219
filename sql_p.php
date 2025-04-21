<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "int219";

// Create connection without specifying database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

$sql = "INSERT IGNORE INTO product (name, image_url, category, `desc`, cost_price, selling_price) VALUES
('Mini Tractor', 'https://assets.tractorjunction.com/tractor-junction/assets/images/upload/farmtrac-atom-26-1690535758.webp', 'Tractor', '15HP Diesel Engine with 2 Years Warranty', 360000.00, 324000.00),
('John Deere Mini', 'https://assets.tractorjunction.com/tractor-junction/assets/images/upload/3036e-1632220005.webp', 'Tractor', '20HP Diesel Engine, High Performance', 400000.00, 380000.00),
('Swaraj Mini', 'https://tractor.cmv360.com/_next/image?url=https%3A%2F%2Fd1odgbsvvxl2qd.cloudfront.net%2Fsmall_Target_630_429afda627.jpg&w=1080&q=75', 'Tractor', '18HP, Diesel Engine, Low Maintenance', 350000.00, 322000.00),
('Eicher Mini', 'https://5.imimg.com/data5/SELLER/Default/2020/10/HT/IL/IH/83761988/new-product-500x500.jpeg', 'Tractor', '22HP, Fuel Efficient, Low Cost', 330000.00, 306000.00),
('Organic Wheat', 'https://m.media-amazon.com/images/I/61PK43QvaqL.jpg', 'Seeds', 'High-quality organic wheat', 200.00, 160.00),
('Hybrid Wheat Seeds', 'https://5.imimg.com/data5/SELLER/Default/2024/2/392815151/UX/YG/YV/86314498/7.jpg', 'Seeds', 'Disease-resistant and high-yield variety.', 250.00, 220.00),
('Organic Rice Seeds', 'https://organicindia.com/cdn/shop/files/organic-red-rice-in-india.jpg?v=1734506572', 'Seeds', 'Best for organic farming.', 220.00, 187.00),
('Organic Fertilizer', 'https://organicbazar.net/cdn/shop/products/vermicompost-10kg-compressed.jpg?v=1694168932', 'Fertilizers', '100% natural manure for healthy crops.', 500.00, 450.00),
('Urea Fertilizer', 'https://plantogallery.com/cdn/shop/products/urea.jpg?v=1623692992', 'Fertilizers', 'High nitrogen content for crop growth.', 700.00, 665.00),
('Hand Hoe', 'https://utkarshagro.com/cdn/shop/files/1_89c5c0e3-4d5c-4ec9-a3a8-8aa5d209bfce.png?v=1730103398&width=1946', 'Tools', 'Durable steel blade for soil preparation.', 800.00, 736.00),
('Agricultural Sprayer', 'https://m.media-amazon.com/images/I/71UDOJL+JCL._AC_UF1000,1000_QL80_.jpg', 'Tools', 'Battery-powered sprayer for pesticides.', 3500.00, 3150.00),
('Irrigation Pipe', 'https://agribegri.com/productthumbimage/thumb222255_4da61c2e1472ec1dc080060b91f050dc-04-26-22-23-03-42.webp', 'Tools', 'Heavy-duty pipe for drip irrigation.', 120000.00, 100056.00),
('Farmtrac Atom 26', 'https://i.ytimg.com/vi/U6i1w9IiBS0/maxresdefault.jpg', 'Tractor', '26HP, Diesel Engine', 360000.00, 324000.00),
('John Deere 3028 EN', 'https://vvcjohndeere.com/img/sliders/new-John-Deere-3036EN-Tractor1.png', 'Tractor', '28HP, Powerful Diesel Engine', 400000.00, 380000.00),
('Mahindra Jivo 245 DI', 'https://i.ytimg.com/vi/uFRbWdZny48/sddefault.jpg', 'Tractor', '24HP, 2WD, Compact Tractor', 350000.00, 322000.00),
('Swaraj 724 XM Orchid', 'https://ik.imagekit.io/tractorkarvan/tr:w-548,f-webp,di-placeholder.png/images/Top-100-tractor-models/Red-bg/SWARAJ-724-XM-ORCHARD-r.jpg', 'Tractor', '24HP, 4WD, Advanced Model', 420000.00, 369600.00),
('Massey Ferguson 1030 DI', 'https://tractorbird.com/assets/posts/01a52933bf6465e9d5658af94e854e23.jpg', 'Tractor', '30HP, 2WD, Durable Design', 450000, 418500),  
('Escort Farmtrac 25 XT', 'https://ik.imagekit.io/tractorkarvan/tr:w-548,f-webp,di-placeholder.png/images/Farmtrac/Farmtrac-45-Powermaxx-01.jpg', 'Tractor', '25HP, 4WD, Heavy Duty', 380000, 323000),  
('New Holland 3032 SX', 'https://cnhi-p-001-delivery.sitecorecontenthub.cloud/api/public/content/7274fb2f4a2c4f798d38f7b48db7e72f?v=91166a6c', 'Tractor', '32HP, 4WD, Premium Model', 520000, 494000),  
('Kubota Nexa E 261', 'https://www.ggmgroup.com/wp-content/uploads/2023/10/20230724_092224_resized.jpg', 'Tractor', '26HP, 4WD, Compact Design', 480000, 432000),  
('TAFE 25 DI Orchid', 'https://i.pinimg.com/736x/d8/36/41/d836412e82ee3572adabd179b5418ed6.jpg', 'Tractor', '25HP, 2WD, Efficient Model', 340000, 312800),  
('Preet 2049', 'https://farm-junction-assets.s3.ap-south-1.amazonaws.com/tractor-junction/assets/images/upload/2549-1631531259.webp', 'Tractor', '20HP, 2WD, Budget Friendly', 280000, 246400),  
('Force Cruiser', 'https://5.imimg.com/data5/SELLER/Default/2022/7/KL/JT/VE/132569684/force-ox25-orchard-dlx-lt-tractor.jpg', 'Tractor', '22HP, 4WD, Multi-Purpose', 320000, 272000),  
('ACE Crop Ace', 'https://i.pinimg.com/736x/60/da/0a/60da0a4ed9ff86b0a90a95cb03edc582.jpg', 'Tractor', '18HP, 2WD, Compact Size', 250000, 237500),  
('Sonalika DI 20 SRX', 'https://www.sonalika.com/media/product-banner/gt-20-english-1616394911-1-1711690465.jpg', 'Tractor', '20HP, 4WD, Powerful', 290000, 261000),  
('Eicher 242', 'https://i.ytimg.com/vi/wjLgNL3UAws/sddefault.jpg', 'Tractor', '24HP, 2WD, Reliable', 330000, 303600),  
('Powertrac Euro 25', 'https://farm-junction-assets.s3.ap-south-1.amazonaws.com/tractor-junction/assets/images/images/news/tractor-1737091717.webp', 'Tractor', '25HP, 4WD, European Design', 370000, 325600),  
('IndoFarm 2042', 'https://5.imimg.com/data5/PB/MG/MJ/GLADMIN-6996/indo-farm-2042-di-45-hp-tractor-1400-kg-500x500.png', 'Tractor', '20HP, 2WD, Basic Model', 260000, 241800),  
('HMT ST 25', 'https://images.tractorgyan.com/uploads/3055/614ade37a93f9_HMT-2522-DX-tractorgyan.jpg', 'Tractor', '25HP, 2WD, Government Approved', 310000, 279000),  
('Valtra T25', 'https://i.ytimg.com/vi/mRpaRBGTOWE/maxresdefault.jpg', 'Tractor', '25HP, 4WD, Premium Brand', 490000, 465500),  
('Captain 250', 'https://img3.exportersindia.com/product_images/bc-full/2021/12/9692948/captain-250-di-25-hp-4wd-tractor-1640001210-6124232.jpeg', 'Tractor', '25HP, 2WD, Affordable', 270000, 229500),  
('LandForce 254', 'https://i.ytimg.com/vi/gvED9VZ5scg/maxresdefault.jpg', 'Tractor', '25HP, 4WD, Rugged Design', 350000, 322000),
('Premium Wheat Seeds', 'https://m.media-amazon.com/images/I/713MgBbecHL.jpg', 'Seeds', 'High-yield wheat variety, drought resistant', 250.00, 225.00),
('Organic Rice Seeds', 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcScrsUTx4u6ETRtMOp6SR_l-qng69V9SAToKT3vCVwx74BAd8t3cQ7ZQuXkIkrDi5VelYTcYSKowBF2ef8dwbQ5nR1PYr8LxOOfrQuR17Di', 'Seeds', 'Organic basmati rice seeds, pesticide-free', 300.00, 270.00),
('Hybrid Corn Seeds', 'https://5.imimg.com/data5/ANDROID/Default/2025/4/502100460/OT/SN/YK/29643016/product-jpeg-1000x1000.jpg', 'Seeds', 'Fast growing hybrid corn variety, disease resistant', 220.00, 198.00),
('Cotton Seeds', 'https://badikheti-production.s3.ap-south-1.amazonaws.com/products/20230419160243486845769.jpg?tr=w-216,h-288', 'Seeds', 'BT cotton seeds for maximum yield', 450.00, 405.00),
('Mustard Seeds', 'https://organicindia.com/cdn/shop/products/1649754766-mustardseeds.jpg?v=1667975727', 'Seeds', 'High oil content, early maturing variety', 180.00, 162.00),
('NPK Complex Fertilizer', 'https://www.shutterstock.com/image-photo/chemical-fertilizer-piled-hand-against-260nw-2514599895.jpg', 'Fertilizers', 'Balanced 20:20:20 NPK formula for all crops', 850.00, 799.00),
('Organic Vermicompost', 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQ0mR3gCAbuzcq2oEB2bepkMXBZXxztWWE5n39p085pC2LrnjiUtgg1LxrOOjp1s0EOxYs5Lshgyxq0LgMeaWBQTft14xljgNSrfcrTGpxm', 'Fertilizers', '100% organic soil enricher, improves soil health', 450.00, 399.00),
('Liquid Biofertilizer', 'https://nrdcindia.com/uploads/success_story/1546419217Liquid_BioFertiliser.jpg', 'Fertilizers', 'Contains nitrogen-fixing bacteria for better growth', 550.00, 495.00),
('Potassium Sulphate', 'https://www.katyayaniorganics.com/wp-content/uploads/2022/11/4-3.png', 'Fertilizers', 'High potassium content for fruit and vegetable crops', 750.00, 675.00),
('Zinc Sulphate', 'https://onemg.gumlet.io/l_watermark_346,w_480,h_480/a_ignore,w_480,h_480,c_fit,q_auto,f_auto/syxyiji5ixre8tbckgoa.jpg?dpr=2&format=auto', 'Fertilizers', 'Micronutrient supplement for zinc deficient soils', 350.00, 315.00),
('Bone Meal Fertilizer', 'https://anandigreens.com/cdn/shop/files/5_7abb809e-f3a5-45bf-a417-b0c9f708a3f2_700x700.jpg?v=1718963232', 'Fertilizers', 'Slow-release phosphorus and calcium, ideal for root crops', 480.00, 432.00),
('Heavy Duty Garden Hoe', 'https://cdn11.bigcommerce.com/s-5iaef8cbv6/images/stencil/1280x1280/products/848/2320/heavy-duty-hoe__89733.1639393648__51575.1641904397.jpg?c=1', 'Tools', 'Stainless steel blade with ergonomic handle', 1200.00, 1080.00),
('Battery Powered Sprayer', 'https://5.imimg.com/data5/SELLER/Default/2024/4/406071822/BG/TF/JV/2646725/balwaan-sp-80b-li-ion-battery-sprayer-8l-250x250.jpg', 'Tools', '16L capacity, 8-hour battery life, adjustable nozzle', 3500.00, 3150.00),
('Grafting Knife Set', 'https://m.media-amazon.com/images/I/71TkFIbnUfL.jpg', 'Tools', 'Professional 3-piece grafting and pruning knife set', 1500.00, 1275.00),
('Manual Seed Drill', 'https://i0.wp.com/kamalagrotech.in/wp-content/uploads/2024/01/33.png?fit=1050%2C1050&ssl=1', 'Tools', 'Precision planting tool with adjustable row spacing', 2800.00, 2520.00),
('Soil Moisture Meter', 'https://media.diy.com/is/image/KingfisherDigital/sa-products-soil-moisture-meter-garden-soil-humidity-meter-for-outdoor-indoor-plants-plant-watering-indicator-with-probe~5060938981890_04c_MP?\$MOB_PREV$&\$width=600&\$height=600', 'Tools', 'Digital meter for measuring soil moisture, pH and sunlight', 1200.00, 1020.00);
";
if ($conn->query($sql) === FALSE) {
    die("Error creating user table: " . $conn->error);
}

$conn->close();
?>