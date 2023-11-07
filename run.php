<?php
/**
 * Run a test of the oneTimePad class.
 *
 * The oneTimePad class is defined in the ./one-time-pad.php file and has a series of methods that are designed to
 * show you how the One Time Pad encryption cipher works.  One Time Pad is also known variously as either the Vernam
 * Cipher or the Perfect Cipher, owing to its mathematically unbreakable encryption (if implemented correctly).
 *
 * @author Michael Hall <mike@unrivaledcreations.com>
 * @license UNLICENSE
 * @version 1.0
 */

use unrivaled\OneTimePad\OneTimePadModulo26\OneTimePadModulo26;

require __DIR__ . '/src/OneTimePadModulo26.php';

$cipher = new OneTimePadModulo26;

// Check if user input is provided as a command-line argument
if ($argc > 1) {
    // Get user input from the command line argument
    $userInput = strtoupper($argv[1]);

    // Save user input to plaintext.txt
    file_put_contents('./text/plaintext.txt', $userInput);
}


// Generate random plain text and cipher key using the shell script
$randomPlainText = shell_exec('./letters.sh'); // 256 random letters
$randomCipherKey = shell_exec('./letters.sh'); // 256 random letters

// For demonstration purposes, let's just use these text files as the source of our message and cipher keys.
$plainText = preg_replace('/[^A-Z]/', '', strtoupper(file_get_contents('./text/plaintext.txt')));
$cipherKey = preg_replace('/[^A-Z]/', '', strtoupper(file_get_contents('./text/cipherkey.txt')));

// Encrypt and then immediately decrypt the plain text message to test the one time pad.
if (
    (false === $cipherText = $cipher->encrypt($cipherKey, $plainText)) ||
    (false === $decodedPlainText = $cipher->decrypt($cipherKey, $cipherText))
) {
    echo('For perfect encryption in the one time pad, the key length must be equal to, or greater than, the message length.');
}
//
file_put_contents('./text/ciphertext.txt', $cipher->tty($cipherText));

// Displays a "vigenere table," also known as a "tabula recta."
echo $cipher->get_vigenere_table();

// Displays the plain text message, the one time pad cipher key, and the resulting safe-to-transmit cipher text.
$messageLength = strlen($plainText);
$cipherKeyUsed = substr($cipherKey, 0, $messageLength);

echo 'Plain:  ' . implode(' ', str_split($cipher->tty($plainText))) . " (message)\n";
echo 'Key:    ' . implode(' ', str_split($cipher->tty($cipherKeyUsed))) . " (secret)\n";
echo '        ' . implode(' ', str_split(str_repeat('-', $messageLength))) . "\n";
echo 'Cipher: ' . implode(' ', str_split($cipher->tty($cipherText))) . " (cipher)\n";
