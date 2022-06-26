<?php

class RC4
{
    /**
     * Przechowanie wektorów
     */
    private static $S = array();
    
    /**
     * Zamiana wartości wektorów
     */
    private static function swap(&$v1, &$v2)
    {
        $v1 = $v1 ^ $v2;
        $v2 = $v1 ^ $v2;
        $v1 = $v1 ^ $v2;
    }
    
    /**
     * Stworzenie, przechowanie i zwrócenie wektorów pomieszanych z kluczem
     * @return array
     */
    private static function KSA($key)
    {
        $idx = crc32($key);
        if (!isset(self::$S[$idx])) {
            $S   = range(0, 255);
            $j   = 0;
            $n   = strlen($key);

            for ($i = 0; $i < 256; $i++) {
                $char  = ord($key{$i % $n});
                $j     = ($j + $S[$i] + $char) % 256;
                self::swap($S[$i], $S[$j]);
            }
            self::$S[$idx] = $S;
        }
        return self::$S[$idx];
    }
    
    /**
     * Szyfrowanie
     * @return string
     */
    public static function encrypt($key, $data)
    {
        $S    = self::KSA($key);
        $n    = strlen($data);
        $i    = $j = 0;
        $data = str_split($data, 1);

        for ($m = 0; $m < $n; $m++) {
            $i        = ($i + 1) % 256;
            $j        = ($j + $S[$i]) % 256;
            self::swap($S[$i], $S[$j]);
            $char     = ord($data{$m});
            $char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
            $data[$m] = chr($char);
        }
        $data = implode('', $data);
        return $data;
    }
    /**
	 * Zamiana wartości ascii na hex
	 * @return string
	 */
	function ascii2hex($ascii) {
	  $hex = '';
	  for ($i = 0; $i < strlen($ascii); $i++) {
		$byte = strtoupper(dechex(ord($ascii{$i})));
		$byte = str_repeat('0', 2 - strlen($byte)).$byte;
		$hex.=$byte." ";
	  }
	  return $hex;
	}
}



