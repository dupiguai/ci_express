<?php
    $encryptedusr="SHZmRUsrbWU1T0lFYWx2MkJvSVhMUlZUZ29BTC96eTg2aXpYTXBTbzJOSjIvdTV0Rm43VlJiN1cwVm1qa2lWWGpadVpHSENUbWtqTS9Od2FveDlsSWEyQTc0NHh2SnJORE8xSnFtelhyeVY2amdkQ2cvNDRCT0REYXpsaEw1QnhXS1RGbkhlUVRFYUdSN0dra2NuN2I3ejVaY29WTEZvWGV3bHNQa2xMeldF";
    $private_key='-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC2dWtjFMHKriJb56w/WNOcICDQSH74691pqfwibPDkzdV7xRfN
kwiS0UV+Jy2htyguqsLjRXTaECoMhPoXq1RCXZepnIW9gj+0UcJ2nZ0PKUfVQvd6
1tSAZRGhs/YX18f4qOQnH/Dhz1Jvh99R6MEBapCaklMkStrhGvyK46QRgQIDAQAB
AoGADF6bgCUZGj+B7s8e+1BvUCdRci1oBkIfSZmPkVnnXuuhbHmpKnOsYh+z4WCQ
lGURYVCMU9ISoPH1l9GwDsi7toLE2YiCiqlkDX2vabB4YEwZbnX+SObZq+sMRRAS
6Bv2pFQV4OIiTKYr0pIjjJPH4dBITzhKUl/m2aBXDCzD8y0CQQDgQzlwrvjYVQZF
C76tl38O38QbcpE4bV9D2kqf19jYlFNz4oJt6IuWaWaDZjQP5DMXLOHMyrbbn8/C
lSdEmztHAkEA0Eev4Hgl/FP0w1AitjnzpBLCTrbugjG67ie4FrZ21j/JPAYjr7eg
HrlmPy3/hUn1jfsOpYX4HCGvYe4DsmMg9wJAOj6bY32+GYlzmGkle7ZWBInvR+Wo
e8xEKr4+FWec5RsY1Yclst/rqQP04PmhWeM9ta4tct/PQBkwf2v3h+T9LwJBAMnh
Ik1dx9va+LyzmOGuLEUVVbd8QpR5ZWnfn+SL+YXTj9cZUE/KmW4OYFfO2wQz2spC
1UCFKScDU36FeJnY0aMCQEoIxMGeAjJpc9CUufO9/WQZ1aMRek7VZIRVKquTpGEk
wvmnrsOy3RTN9uoiHEvT3289Dino0KDjqB4mQlJKg0M=
-----END RSA PRIVATE KEY-----';
    $public_key ='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2dWtjFMHKriJb56w/WNOcICDQ
SH74691pqfwibPDkzdV7xRfNkwiS0UV+Jy2htyguqsLjRXTaECoMhPoXq1RCXZep
nIW9gj+0UcJ2nZ0PKUfVQvd61tSAZRGhs/YX18f4qOQnH/Dhz1Jvh99R6MEBapCa
klMkStrhGvyK46QRgQIDAQAB
-----END PUBLIC KEY-----';
    $data="08143439";
    $pi_key=openssl_pkey_get_private($private_key);
    $pu_key=openssl_pkey_get_public($public_key);
    $encrypt_data='f0NkFo66aRF40cI9OMTSRFqrXBmtQJnuk0v8J9FSfn+ji+MhPSaEhRmxC/q31/jt+0kfc/ohxiyD3/xCiUcnSm5V9yRUkPqM59+5G4ML+Um5/wZXWxT0b4kmgIUJCcHZd1DrajY06F1JCStZtoktvt5yLClOzeqKU2DfqJtAw7I=';//base64_decode($encryptedusr);
    openssl_private_decrypt(base64_decode($encrypt_data), $decryptedusr, $pi_key);
    echo $decryptedusr;
?>