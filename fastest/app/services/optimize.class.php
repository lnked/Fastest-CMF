<?php declare(strict_types = 1);

class Optimize extends Initialize
{
    use Singleton;

    public function __construct()
    {
        
    }

    protected function tinypng()
    {
        # https://tinypng.com/developers/reference/php

        try {
            \Tinify\setKey(TINYPNG_API_KEY);
            \Tinify\validate();
        } catch(\Tinify\Exception $e) {
            // Validation of API key failed.
        }

        \Tinify\setKey(TINYPNG_API_KEY);

        $source = \Tinify\fromFile("unoptimized.jpg");
        $source->toFile("optimized.jpg");

        $sourceData = file_get_contents("unoptimized.jpg");
        $resultData = \Tinify\fromBuffer($sourceData)->toBuffer();

        $source = \Tinify\fromUrl("https://cdn.tinypng.com/images/panda-happy.png");
        $source->toFile("optimized.jpg");

        $source = \Tinify\fromFile("large.jpg");
        $resized = $source->resize(array(
            "method" => "fit", # scale fit cover
            "width" => 150,
            "height" => 100
        ));
        $resized->toFile("thumbnail.jpg");

        $source = \Tinify\fromFile("unoptimized.jpg");
        $copyrighted = $source->preserve("copyright", "creation", "location");
        $copyrighted->toFile("optimized-copyright.jpg");

        $source = \Tinify\fromFile("unoptimized.jpg");
        $source->store(array(
            "service" => "s3",
            "aws_access_key_id" => "AKIAIOSFODNN7EXAMPLE",
            "aws_secret_access_key" => "wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY",
            "region" => "us-west-1",
            "path" => "example-bucket/my-images/optimized.jpg"
        ));

        $compressionsThisMonth = \Tinify\compressionCount();
    }
}

// $key = 'fiZxjIh3dTZNwFPP7YTmW4rfZkCPUg0S';

// $input = "large-input.png";
// $output = "tiny-output.png";

// $request = curl_init();
// curl_setopt_array($request, array(
//   CURLOPT_URL => "https://api.tinypng.com/shrink",
//   CURLOPT_USERPWD => "api:" . $key,
//   CURLOPT_POSTFIELDS => file_get_contents($input),
//   CURLOPT_BINARYTRANSFER => true,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_HEADER => true,
//   /* Uncomment below if you have trouble validating our SSL certificate.
//      Download cacert.pem from: http://curl.haxx.se/ca/cacert.pem */
//   // CURLOPT_CAINFO => __DIR__ . "/cacert.pem",
//   CURLOPT_SSL_VERIFYPEER => true
// ));

// $response = curl_exec($request);
// if (curl_getinfo($request, CURLINFO_HTTP_CODE) === 201) {
//   /* Compression was successful, retrieve output from Location header. */
//   $headers = substr($response, 0, curl_getinfo($request, CURLINFO_HEADER_SIZE));
//   foreach (explode("\r\n", $headers) as $header) {
//     if (substr($header, 0, 10) === "Location: ") {
//       $request = curl_init();
//       curl_setopt_array($request, array(
//         CURLOPT_URL => substr($header, 10),
//         CURLOPT_RETURNTRANSFER => true,
//         /* Uncomment below if you have trouble validating our SSL certificate. */
//         // CURLOPT_CAINFO => __DIR__ . "/cacert.pem",
//         CURLOPT_SSL_VERIFYPEER => true
//       ));
//       file_put_contents($output, curl_exec($request));
//     }
//   }
// } else {
//     print(curl_error($request));
//   /* Something went wrong! */
//   print("Compression failed");
// }

// // OR

// $input = "large-input.png";
// $output = "tiny-output.png";

// $url = "https://api.tinypng.com/shrink";
// $options = array(
//   "http" => array(
//     "method" => "POST",
//     "header" => array(
//       "Content-type: image/png",
//       "Authorization: Basic " . base64_encode("api:$key")
//     ),
//     "content" => file_get_contents($input)
//   ),
//   "ssl" => array(
//     /* Uncomment below if you have trouble validating our SSL certificate.
//        Download cacert.pem from: http://curl.haxx.se/ca/cacert.pem */
//     // "cafile" => __DIR__ . "/cacert.pem",
//     "verify_peer" => true
//   )
// );

// $result = fopen($url, "r", false, stream_context_create($options));
// if ($result) {
//   /* Compression was successful, retrieve output from Location header. */
//   foreach ($http_response_header as $header) {
//     if (substr($header, 0, 10) === "Location: ") {
//       file_put_contents($output, fopen(substr($header, 10), "rb", false));
//     }
//   }
// } else {
//   /* Something went wrong! */
//   print("Compression failed");
// }