<?php
// hotels.php

// Database connection setup
$conn = new mysqli("localhost", "root", "@nithin123", "yoyo_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dummy data for the 10 hotels (replace this with database queries in the future)
$hotels = [
    ['name' => 'Oceanview Resort', 'location' => 'Malibu', 'price' => 199, 'rating' => 4.5, 'image_url' => 'https://www.google.com/imgres?q=hotel%20rooms&imgurl=https%3A%2F%2Fpix10.agoda.net%2FhotelImages%2F626132%2F3175647%2F2ff6660638fffddf3788d5c369488f01.jpg%3Fce%3D0%26s%3D702x392&imgrefurl=https%3A%2F%2Fwww.agoda.com%2Fen-in%2Fcity%2Flavasa-in.html&docid=3Pz5rEAHyX-tKM&tbnid=uPxaL2Nk3AlcvM&vet=12ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECBsQAA..i&w=588&h=392&hcb=2&ved=2ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECBsQAA'],
    ['name' => 'Mountain Lodge', 'location' => 'Aspen', 'price' => 250, 'rating' => 4.8, 'image_url' => 'https://www.google.com/imgres?q=hotel%20rooms&imgurl=https%3A%2F%2Fcdn.prod.website-files.com%2F5c6d6c45eaa55f57c6367749%2F65045f093c166fdddb4a94a5_x-65045f0266217.webp&imgrefurl=https%3A%2F%2Fwww.canarytechnologies.com%2Fpost%2Ftypes-of-rooms-in-5-star-hotels&docid=HXSTX5ZADKEVyM&tbnid=LoEefSw_em5nrM&vet=12ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECGUQAA..i&w=975&h=489&hcb=2&ved=2ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECGUQAA'],
    ['name' => 'City Center Hotel', 'location' => 'New York', 'price' => 350, 'rating' => 4.7, 'image_url' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.cnn.com%2Ftravel%2Farticle%2Fpeninsula-hotel-model%2Findex.html&psig=AOvVaw3FfmWkamYQxBig9kGWp7OK&ust=1731522845410000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCLiFytW314kDFQAAAAAdAAAAABAE'],
    ['name' => 'Beachside Inn', 'location' => 'Miami', 'price' => 150, 'rating' => 4.2, 'image_url' => 'https://www.google.com/imgres?q=hotel%20rooms&imgurl=https%3A%2F%2Fstayatthei.com%2Fwp-content%2Fuploads%2F2023%2F03%2FIMG_1351-scaled-e1686322966702.jpeg&imgrefurl=https%3A%2F%2Fstayatthei.com%2F&docid=oHJcc1q8wHFnzM&tbnid=OFuIH-PxELlCDM&vet=12ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECH0QAA..i&w=2560&h=1503&hcb=2&ved=2ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECH0QAA'],
    ['name' => 'The Royal Palace', 'location' => 'Paris', 'price' => 400, 'rating' => 5.0, 'image_url' => 'https://www.google.com/imgres?q=simple%20hotel%20room&imgurl=https%3A%2F%2Fthumbs.dreamstime.com%2Fz%2Fsimple-hotel-room-19337144.jpg&imgrefurl=https%3A%2F%2Fwww.dreamstime.com%2Fstock-images-simple-hotel-room-image19337144&docid=XtFw-JdlxVV9GM&tbnid=5d1L0uSjgJ3LMM&vet=12ahUKEwjb4bbrt9eJAxWMnK8BHQYdEvEQM3oFCIQBEAA..i&w=1600&h=1153&hcb=2&ved=2ahUKEwjb4bbrt9eJAxWMnK8BHQYdEvEQM3oFCIQBEAA'],
    ['name' => 'Desert Mirage Hotel', 'location' => 'Dubai', 'price' => 500, 'rating' => 4.6, 'image_url' => 'https://www.google.com/imgres?q=beach%20hotel%20room&imgurl=https%3A%2F%2Fmedia.istockphoto.com%2Fid%2F492189224%2Fphoto%2Fseaview-bedroom.jpg%3Fs%3D612x612%26w%3D0%26k%3D20%26c%3DtSL5OoSdxW3l7WzdBGU2_NnGNjDH88twjNZTTkll2jY%3D&imgrefurl=https%3A%2F%2Fwww.istockphoto.com%2Fphotos%2Fbeach-hotel-room&docid=QVfV02elMMLC4M&tbnid=BBcokhbQQtV5gM&vet=12ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECBcQAA..i&w=612&h=383&hcb=2&ved=2ahUKEwih-ciwt9eJAxWb6TQHHch4I9wQM3oECBcQAA'],
    ['name' => 'Green Valley Resort', 'location' => 'Switzerland', 'price' => 450, 'rating' => 4.3, 'image_url' => 'https://www.google.com/imgres?q=darkhotel%20room&imgurl=https%3A%2F%2Fimgcdn.stablediffusionweb.com%2F2024%2F5%2F19%2F0051acb8-973b-4431-88e6-29333d486e4b.jpg&imgrefurl=https%3A%2F%2Fstablediffusionweb.com%2Fimage%2F7611018-dark-hotel-room-view-with-red-light&docid=KAZLL0PZ0rnzSM&tbnid=LcogtjwYLPkcnM&vet=12ahUKEwiOj6uHuNeJAxWAcPUHHdukIsMQM3oECEsQAA..i&w=1024&h=1024&hcb=2&ved=2ahUKEwiOj6uHuNeJAxWAcPUHHdukIsMQM3oECEsQAA'],
    ['name' => 'Royal Palace Inn', 'location' => 'London', 'price' => 380, 'rating' => 4.9, 'image_url' => 'https://www.google.com/imgres?q=darkhotel%20room&imgurl=https%3A%2F%2Fimgcdn.stablediffusionweb.com%2F2024%2F5%2F19%2F0051acb8-973b-4431-88e6-29333d486e4b.jpg&imgrefurl=https%3A%2F%2Fstablediffusionweb.com%2Fimage%2F7611018-dark-hotel-room-view-with-red-light&docid=KAZLL0PZ0rnzSM&tbnid=LcogtjwYLPkcnM&vet=12ahUKEwiOj6uHuNeJAxWAcPUHHdukIsMQM3oECEsQAA..i&w=1024&h=1024&hcb=2&ved=2ahUKEwiOj6uHuNeJAxWAcPUHHdukIsMQM3oECEsQAA']
];

// Display the hotel information
foreach ($hotels as $hotel) {
    echo '<div class="hotel" style="margin-bottom: 30px; border: 1px solid #ddd; padding: 20px; border-radius: 10px;">';
    echo '<h2>' . $hotel['name'] . '</h2>';
    echo '<p><strong>Location:</strong> ' . $hotel['location'] . '</p>';
    echo '<p><strong>Price per Night:</strong> $' . $hotel['price'] . '</p>';
    echo '<p><strong>Rating:</strong> ' . $hotel['rating'] . ' / 5</p>';
    echo '<img src="' . $hotel['image_url'] . '" alt="' . $hotel['name'] . '" style="width:100%; max-width:400px; border-radius: 8px;">';
    echo '</div>';
}

// Close the database connection
$conn->close();
?>

</body>
</html>
