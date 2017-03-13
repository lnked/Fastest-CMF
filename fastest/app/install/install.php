<?php

md5_file(filename);

sha1_file(filename);

hash_file('md5', 'example.txt'); # "md5", "sha256", "haval160,4"

function crc32_file($file) {
    return sprintf("%u",crc32(file_get_contents($file)));
}

$checksum = crc32_file("/path/to/file.jpg"); 

// ALGO: md2, time: 74.702272891998
// ALGO: md4, time: 9.2155270576477
// ALGO: md5, time: 9.0815191268921
// ALGO: sha1, time: 9.0945210456848
// ALGO: sha224, time: 9.1465229988098
// ALGO: sha256, time: 9.143522977829
// ALGO: sha384, time: 14.065804004669
// ALGO: sha512, time: 13.990800857544
// ALGO: ripemd128, time: 9.3185329437256
// ALGO: ripemd160, time: 9.3165328502655
// ALGO: ripemd256, time: 9.2495288848877
// ALGO: ripemd320, time: 9.2395279407501
// ALGO: whirlpool, time: 27.779588937759
// ALGO: tiger128,3, time: 9.3075330257416
// ALGO: tiger160,3, time: 9.1875250339508
// ALGO: tiger192,3, time: 9.3875370025635
// ALGO: tiger128,4, time: 9.1755249500275
// ALGO: tiger160,4, time: 9.355535030365
// ALGO: tiger192,4, time: 9.2025260925293
// ALGO: snefru, time: 42.781446218491
// ALGO: snefru256, time: 42.613437175751
// ALGO: gost, time: 18.606064081192
// ALGO: gost-crypto, time: 18.664067983627
// ALGO: adler32, time: 9.1535229682922
// ALGO: crc32, time: 10.126579999924
// ALGO: crc32b, time: 10.01757311821
// ALGO: fnv132, time: 9.7505569458008
// ALGO: fnv1a32, time: 9.7935597896576
// ALGO: fnv164, time: 9.8945660591125
// ALGO: fnv1a64, time: 9.3025319576263
// ALGO: joaat, time: 9.7175559997559
// ALGO: haval128,3, time: 9.6855540275574
// ALGO: haval160,3, time: 10.10857796669
// ALGO: haval192,3, time: 9.6765530109406
// ALGO: haval224,3, time: 20.636180877686
// ALGO: haval256,3, time: 10.641607999802
// ALGO: haval128,4, time: 7.5594329833984
// ALGO: haval160,4, time: 7.2884171009064
// ALGO: haval192,4, time: 7.2934169769287
// ALGO: haval224,4, time: 7.2964169979095
// ALGO: haval256,4, time: 7.3034179210663
// ALGO: haval128,5, time: 8.3244760036469
// ALGO: haval160,5, time: 8.3174757957458
// ALGO: haval192,5, time: 8.3204758167267
// ALGO: haval224,5, time: 8.3234758377075
// ALGO: haval256,5, time: 8.3254759311676