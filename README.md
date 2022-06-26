# encrypt-data-app
Simple web app to encrypt data using algorithms:
A simple web application to encrypt data using the following algorithms:
- Symmetric encryption:
  - AES in three versions - with 128-bit, 192-bit or 256-bit key,
  - Blowfish,
  - Camellia in three versions - with 128-bit, 192-bit or 256-bit key
  - DES,
  - IDEA,
  - RC4.
- Asymmetric encryption: 
  - RSA.
- One-way hash functions:
  - MD2,
  - MD4,
  - MD5,
  - SHA-1,
  - SHA-2 in 224 bit, 256 bit, 384 bit and 512 bit versions,
  - Ripemd in 128 bit, 160 bit, 256 bit and 320 bit versions,
  - Whirlpool,
  - Haval in 120 bit, 160 bit, 192 bit, 224 bit 256 bit versions with selectable number of rounds (3, 4 or 5).

Block ciphers support ECB, CBC, CFB and OFB modes. The initialization vector can be entered in either hashed or plaintext form.

For algorithms requiring a specific block length, missing bits are padded with zeros (ZeroBytePadding.)

The ciphertext is generated in hexadecimal form

# Running
You have to run a web server (e.g. Apache)
