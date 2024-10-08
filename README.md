# "One Time Pad" (OTP)
##### _The only known encryption which is mathematically unbreakable._

### CHANGES:
* Added in random ciphertext to make it even harder that's ran with bash inside `letters.sh`; this is done everytime you run `php run.php`.

* Added in a decryption tool in php, same code but uses the cipherkey and ciphertext (secrets) and decrypts your stuff accurately.

* Added in `dice.sh` for a simulated die; written in bash.

## Perfect Encryption
**One Time Pad**, variously known as the **Vernam Cipher** and the **Perfect Cipher**, is the only existing encryption which is mathematically unbreakable.  And it was born in the late 1800's.

This mini-project was inspired by the article by Dirk Rijmenants and posted on his website under the title, ["One-time Pad."](http://users.telenet.be/d.rijmenants/en/onetimepad.htm)

In short, the one time pad is unbreakable if:
1. The cipher key is at least as long as the message text.
2. The cipher key is _truly random_.
3. The cipher key is _never re-used_ and _never repeated_.
4. ["Modular arithmetic"](https://www.khanacademy.org/computing/computer-science/cryptography/modarithmetic/a/what-is-modular-arithmetic) is used to compute the cipher text.  
5. The cipher key is destroyed by both parties after use.  _(This is where the term &ldquo;one time pad&rdquo; originates from; note pads have pages of cipher keys written on them, which are torn out and destroyed after being used only once.)_

## Setup Instructions

### Installation

Clone or download the files into a machine with PHP from the github repository.

### Running the Demonstration Script

1. Enter the source root directory from the shell (`cd /path/to/repository`).
2. Do `php run.php` from the command line.
3. add custom messages from `php run.php` IE `php run.php "every good dog deserve treats even me"` it will be added to the `plaintext.txt`, be sure to concat your sentences with a `-` or `""`

### Running the dcryption tool

1. Enter the source root directory from the shell (`cd /path/to/repository`).
2. edit the cipherkey.txt and ciphertext.txt (secret)
3. Do `php run-decry.php` from the command line.
4. It should run the decryption correctly.

Example
cipherkey.txt:
```
Key:    H I W O U   Z K E K C   Q R R T N   J W T E R   M P Z B (secret)
```
```
hiwouzkekcqrrtnjwtermpzbxbgujdhhoubqwmcqizqfetffqlwlrxzullyicvr
```
ciphertext.txt
```
Cipher: L D A F S   F Y S N D   E P U X F   N N O I J   R D N E (cipher)
```
```
LDAFS FYSND EPUXF NNOIJ RDNE
```

example:


```
php run-decry.php text/cipherkey.txt
```
To decrypt a message provided you have the right ciphertext.


## About the Demonstration Script and Files

### What It Does

`run.php` loads the cipher key from the file `/text/cipherkey.txt`; loads the plain text from the file `/text/plaintext.txt`; performs a modulo 26 (alphabetic) one time pad using those loaded values; and then saves the result to `/text/ciphertext.txt`. It also displays a Vigenere table, sometimes called the "tabula recta," to the screen with the plain text, cipher key and cipher text immediately below it for your study.

This is a PHP script written to run from the command line strictly to demonstrate the mathemetics behind the one time pad; namely, the modulo 26 method.  Modulo 10 (numerals) and modulo 2 (binary) also work; but this demonstration is for modulo 26.

### File Structure

| File Name | File Description |
| --- | --- |
| `/run.php` | Shows by example how to use the `OneTimePadModulo26` class. |
| `/src/OneTimePadModulo26.php` | Contains the `OneTimePadModulo26` class. |
| `/text/cipherkey.txt`  | This file contains the cipher key:  A random sequence of alphabetic characters in uppercase, from A through Z.  |
| `/text/ciphertext.txt`  | This file contains output from the script showing the encrypted message.  _This file is replaced every time the script is run._  |
| `/text/plaintext.txt`  | The source (unencrypted, plain text) message.  |
| `/text/vigenere-*.txt`  | The Vigenere table, also known as the &ldquo;tabula recta,&rdquo; in monospace text in case you want to try doing the one time pad by hand or simply to study.  |
| `/run-decry.php` | The decryption tool written in php, bascially the same as `/run.php` except it will decrypt the given ciphertext and cipherkey. |
| `/dice.sh` | a shell script to randomly roll some die; useful if you really want to randomize your cryptography by the value. |
| `/letters.sh` | a shell script used by `run.php`, decided to use linux this time around for better cryptography, used for random ciphertext to make it impossible to crack (provided you don't give the cipherkey to anyone).

## About the One Time Pad

[Dirk Rijmenants&rsquo; article about the one time pad](http://users.telenet.be/d.rijmenants/en/onetimepad.htm) is an excellent resource to learn more about the history and mathematics behind the 135-year-old encryption algorithm that is mathematically unbreakable to this very day.  This article is filled with intrigue, history and the mathematics behind the one time pad.

### Key and Message Length
The one time pad uses a unique one letter cipher key for each letter in the message, so the encryption key as a whole must be at least as long as the message itself. One could conceivably re-use an encryption key in a round robin fashion (going back to the first element of the key after reaching the end), but this creates a &ldquo;pattern&rdquo; which is easily spotted by cryptographers and renders the key useless.

### Generating a Cipher Key
The one time pad requires that the cipher key be [_truly random_](https://en.wikipedia.org/wiki/Random_number_generation).  Cipher keys generated by a [pseudo-random number generator](https://www.random.org/randomness/), like the **rnd** functions of most programming languages, are easily spotted by cryptographers and renders the key useless.

One cheap and easy way to create your own random key sequences is by throwing dice.  For example, if rolling two six-sided dice:

| Number Rolled | Die #1 | Die #2 |
|:---:|:---:|:---:|
| 1 | +0 | +0 |
| 2 | +0 | +1 |
| 3 | +10 | +2 |
| 4 | +10 | +3 |
| 5 | +20 | +4 |
| 6 | +20 | +5 |

By adding the results of a 2-die throw, you can produce a number between 0-25.  You then translate those numbers to a capital letter and record it to your secret cipher key.

~~The easy way, of course, is to visit the [random.org string generator](https://www.random.org/strings/) and [generate 205 strings of 5 characters each](https://www.random.org/strings/?num=205&len=5&upperalpha=on&unique=off&format=html&rnd=new), as I did to create the `cipherkey.txt` file.~~

Just run ``php run.php`` and it should generate the cipherekey for you.

## Modular Arithmetic
["Modular arithmetic"](https://www.khanacademy.org/computing/computer-science/cryptography/modarithmetic/a/what-is-modular-arithmetic) is used to derive the cipher text from the plain text message using the cipher key, one letter at a time.

In normal arithmetic, division takes place when you divide a _dividend_ by a _divisor_ to compute the _quotient:  **A &divide; B = Q**_.  You will have a _remainder_ If the _dividend_ is not evenly divisible by the _divisor:  **A &divide; B = Q <sup>remainder R</sup>**_.

**Modular arithmetic** is simply division whereupon the _quotient_ is ignored, and the _remainder_ is the result.

Thus, _**A mod B = R**_ (the _quotent **Q**_ is dropped and ignored, and the _remainder **R**_ is the result).

If the _modulus_ (what we call the _divisor_ in modular arithmetic) is 26, the _**remainder R &isin; { 0, 1, 2, ..., 25 }**_.  In other words, we get a whole number from 0 to 25 &mdash; a set of 26 numbers representing the 26 letters of the alphabet.

Thus, _**A mod 26 = R  &isin; { 0, 1, 2, ..., 25 }**_

### Modular Arithmetic for Encryption
The algorithm used in this demonstration of the one time pad takes the letters of a plain text message, converts that to a _whole number &isin; { 0, 1, 2, ..., 25 } **m**_; then takes the corresponding letters of the cipher key, converts that to a _whole number &isin; { 0, 1, 2, ..., 25 } **k**_; then adds _**m + k**_ to produce the _cipher text result_.

The problem is that the _cipher text result_ might be greater than 25!

The solution is modular arithmetic: _**(m + k) mod 26 = c**_

This produces a _cipher text result **c**_ between 0 and 25, which easily translates into a letter from A to Z.

### Modular Arithmetic for Decryption
To decrypt the cipher text back to the plain text message, we reverse the calculation &mdash; again relying on modular arithmetic to produce a letter of the alphabet from 0 to 25 (A-Z).

Simply put, if you add the plain text message letter _**m**_ to the cipher key letter _**k**_ to produce the cipher text letter _**c**_, you can reverse the process to decrypt the message by taking the cipher text letter _**c**_ and subtracting the cipher key letter _**k**_ to arrive at the original plain text message letter _**m**_.

if _**m + k = c**_, then _**c - k = m**_.

But there&rsquo;s a wrinkle.  You could end up with a negative value, anywhere from -25 to 0!

The solution is modular arithmetic: _**(c - k + 26) mod 26 = m**_
 
Since the +26 we added to the _dividend_ is evenly divisible by the modulus, zero is added to the remainder _**m**_ which, of course,  does not affect the result.  Adding +26 to the _dividend_ ensures that the calculation is made using a _whole number_ {&ge;0}.

This produces a result between 0 and 25, which easily translates into a letter from A to Z.


## Contact
Feel free to comment or ask questions via [my website contact form](https://unrivaledcreations.com/contact).
